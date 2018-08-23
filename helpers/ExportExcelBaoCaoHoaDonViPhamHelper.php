<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Huy Hoang
 * Date: 5/12/2017
 * Time: 2:20 PM
 */

namespace app\helpers;

use PhpOffice\PhpSpreadsheet\IOFactory;
use DateTime;

class ExportExcelBaoCaoHoaDonViPhamHelper
{
    public static function exportExcel($dataProvider, $end)
    {
        set_time_limit(2000);
        $fileName = 'Mau 6-BAO CAO HOA DO VI PHAM QUA KTRA.xlsx';
        $inputFileName = './excel/' . $fileName;
        $activeSheetIndex = 0;
        $startDataRow = 9;
        $count = 0;
        $fileType = 'Xlsx';

        $styleArray = [
            'font' => [
                'bold' => true,
                'color' => array('rgb' => '000000'),
            ],
        ];

        /** Load $inputFileName to a PHPExcel Object  **/
        $objReader = IOFactory::createReader($fileType);

        $objPhpExcel = $objReader->load('./excel/' . $fileName);

        $objPhpExcel->setActiveSheetIndex($activeSheetIndex);

        $setCellValues = $objPhpExcel->getActiveSheet();


        $date = new DateTime($end);

        $attrNguoiMua = [
            'maSoThue' => 'D',
            'tenNguoiNop' => 'C',
        ];

        $attrBaocaoHdvp = [
            'coQuanQuanLyThueDnMua' => 'B',
            'kyHieuHoaDon' => 'E',
            'soHoaDon' => 'F',
            'ngayPhatHanhHoaDon' => 'G',
            'tenHangHoa' => 'H',
            'giaTriHangChuaThue' => 'I',
            'thueVat' => 'J',
            'dauHieuViPham' => 'K',
            'tenChuDn' => 'L',
            'cmt' => 'M',
            'ngayThayDoiChuSoHuuGanNhat' => 'N',
            'ngayThayDoiDiaDiemGanNhat' => 'O',
            'thongBaoBoTron' => 'P',
            'ngayBoTron' => 'Q',
            'coQuanThueQuanLyDnBan' => 'R',
            'tenDnBan' => 'S',
            'mstDnBan' => 'T',
            'coQuanThueRaQdxl' => 'U',
            'ghiChu' => 'V',
        ];

        $endDate = DateTime::createFromFormat('Y-m-d H:i:s', $end);
        $year = (int)$endDate->format('Y');
        $month = (int)$endDate->format('m');

        $setCellValues->setCellValue('A4', 'Tháng ' . $month . ' năm ' . $year);

        $objPhpExcel->getActiveSheet()->setTitle("Tháng " . $month);

        $dataProviderFilter = [];

        $dataProviderFilter['last-year'] = [];
        $dataProviderFilter['this-year'] = [];

        foreach ($dataProvider as $key => $value) {
            $y = explode('/', $value['ngayBaoCao']);
            if (1 < count($y) && $y[2] == $year) {
                if ((int)$y[1] == 1) {
                    if ($y[0] < 25) {
                        $dataProviderFilter['this-year'][1][] = $value;
                    } else {
                        $dataProviderFilter['this-year'][2][] = $value;
                    }
                } elseif ((int)$y[1] == 12) {
                    $dataProviderFilter['this-year'][12][] = $value;
                } else {
                    if ($y[0] < 25) {
                        $dataProviderFilter['this-year'][(int)$y[1]][] = $value;
                    } else {
                        $dataProviderFilter['this-year'][intval($y[1]) + 1][] = $value;
                    }
                }
            } else {
                $dataProviderFilter['last-year'][0][] = $value;
            }
        }

        ksort($dataProviderFilter['this-year']);

        $sheet = [];

        $dataNew = ExportExcelHelper::createData('A', 'V');

        $configStyle = [];

        foreach ($dataProviderFilter as $stt => $nam) {

            foreach ($nam as $sttthang => $thang) {

                $data = $dataNew;

                foreach ($data as $id => $value) {
                    switch ($id) {
                        case 'C' :
                            $data[$id] = 'Tháng ' . $sttthang . '/' . $year;
                            if ($stt == 'last-year') {
                                $data[$id] = 'Các kì trước chuyển sang';
                            }

                            break;
                        case 'D' :
                            $data[$id] = count($thang);
                            break;
                        case 'J' :
                            $data[$id] = "=SUM(" . $id . ($startDataRow + $count + 1) . " : " . $id . ($startDataRow + count($thang) + $count) . ")";
                            break;
                        default:
                            break;
                    }
                }

                $configStyle[] = $startDataRow + $count;

                $sheet[] = $data;
                $count++;

                $x = 1;
                foreach ($thang as $sttgiatri => $giatri) {

                    $data = $dataNew;

                    foreach ($attrNguoiMua as $colNum => $colText) {
                        $data[$colText] = $giatri['mstDnMua0'][$colNum];
                    }

                    foreach ($attrBaocaoHdvp as $colNum => $colText) {
                        $data[$colText] = $giatri[$colNum];
                    }
                    $data['A'] = $x;
                    $x++;
                    $count++;
                    $sheet[] = $data;
                }
            }
            if ($stt != 'last-year') {
                $data = $dataNew;

                foreach ($data as $id => $value) {
                    switch ($id) {
                        case 'C' :
                            $data[$id] = 'Tổng Năm ' . $year;
                            break;
                        case 'D' :
                        case 'J' :
                            $data[$id] = "=(SUM(" . $id . $startDataRow . " : " . $id . ($startDataRow + $count - 1) . "))/ 2";
                            break;
                        default:
                            break;
                    }
                }
                $configStyle[] = $startDataRow + $count;
                $sheet[] = $data;
                $count++;
            }
        }

        $setCellValues->insertNewRowBefore($startDataRow + 1, count($sheet) - 2);
        $setCellValues->fromArray($sheet, null, 'A' . $startDataRow);

        foreach ($configStyle as $key => $value) {
            $setCellValues->getStyle('A' . ($value) . ':V' . ($value))->applyFromArray($styleArray);
        }

        $newFile = './result/' . time() . $fileName;

        $objWriter = IOFactory::createWriter($objPhpExcel, $fileType);
        $objWriter->save($newFile);

        ExportExcelHelper::download($newFile);
    }
}