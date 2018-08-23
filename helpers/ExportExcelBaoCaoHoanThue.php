<?php
/**
 * Created by PhpStorm.
 * User: haiye_000
 * Date: 4/9/2017
 * Time: 3:47 PM
 */

namespace app\helpers;

use PHPExcel_IOFactory;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PHPExcel_Style_NumberFormat;
use yii\helpers\Url;

class ExportExcelBaoCaoHoanThue
{
    public static function exportExcel($dataProvider, $month, $year)
    {
        function changeDonVi($tien)
        {
            return round(floatval($tien) / 1000, 3);
        }

        set_time_limit(2000);
        $fileName = 'Mau-11-bao-cao-kiem-tra-hoan-thue.xlsx';
        $inputFileName = './excel/' . $fileName;
        $activeSheetIndex = 0;
        $fileType = 'Xlsx';
        $styleArray = [
            'font' => [
                'bold' => false,
            ]
        ];

        /** Load $inputFileName to a PHPExcel Object  **/
        $objReader = IOFactory::createReader($fileType);
        $objPHPExcel = $objReader->load($inputFileName);
        $setCellValues = $objPHPExcel->getActiveSheet();
        $objPHPExcel->setActiveSheetIndex($activeSheetIndex);
        $dataTH = array();// data for trước hoàn
        $dataSH1N = array(); // data for sau hoàn 1 năm
        $dataSHRR = array(); // data for rủi ro


        $setCellValues->setCellValue('A4', 'Tháng ' . $month . ' năm ' . $year);
//        $setCellValues->setCellValue('A2', 'Chi cục thuế Quận Thanh Xuân');
        $startYear = DateTimeHelpers::convertDatetime('01/01' . '/' . $year);

        foreach ($dataProvider as $key => $value) {
            $date_db = $value['ngayKyBbkt'];
            $monthOfDate = date("m", strtotime($date_db));
            $yearOfDate = date("Y", strtotime($date_db));
            /*var_dump($monthOfDate);
            var_dump($yearOfDate);
            var_dump($month);
            var_dump($year);*/

            if ($monthOfDate == $month) {
                if ($value['truocHoan'] == 1) {
                    $dataTH [] = [
                        'sauHoan' => $value['sauHoan'],
                        'kiemTra' => $value['kiemTra'],
                        'A' => 'stt',
                        'B' => trim($value['tenNguoiNop']),
                        'C' => trim($value['mst']),
                        'D' => trim($value['thHoanThue']),
                        'E' => trim($value['soThueDeNghiHoan']),
                        'F' => trim($value['soThueKhongDuocHoan']),
                        'G' => trim($value['soThueTruyHoan']),
                        'H' => trim($value['phat']),
                        'I' => trim($value['daNop']),
                        'J' => trim($value['hanhViViPham']),
                        'K' => trim($value['ghiChu']),
                    ];
                }
                if ($value['sauHoan'] == 1 && $value['kiemTra'] == 1) {
                    $dataSH1N [] = [
                        'A' => 'stt',
                        'B' => trim($value['tenNguoiNop']),
                        'C' => trim($value['mst']),
                        'D' => trim($value['thHoanThue']),
                        'E' => trim($value['soThueDeNghiHoan']),
                        'F' => trim($value['soThueKhongDuocHoan']),
                        'G' => trim($value['soThueTruyHoan']),
                        'H' => trim($value['phat']),
                        'I' => trim($value['daNop']),
                        'J' => trim($value['hanhViViPham']),
                        'K' => trim($value['ghiChu']),
                    ];
                } else {
                    $dataSHRR [] = [
                        'A' => 'stt',
                        'B' => trim($value['tenNguoiNop']),
                        'C' => trim($value['mst']),
                        'D' => trim($value['thHoanThue']),
                        'E' => trim($value['soThueDeNghiHoan']),
                        'F' => trim($value['soThueKhongDuocHoan']),
                        'G' => trim($value['soThueTruyHoan']),
                        'H' => trim($value['phat']),
                        'I' => trim($value['daNop']),
                        'J' => trim($value['hanhViViPham']),
                        'K' => trim($value['ghiChu']),
                    ];
                }
            }
          /*  else {
                if ($date_db >= $startYear && $month <= $monthOfDate && $year <= $yearOfDate) {
                    if ($value['truocHoan'] == 1) {
                        $dataTH [] = [
                            'sauHoan' => $value['sauHoan'],
                            'kiemTra' => $value['kiemTra'],
                            'A' => 'stt',
                            'B' => trim($value['tenNguoiNop']),
                            'C' => trim($value['mst']),
                            'D' => trim($value['thHoanThue']),
                            'E' => trim($value['soThueDeNghiHoan']),
                            'F' => trim($value['soThueKhongDuocHoan']),
                            'G' => trim($value['soThueTruyHoan']),
                            'H' => trim($value['phat']),
                            'I' => trim($value['daNop']),
                            'J' => trim($value['hanhViViPham']),
                            'K' => trim($value['ghiChu']),
                        ];
                    }
                    if ($value['sauHoan'] == 1 && $value['kiemTra'] == 1) {
                        $dataSH1N [] = [
                            'A' => 'stt',
                            'B' => trim($value['tenNguoiNop']),
                            'C' => trim($value['mst']),
                            'D' => trim($value['thHoanThue']),
                            'E' => trim($value['soThueDeNghiHoan']),
                            'F' => trim($value['soThueKhongDuocHoan']),
                            'G' => trim($value['soThueTruyHoan']),
                            'H' => trim($value['phat']),
                            'I' => trim($value['daNop']),
                            'J' => trim($value['hanhViViPham']),
                            'K' => trim($value['ghiChu']),
                        ];
                    } else {
                        $dataSHRR [] = [
                            'A' => 'stt',
                            'B' => trim($value['tenNguoiNop']),
                            'C' => trim($value['mst']),
                            'D' => trim($value['thHoanThue']),
                            'E' => trim($value['soThueDeNghiHoan']),
                            'F' => trim($value['soThueKhongDuocHoan']),
                            'G' => trim($value['soThueTruyHoan']),
                            'H' => trim($value['phat']),
                            'I' => trim($value['daNop']),
                            'J' => trim($value['hanhViViPham']),
                            'K' => trim($value['ghiChu']),
                        ];
                    }
                }

            }*/
        }
        $startRow = 9;
        $count = 1;
//        $truongHopHoanThue = 0;
        $soThueDeNghiHoan = 0;
        $thueKhongDuocHoan = 0;
        $soThueTruyHoan = 0;
        $phat = 0;
        $daNop = 0;
        foreach ($dataTH as $key => $value) {
            $setCellValues->insertNewRowBefore($startRow, 1);
            foreach ($value as $item => $list) {
                if ($item != 'sauHoan' && $item != 'kiemTra') {
                    if ($item == 'A') {
                        $list = $count;
                    }
                    if ($item == 'E') {
                        $soThueDeNghiHoan += $list;
                    }
                    if ($item == 'F') {
                        $thueKhongDuocHoan += $list;
                    }
                    if ($item == 'G') {
                        $soThueTruyHoan += $list;
                    }
                    if ($item == 'H') {
                        $phat += $list;
                    }
                    if ($item == 'I') {
                        $daNop += $list;
                    }
                    $setCellValues->setCellValue($item . $startRow, $list);
                }
            }
            $startRow++;
            $count++;
        }
        $setCellValues->setCellValue('E' . $startRow, $soThueDeNghiHoan);
        $setCellValues->setCellValue('F' . $startRow, $thueKhongDuocHoan);
        $setCellValues->setCellValue('G' . $startRow, $soThueTruyHoan);
        $setCellValues->setCellValue('H' . $startRow, $phat);
        $setCellValues->setCellValue('I' . $startRow, $daNop);

//        $setCellValues->setCellValue('E' . ($startRow + 1), $soThueDeNghiHoan);
//        $setCellValues->setCellValue('F' . ($startRow + 1), $thueKhongDuocHoan);
//        $setCellValues->setCellValue('G' . ($startRow + 1), $soThueTruyHoan);
//        $setCellValues->setCellValue('H' . ($startRow + 1), $phat);
//        $setCellValues->setCellValue('I' . ($startRow + 1), $daNop);

        $truongHopHoanThue = 0;
        $soThueDeNghiHoan = 0;
        $thueKhongDuocHoan = 0;
        $soThueTruyHoan = 0;
        $phat = 0;
        $daNop = 0;
        $startRow = $startRow + 5;
        $count = 1;
        foreach ($dataSH1N as $key => $value) {
            $setCellValues->insertNewRowBefore($startRow, 1);
            foreach ($value as $item => $list) {
                if ($item != 'hoanThue' && $item != 'kiemTra') {
                    if ($item == 'A') {
                        $list = $count;
                    }
                    if ($item == 'E') {
                        $soThueDeNghiHoan += $list;
                    }
                    if ($item == 'F') {
                        $thueKhongDuocHoan += $list;
                    }
                    if ($item == 'G') {
                        $soThueTruyHoan += $list;
                    }
                    if ($item == 'H') {
                        $phat += $list;
                    }
                    if ($item == 'I') {
                        $daNop += $list;
                    }
                    $setCellValues->setCellValue($item . $startRow, $list);
                }
            }
            $startRow++;
            $count++;
        }

        $setCellValues->setCellValue('E' . $startRow, $soThueDeNghiHoan);
        $setCellValues->setCellValue('F' . $startRow, $thueKhongDuocHoan);
        $setCellValues->setCellValue('G' . $startRow, $soThueTruyHoan);
        $setCellValues->setCellValue('H' . $startRow, $phat);
        $setCellValues->setCellValue('I' . $startRow, $daNop);

//        $setCellValues->setCellValue('E' . ($startRow + 1), $soThueDeNghiHoan);
//        $setCellValues->setCellValue('F' . ($startRow + 1), $thueKhongDuocHoan);
//        $setCellValues->setCellValue('G' . ($startRow + 1), $soThueTruyHoan);
//        $setCellValues->setCellValue('H' . ($startRow + 1), $phat);
//        $setCellValues->setCellValue('I' . ($startRow + 1), $daNop);

        $startRow = $startRow + 4;
        $count = 1;
        foreach ($dataSHRR as $key => $value) {
            $setCellValues->insertNewRowBefore($startRow, 1);
            foreach ($value as $item => $list) {
                if ($item != 'hoanThue' && $item != 'kiemTra') {
                    if ($item == 'A') {
                        $list = $count;
                    }
                    if ($item == 'E') {
                        $soThueDeNghiHoan += $list;
                    }
                    if ($item == 'F') {
                        $thueKhongDuocHoan += $list;
                    }
                    if ($item == 'G') {
                        $soThueTruyHoan += $list;
                    }
                    if ($item == 'H') {
                        $phat += $list;
                    }
                    if ($item == 'I') {
                        $daNop += $list;
                    }
                    $setCellValues->setCellValue($item . $startRow, $list);
                }
            }
            $startRow++;
            $count++;
        }
        $sheet = [];
        $dataNew = ExportExcelHelper::createData('A', 'K');


        $setCellValues->setCellValue('E' . $startRow, $soThueDeNghiHoan);
        $setCellValues->setCellValue('F' . $startRow, $thueKhongDuocHoan);
        $setCellValues->setCellValue('G' . $startRow, $soThueTruyHoan);
        $setCellValues->setCellValue('H' . $startRow, $phat);
        $setCellValues->setCellValue('I' . $startRow, $daNop);

//        $setCellValues->setCellValue('E' . ($startRow + 1), $soThueDeNghiHoan);
//        $setCellValues->setCellValue('F' . ($startRow + 1), $thueKhongDuocHoan);
//        $setCellValues->setCellValue('G' . ($startRow + 1), $soThueTruyHoan);
//        $setCellValues->setCellValue('H' . ($startRow + 1), $phat);
//        $setCellValues->setCellValue('I' . ($startRow + 1), $daNop);

//        $setCellValues->insertNewRowBefore($startRow + 1, count($sheet));
//        $setCellValues->fromArray($sheet, null, 'A' . $startRow);

        $newFile = './result/' . time() . $fileName;
        $objWriter = IOFactory::createWriter($objPHPExcel, $fileType);
        $objWriter->save($newFile);
        ExportExcelHelper::download($newFile);
    }
}