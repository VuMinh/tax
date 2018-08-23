<?php

namespace app\helpers;

use PHPExcel_IOFactory;
use PHPExcel_Style_Alignment;
use PhpOffice\PhpSpreadsheet\IOFactory;
use DateTime;

class ExportExcelBaoCaoNoThanhTraHelper
{

    public static function exportExcel($dataProvider, $start)
    {
        set_time_limit(2000);
        ini_set('memory_limit', '-1');
        $fileName = "Mau-5-b-No thanh-tra-24-hang-thang.xlsx";
        $inputFileName = './excel/' . $fileName;
        $activeSheetIndex = 0;
        $fileType = 'Xlsx';

        $styleArray = [
            'font' => [
                'bold' => true,
            ]
        ];

        $startDataRow = 8;
        $count = 0;

        /** Load $inputFileName to a PHPExcel Object  **/
        $objReader = IOFactory::createReader($fileType);
        $objPHPExcel = $objReader->load($inputFileName);
        $setCellValues = $objPHPExcel->getActiveSheet();
        $objPHPExcel->setActiveSheetIndex($activeSheetIndex);

        $sheet = [];

        $dataNew = ExportExcelHelper::createData('A', 'S');

        $configStyle = [];
        $totalThisYear = [];

        $dataProviderFilter['2-years-ago'] = [];
        $dataProviderFilter['1-years-ago'] = [];
        $dataProviderFilter['this-year'] = [];

        $dateExport = new DateTime($start);
        $yearExport = $dateExport->format("Y");

        $setCellValues->setCellValue('B3', 'Tháng ' . (int)$dateExport->format("m") . ' năm ' . $yearExport);
        $x = 'Thanh Xuân, ngày ' . (int)$dateExport->format("d") . ' tháng ' . (int)$dateExport->format("m") . ' năm ' . (int)$dateExport->format("Y");

        foreach ($dataProvider as $key => $value) {

            $phat = $value['tienPhat1020'] + $value['tienPhat005'];

            $tongtThuNS = $phat + $value['vatTruyThu'] + $value['tndn'] + $value['ttdb'] + $value['tncn'] + $value['monBai'];
            $daNop = $value['lichsunopthanhtras']['0']['daNopThue'];
            $no = $phat - $daNop;

            if ($no > 0) {
                $data = $dataNew;

                $data['B'] = $value['soQdThanhTra']['soQdThanhTra'];
                $data['C'] = DateTimeHelpers::convertDate($value['soQdThanhTra']['ngayQdThanhTra']);
                $data['D'] = $value['mst0']['tenNguoiNop'];
                $data['E'] = $value['mst0']['maSoThue'];
                $data['F'] = $value['truongDoan'];
                $data['G'] = $tongtThuNS;
                $data['H'] = $value['vatTruyThu'];
                $data['I'] = $value['tndn'];
                $data['J'] = $value['ttdb'];
                $data['K'] = $value['tncn'];
                $data['L'] = $value['monBai'];
                $data['M'] = $value['tienPhat005'];
                $data['N'] = $phat;
                $data['O'] = $value['soQdTruyThu']['soQdTruyThu'];
                $data['P'] = DateTimeHelpers::convertDate($value['soQdTruyThu']['ngayQdTruyThu']);
                $data['Q'] = $value['lichsunopthanhtra']['daNopThue'];
                $data['R'] = DateTimeHelpers::convertDate($value['lichsunopthanhtra']['ngayNop']);
                $data['S'] = $no;
                $date_ = $value['ngayTao'];
                $date_ = date("d/m/Y", strtotime($date_));

                $yearKT = (new DateTime($value['ngayTao']))->format("Y");
                if ($yearExport == $yearKT) {

                    $y = explode('/', $date_);
                    if ((int)$y[1] == 1) {
                        if ($y[0] < 25) {
                            $dataProviderFilter['this-year'][1][] = $data;

                        } else {
                            $dataProviderFilter['this-year'][2][] = $data;
                        }
                    } elseif ((int)$y[1] == 12) {
                        $dataProviderFilter['this-year'][12][] = $data;
                    } else {
                        if ($y[0] < 25) {
                            $dataProviderFilter['this-year'][(int)$y[1]][] = $data;
                        } else {
                            $dataProviderFilter['this-year'][(int)$y[1] + 1][] = $data;
                        }
                    }

                } elseif (($yearExport - $yearKT) == 1) {
                    $dataProviderFilter['1-years-ago'][] = $data;

                } else {
                    $dataProviderFilter['2-years-ago'][] = $data;
                }
            }
        }
        ksort($dataProviderFilter['this-year']);
//        echo "<pre>";
//        print_r($dataProviderFilter);die;
        foreach ($dataProviderFilter as $stt => $nam) {

            foreach ($nam as $sttthang => $thang) {
                if ($stt == 'this-year') {
                    $title = 'Tháng ' . $sttthang . '/' . $yearExport;
                    $sheet[] = self::setData($startDataRow + $count, count($thang), $dataNew, $title, $thang, $stt, []);
                    $totalThisYear[] = $startDataRow + $count - 1;
                    $count++;
                }

                if ($stt == 'this-year') {
                    foreach ($thang as $sttgiatri => $giatri) {
                        $sheet[] = $giatri;
                        $count++;
                    }
                }
                if ($stt == '1-years-ago') {
                    $sheet[] = $thang;
                    $count++;
                }
            }

            $count1 = $count;
            $thang = [];
            if ($stt == 'this-year') {
                $title = 'Nợ năm ' . $yearExport;
            } else if ($stt == '2-years-ago') {
                $title = 'Các năm trước chuyển sang';
                $thang = $dataProviderFilter['2-years-ago'];
            } else {
                $title = 'Nợ năm ' . ($yearExport - 1);
                $count1 = count($dataProviderFilter['1-years-ago']);
            }

            $sheet[] = self::setData($startDataRow, $count1, $dataNew, $title, $thang, $stt, $totalThisYear);
            $configStyle[] = $startDataRow + $count - 1;
            $count++;
        }
        $title = 'Tổng nợ';
//        $sheet[] = self::setData($startDataRow,$count,$dataNew,$title,[],null,$configStyle);
        $configStyle[] = $startDataRow + $count - 1;

        $setCellValues->insertNewRowBefore($startDataRow, count($sheet) - 2);
        $setCellValues->fromArray($sheet, null, 'A' . ($startDataRow - 1));

        $setCellValues->setCellValue('O' . ($startDataRow + count($sheet)), $x);

        foreach ($configStyle as $key => $value) {
            $setCellValues->mergeCells("A" . $value . ":E" . $value);
            $setCellValues->getStyle('A' . ($value) . ':S' . ($value))->applyFromArray($styleArray);
        }

        foreach ($totalThisYear as $key => $value) {
            $setCellValues->mergeCells("A" . $value . ":E" . $value);
            $setCellValues->getStyle('A' . ($value) . ':S' . ($value))->applyFromArray($styleArray);
        }

        $newFile = './result/' . time() . $fileName;
        $objWriter = IOFactory::createWriter($objPHPExcel, $fileType);
        $objWriter->save($newFile);
        ExportExcelHelper::download($newFile);
    }

    public static function setData($startDataRow, $count, $dataNew, $title, $thang, $year, $total)
    {
        $data = $dataNew;
        foreach ($data as $id => $value) {
            switch ($id) {
                case 'B' :
                case 'C' :
                case 'D' :
                case 'E' :
                case 'F' :
                case 'O' :
                case 'P' :
                    break;
                case 'A' :
                    $data[$id] = $title;
                    break;
                default:
                    if ($year == '2-years-ago') {
                        foreach ($thang as $sttgiatri => $giatri) {
                            $data[$id] += $giatri[$id];
                        }
                    } else {
                        if ($total) {
                            $data[$id] = "=SUM(" . $id . $total[0];
                            for ($i = 1; $i < count($total); $i++) {
                                $data[$id] .= "+" . $id . $total[$i];;
                            }
                            $data[$id] .= ")";
                        } else {
                            $data[$id] = "=SUM(" . $id . ($startDataRow) . " : " . $id . ($startDataRow + $count - 1) . ")";
                        }
                    }
                    break;
            }
        }

        return $data;
    }
}