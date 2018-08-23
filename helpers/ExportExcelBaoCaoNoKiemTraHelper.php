<?php
/**
 * Created by PhpStorm.
 * User: haiye_000
 * Date: 14-Apr-17
 * Time: 12:28 AM
 */

namespace app\helpers;

use DateTime;
use PhpOffice\PhpSpreadsheet\IOFactory;


class ExportExcelBaoCaoNoKiemTraHelper
{
    public static function exportExcel($dataProvider, $day)
    {
        function changeDonVi($tien)
        {
            return round(floatval($tien) / 1000, 3);
        }

        set_time_limit(2000);
        ini_set('memory_limit', '-1');
        $fileName = 'Mau-5-a-No-kiem-tra-24-hang-thang.xlsx';
        $inputFileName = './excel/' . $fileName;
        $activeSheetIndex = 0;
        $fileType = 'Xlsx';

        $styleArray = [
            'font' => [
                'bold' => true,
            ]
        ];

        $startDataRow = 9;
        $count = 0;

        /** Load $inputFileName to a PHPExcel Object  **/
        $objReader = IOFactory::createReader($fileType);
        $objPHPExcel = $objReader->load($inputFileName);
        $setCellValues = $objPHPExcel->getActiveSheet();
        $objPHPExcel->setActiveSheetIndex($activeSheetIndex);

        $sheet = [];

        $dataNew = ExportExcelHelper::createData('A', 'Y');

        $configStyle = [];
        $totalThisYear = [];

        $dataProviderFilter['2-years-ago'] = [];
        $dataProviderFilter['1-years-ago'] = [];
        $dataProviderFilter['this-year'] = [];

        $lichsunopMax = [];

        $dateExport = new DateTime($day);
        $yearExport = $dateExport->format("Y");

        $setCellValues->setCellValue('B3', 'Tháng ' . (int)$dateExport->format("m") . ' năm ' . $yearExport);
        $x = 'Thanh Xuân, ngày ' . (int)$dateExport->format("d") . ' tháng ' . (int)$dateExport->format("m") . ' năm ' . (int)$dateExport->format("Y");
//        $dateExport->modify('-90 day');
        foreach ($dataProvider as $key => $value) {

            if (array_key_exists($value['soQdkt']['soQdkt']['soQdKiemTra'], $lichsunopMax)) {
                if ($lichsunopMax[$value['soQdkt']['soQdkt']['soQdKiemTra']]['thoiDiemNop'] < $value['thoiDiemNop']) {
                    $lichsunopMax[$value['soQdkt']['soQdkt']['soQdKiemTra']] = $value;
                }
            } else {
                $lichsunopMax[$value['soQdkt']['soQdkt']['soQdKiemTra']] = $value;
            }
        }

        $dem = 1;
        foreach ($lichsunopMax as $key => $value) {
            $phat = $value['soQdkt']['phatHanhChinhKhac1020'] +
                $value['soQdkt']['phatChamNop'] + $value['soQdkt']['phatTronThue'] +
                $value['soQdkt']['tienHoaDon'] + $value['soQdkt']['phatKhac'];

            $tongtThuNS = $phat + ($value['soQdkt']['truyThuThueGtgt'] + $value['soQdkt']['truyThuThueTndn']
                    + $value['soQdkt']['truyThuTtdb'] + $value['soQdkt']['truyThuThueTncn'] + $value['soQdkt']['monBai']);
            $daNop = $value['daNopDongNamTruoc'] + $value['daNopPhatSinhTruyThu']
                + $value['daNopPhatSinhTruyHoan'] + $value['daNopTienPhat'];
//            var_dump($value['soQdkt']['mst0']['maSoThue'] . '-' . $phat . '-' . $daNop);

            $no = $tongtThuNS - $daNop;

            if ($no > 0) {
                $data = $dataNew;
//                $ngayQdKiemTra = $value['soQdkt']['soQdkt']['ngayQdKiemTra'];
                $ngayQdXuLy = $value['soQdkt']['soQdXuLy']['ngayQdXuLy'];
                $currentDay = date('Y-m-d 00:00:00');
                $diff = abs(strtotime($currentDay) - strtotime($ngayQdXuLy));
                $conditionDay = floor($diff / (60 * 60 * 24));

                $textDay = $conditionDay >= 90 ? '> 90 ngày' : '< 90 ngày';

                $data['A'] = $dem++;
                $data['B'] = $value['soQdkt']['soQdkt']['soQdKiemTra'];
                $data['C'] = DateTimeHelpers::convertDate($value['soQdkt']['soQdkt']['ngayQdKiemTra']);
                $data['D'] = $value['soQdkt']['mst0']['tenNguoiNop'];
                $data['E'] = $value['soQdkt']['mst0']['maSoThue'];
                $data['F'] = $no;
                $data['G'] = $value['soQdkt']['soQdkt']['truongDoan']['truongDoan'];
                $data['I'] = changeDonVi($value['soQdkt']['truyThuThueGtgt']);
                $data['J'] = changeDonVi($value['soQdkt']['truyThuThueTndn']);
                $data['K'] = changeDonVi($value['soQdkt']['truyThuTtdb']);
                $data['L'] = changeDonVi($value['soQdkt']['truyThuThueTncn']);
                $data['M'] = changeDonVi($value['soQdkt']['monBai']);
                $data['N'] = changeDonVi($value['soQdkt']['phatHanhChinhKhac1020']);
                $data['O'] = changeDonVi($value['soQdkt']['phatChamNop']);
                $data['P'] = changeDonVi($value['soQdkt']['phatTronThue']);
                $data['Q'] = changeDonVi($value['soQdkt']['tienHoaDon']);
                $data['R'] = changeDonVi($value['soQdkt']['phatKhac']);
                $data['T'] = empty($value['soQdkt']['soQdXuLy']) ? null : $value['soQdkt']['soQdXuLy']['soQdXuLy'];
                $data['U'] = empty($value['soQdkt']['soQdXuLy']) ? null : DateTimeHelpers::convertDate($value['soQdkt']['soQdXuLy']['ngayQdXuLy']);
                $data['H'] = changeDonVi($tongtThuNS);
                $data['S'] = changeDonVi($phat);
                $data['V'] = changeDonVi($daNop);
                $data['W'] = changeDonVi($no);
                $data['X'] = $textDay;
                $data['Y'] = $value['soQdkt']['doiKiemTra'];

                $yearKT = (new DateTime($value['soQdkt']['soQdkt']['ngayQdKiemTra']))->format("Y");
                if ($yearExport == $yearKT) {

                    $y = explode('/', $data['C']);

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
                    $dataProviderFilter['1-years-ago'][0][] = $data;

                } else {
                    $dataProviderFilter['2-years-ago'][0][] = $data;

                }
            }
        }

//        $dataProviderFilter['2-years-ago'] = $dataProviderFilter['1-years-ago'];
        ksort($dataProviderFilter['this-year']);
        foreach ($dataProviderFilter as $stt => $nam) {

            foreach ($nam as $sttthang => $thang) {

                if ($stt == 'this-year') {
                    $title = 'Tháng ' . $sttthang . '/' . $yearExport;
                    $sheet[] = self::setData($startDataRow + $count, count($thang), $dataNew, $title, $thang, $stt, []);
                    $totalThisYear[] = $startDataRow + $count - 1;
                    $count++;
                }

                if ($stt != '2-years-ago') {
                    foreach ($thang as $sttgiatri => $giatri) {
                        $sheet[] = $giatri;
                        $count++;
                    }
                }
            }

            $count1 = $count;
            $thang = [];
            if ($stt == 'this-year') {
                $title = 'Nợ năm ' . $yearExport;
            } else if ($stt == '2-years-ago') {
                $title = 'Các năm trước chuyển sang';
                if (count($dataProviderFilter['2-years-ago']))
                    $thang = $dataProviderFilter['2-years-ago'][0];
            } else {
                $title = 'Nợ năm ' . ($yearExport - 1);
                $count1 = count($dataProviderFilter['1-years-ago']) ? count($dataProviderFilter['1-years-ago'][0]) : 0;
            }
            /*if(count($thang)) {
                $sheet[] = self::setData($startDataRow, $count1, $dataNew, $title, $thang, $stt, $totalThisYear);
                $configStyle[] = $startDataRow + $count - 1;
                $count++;
            }*/
            $sheet[] = self::setData($startDataRow, $count1, $dataNew, $title, $thang, $stt, $totalThisYear);
            $configStyle[] = $startDataRow + $count - 1;
            $count++;
        }
        $title = 'Tổng nợ';

        $sheet[] = self::setData($startDataRow, $count, $dataNew, $title, [], null, $configStyle);
        $configStyle[] = $startDataRow + $count - 1;

        $setCellValues->insertNewRowBefore($startDataRow, count($sheet) - 2);
        $setCellValues->fromArray($sheet, null, 'A' . ($startDataRow - 1));

        $setCellValues->setCellValue('S' . ($startDataRow + count($sheet)), $x);

        foreach ($configStyle as $key => $value) {
            $setCellValues->mergeCells("A" . $value . ":E" . $value);
            $setCellValues->getStyle('A' . ($value) . ':Y' . ($value))->applyFromArray($styleArray);
        }

        foreach ($totalThisYear as $key => $value) {
            $setCellValues->mergeCells("A" . $value . ":E" . $value);
            $setCellValues->getStyle('A' . ($value) . ':Y' . ($value))->applyFromArray($styleArray);
        }

        $objPHPExcel->getActiveSheet()->removeColumn('F');

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
                case 'G' :
                case 'T' :
                case 'U' :
                case 'X' :
                case 'Y':
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
                            if (count($total)) {
                                $data[$id] = "=SUM(" . $id . $total[0];
                                for ($i = 1; $i < count($total); $i++) {
                                    $data[$id] .= "+" . $id . $total[$i];;
                                }
                                $data[$id] .= ")";
                            }
                        } else {
                            if (count($thang) == 0 && $year == "this-year") {
                                $data[$id] .= 0 . '';
                            } else {
                                $data[$id] = "=SUM(" . $id . ($startDataRow) . " : " . $id . ($startDataRow + $count - 1) . ")";
                            }
                        }
                    }
                    break;
            }
        }
        return $data;
    }
}