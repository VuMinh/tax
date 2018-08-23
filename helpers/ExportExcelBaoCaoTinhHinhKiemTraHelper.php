<?php
/**
 * Created by PhpStorm.
 * User: vietv
 * Date: 5/8/2017
 * Time: 10:38 AM
 */

namespace app\helpers;

use PhpOffice\PhpSpreadsheet\IOFactory;
use DateTime;
use app\helpers\DateTimeHelpers;


class ExportExcelBaoCaoTinhHinhKiemTraHelper
{
    public static function exportExcel($dataProvider, $start, $end)
    {
        set_time_limit(2000);
        $fileName = 'Bao-cao-tinh-hinh-kiem-tra.xlsx';
        $inputFileName = './excel/' . $fileName;
        $activeSheetIndex = 0;
        $startDataRow = 7;
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
        $objPHPExcel = $objReader->load($inputFileName);
        $setCellValues = $objPHPExcel->getActiveSheet();
        $objPHPExcel->setActiveSheetIndex($activeSheetIndex);

        $date = new DateTime($end);
        $date_format = $date->modify('-1 day');
        $year = $date->format('Y');

        $lastday = date("t", mktime(0, 0, 0, $date->format('m'), 1, $date->format('Y')));

        $last_day_of_month = $lastday . '/' . $date->format('m') . '/' . $year;
        $last_day_of_month = str_replace('/', '-', $last_day_of_month);

        $weekOfMonth = ExportExcelHelper::findFriInMonthEdited($date->format('m'), $date->format('Y'));

        $week = 0;

        $date_first_month = DateTimeHelpers::convertDatetime('1' . '/' . $date->format('m') . '/' . $date->format('Y'));

        foreach ($weekOfMonth as $key => $value) {
            $date_format = $date->format('Y') . '-' . $date->format('m') . '-' . $date->format('d') . ' ' . $date->format('H') . ':' . $date->format('i') . ':' . $date->format('s');
            if (in_array($date_format, $value)) {
                $week = $key + 1;
                break;
            }
        }

        $objPHPExcel->getActiveSheet()->setTitle("T" . (int)$date->format('m') . '-' . $date->format('Y'));
        $setCellValues->setCellValue('A2', 'Tuần ' . '0' . $week . ' tháng ' . $date->format('m') . '/' . $date->format('Y'));

        $setCellValues->setCellValue('K4', 'Quyết định ban hành Tháng ' . $date->format('m') . '/' . $date->format('Y'));
        $setCellValues->setCellValue('W4', 'Quyết định hoàn thành Tháng ' . $date->format('m') . '/' . $date->format('Y'));

        $setCellValues->setCellValue('AI4', 'Tổng truy thu và phạt tháng ' . $date->format('m') . ' (tr.đ)');

        $charM = 77;
        $data = [
            '0' => 'Y',
            '1' => 'AA',
            '2' => 'AC',
            '3' => 'AE',
            '4' => 'AG',
        ];

        $charO = 79;
        foreach ($weekOfMonth as $key => $value) {
            $date_first = DateTimeHelpers::convertDate_Month($value[0]);
            $date_end = DateTimeHelpers::convertDate_Month($value[count($value) - 1]);
            if (count($value) == 1) {
                $setCellValues->setCellValue(chr($charM) . '5', $date_first);
                $setCellValues->setCellValue($data[0][$key] . '5', $date_first);
                $charM += 2;
            } else {
                $setCellValues->setCellValue(chr($charM) . '5', $date_first . ' đến ' . $date_end);
                $setCellValues->setCellValue($data[$key] . '5', $date_first . ' đến ' . $date_end);
                $charM += 2;
            }
        }

        $dataWeek = [
            '0' => ['M', 'N', 'Y', 'Z'],
            '1' => ['O', 'P', 'AA', 'AB'],
            '2' => ['Q', 'R', 'AC', 'AD'],
            '3' => ['S', 'T', 'AE', 'AF'],
            '4' => ['U', 'V', 'AG', 'AH'],
        ];

        $dataProviderFilter = [];

        $startYear = DateTimeHelpers::convertDatetime('1/12' . '/' . ($date->format('Y') - 1));
        $startYearLuyKe = DateTimeHelpers::convertDatetime('1/1' . '/' . ($date->format('Y')));

        foreach ($dataProvider as $key => $value) {
            if ($value['soQdkt']['truongDoan']['truongDoan']) {
                $value['tongHoanThanhLuyKe'] = 0;
                $value['tongHoanThanhLuyKeTrongKh'] = 0;
                $value['tongTruyThu&Phat'] = 0;
                $value['tongQdTonDauKy'] = 0;
                $value['tonTrongKeHoach'] = 0;

                if ($value['soQdkt']['ngayTao'] < $date_first_month && $value['soQdkt']['ngayTao'] >= $startYearLuyKe && $value['soQdXuLy']['ngayTao'] >= $startYearLuyKe && $value['soQdXuLy']['ngayTao'] < $date_first_month) {
                    $value['tongHoanThanhLuyKe'] = 1;
                    $value['tongTruyThu&Phat'] = $value['truyThuThueGtgt'] + $value['truyThuThueTndn'] + $value['truyThuThueTncn'] + $value['truyThuThueKhac'] + $value['truyHoanThueGtgt'] + $value['truyHoanThueTncn'] + $value['truyHoanThueKhac'] + $value['phatTronThue'] + $value['phatHanhChinhKhac1020'] + $value['phatChamNop'] + $value['phatKhac'];
                    if ($value['qdHtThuocKhRuiRoTrongNam']) {
                        $value['tongHoanThanhLuyKeTrongKh'] = 1;
                    }

                }

                if (($value['soQdkt']['ngayTao'] >= $startYear && $value['soQdkt']['ngayTao'] < $date_first_month) && ($value['soQdXuLy']['ngayTao'] >= $date_first_month || !$value['soQdXuLy']['ngayTao'])) {
                    $value['tongQdTonDauKy'] = 1;

                    if ($value['qdHtThuocKhRuiRoTrongNam']) {
                        $value['tonTrongKeHoach'] = 1;
                    }
                }

                $valueWeek = [];
                $value['tongTruyThu&PhatTheoThang'] = 0;

                for ($i = 0; $i < $week; $i++) {

                    $startWeek = $weekOfMonth[$i][0];

                    $endWeek = $weekOfMonth[$i][count($weekOfMonth[$i]) - 1];

                    $valueWeek[$i]['tongBh'] = 0;
                    $valueWeek[$i]['tongHt'] = 0;
                    $valueWeek[$i]['keHoachBh'] = 0;
                    $valueWeek[$i]['keHoachHt'] = 0;
                    if ($value['soQdkt']['ngayTao'] <= $endWeek && $value['soQdkt']['ngayTao'] >= $startWeek) {
                        $valueWeek[$i]['tongBh'] = 1;
                        if ($value['qdHtThuocKhRuiRoTrongNam']) {
                            $valueWeek[$i]['keHoachBh'] = 1;
                        }
                    }

                    if ($value['soQdXuLy']['ngayTao'] >= $startWeek && $value['soQdXuLy']['ngayTao'] <= $endWeek) {
                        $valueWeek[$i]['tongHt'] = 1;
                        $value['tongTruyThu&PhatTheoThang'] += $value['truyThuThueGtgt'] + $value['truyThuThueTndn'] + $value['truyThuThueTncn'] + $value['truyThuThueKhac'] + $value['truyHoanThueGtgt'] + $value['truyHoanThueTncn'] + $value['truyHoanThueKhac'] + $value['phatTronThue'] + $value['phatHanhChinhKhac1020'] + $value['phatChamNop'] + $value['phatKhac'];
                        if ($value['qdHtThuocKhRuiRoTrongNam']) {
                            $valueWeek[$i]['keHoachHt'] = 1;
                        }
                    }
                }

                if (array_key_exists($value['soQdkt']['truongDoan']['truongDoan'], $dataProviderFilter)) {

                    $dataProviderFilter[$value['soQdkt']['truongDoan']['truongDoan']]['F'] += $value['tongHoanThanhLuyKe'];
                    $dataProviderFilter[$value['soQdkt']['truongDoan']['truongDoan']]['G'] += $value['tongHoanThanhLuyKeTrongKh'];
                    $dataProviderFilter[$value['soQdkt']['truongDoan']['truongDoan']]['H'] += $value['tongTruyThu&Phat'];
                    $dataProviderFilter[$value['soQdkt']['truongDoan']['truongDoan']]['I'] += $value['tongQdTonDauKy'];
                    $dataProviderFilter[$value['soQdkt']['truongDoan']['truongDoan']]['J'] += $value['tonTrongKeHoach'];

                    $dataProviderFilter[$value['soQdkt']['truongDoan']['truongDoan']]['AI'] += $value['tongTruyThu&PhatTheoThang'];

                    for ($i = 0; $i < $week; $i++) {
                        $dataProviderFilter[$value['soQdkt']['truongDoan']['truongDoan']][$dataWeek[$i][0]] += $valueWeek[$i]['tongBh'];
                        $dataProviderFilter[$value['soQdkt']['truongDoan']['truongDoan']][$dataWeek[$i][1]] += $valueWeek[$i]['keHoachBh'];
                        $dataProviderFilter[$value['soQdkt']['truongDoan']['truongDoan']][$dataWeek[$i][2]] += $valueWeek[$i]['tongHt'];
                        $dataProviderFilter[$value['soQdkt']['truongDoan']['truongDoan']][$dataWeek[$i][3]] += $valueWeek[$i]['keHoachHt'];
                    }

                } else {

                    $dataProviderFilter[$value['soQdkt']['truongDoan']['truongDoan']]['F'] = $value['tongHoanThanhLuyKe'];
                    $dataProviderFilter[$value['soQdkt']['truongDoan']['truongDoan']]['G'] = $value['tongHoanThanhLuyKeTrongKh'];
                    $dataProviderFilter[$value['soQdkt']['truongDoan']['truongDoan']]['H'] = $value['tongTruyThu&Phat'];
                    $dataProviderFilter[$value['soQdkt']['truongDoan']['truongDoan']]['I'] = $value['tongQdTonDauKy'];
                    $dataProviderFilter[$value['soQdkt']['truongDoan']['truongDoan']]['J'] = $value['tonTrongKeHoach'];

                    $dataProviderFilter[$value['soQdkt']['truongDoan']['truongDoan']]['AI'] = $value['tongTruyThu&PhatTheoThang'];

                    for ($i = 0; $i < $week; $i++) {
                        $dataProviderFilter[$value['soQdkt']['truongDoan']['truongDoan']][$dataWeek[$i][0]] = $valueWeek[$i]['tongBh'];
                        $dataProviderFilter[$value['soQdkt']['truongDoan']['truongDoan']][$dataWeek[$i][1]] = $valueWeek[$i]['keHoachBh'];
                        $dataProviderFilter[$value['soQdkt']['truongDoan']['truongDoan']][$dataWeek[$i][2]] = $valueWeek[$i]['tongHt'];
                        $dataProviderFilter[$value['soQdkt']['truongDoan']['truongDoan']][$dataWeek[$i][3]] = $valueWeek[$i]['keHoachHt'];
                    }
                }
            }
        }

        $dataSum = ['0' => 'K',
            '1' => 'L',
            '2' => 'W',
            '3' => 'X',];

        $sheet = [];
        $dataNew = ExportExcelHelper::createData('A', 'AQ');

        $data = $dataNew;

        foreach ($data as $col => $text) {
            switch ($col) {
                case 'A':
                    $data['A'] = 'II';
                    break;
                case 'B':
                    foreach ($dataProvider as $key => $value) {
                        $data['B'] = $value['doiKiemTra'];
                    }
                    break;
                case 'AK':
                    $data['AK'] = "=+G" . ($startDataRow + $count) . "+X" . ($startDataRow + $count);
                    break;
                case 'AL':
                    $data['AL'] = "=+H" . ($startDataRow + $count) . "+AI" . ($startDataRow + $count);
                    break;
                case 'AM':
                    $data['AM'] = "=+I" . ($startDataRow + $count) . "+K" . ($startDataRow + $count) . "-W" . ($startDataRow + $count);
                    break;
                case 'AN':
                    $data['AN'] = "=+J" . ($startDataRow + $count) . "+L" . ($startDataRow + $count) . "-X" . ($startDataRow + $count);
                    break;
                case 'AO':
                    $data['AO'] = "=AJ" . ($startDataRow + $count) . "/C" . ($startDataRow + $count);
                    break;
                case 'AP':
                    $data['AP'] = "=AL" . ($startDataRow + $count) . "/E" . ($startDataRow + $count);
                    break;
                case 'AQ':
                    $data['AQ'] = "=AL" . ($startDataRow + $count) . "/AJ" . ($startDataRow + $count);
                    break;
                default:
                    $data[$col] = "=SUM(" . $col . ($startDataRow + $count + 1) . ":" . $col . ($startDataRow + $count + count($dataProviderFilter)) . ")";
                    break;
            }
        }

        $sheet[] = $data;
        $count++;

        foreach ($dataProviderFilter as $key1 => $value1) {
            $data = $dataNew;
            foreach ($data as $col => $text) {
                switch ($col) {
                    case 'F':
                    case 'G':
                    case 'I':
                    case 'J':
                        $data[$col] = $value1[$col] ? $value1[$col] : '0';
                        break;
                    case 'H':
                    case 'AI':
                        $data[$col] = round($value1[$col] / 1000000, 3) ? round($value1[$col] / 1000000, 3) : '0';
                        break;
                    case 'A':
                        $data[$col] = $count;
                        break;
                    case 'B':
                        $data[$col] = $key1;
                        break;
                    case 'K':
                        $bt = "=";
                        foreach ($dataWeek as $k => $v) {
                            $bt .= "+" . $v[0] . ($startDataRow + $count);
                        }
                        $data['K'] = $bt;
                        break;
                    case 'L':
                        $bt = "=";
                        foreach ($dataWeek as $k => $v) {
                            $bt .= "+" . $v[1] . ($startDataRow + $count);
                        }
                        $data['L'] = $bt;
                        break;
                    case 'AJ':
                        $data['AJ'] = "=+F" . ($startDataRow + $count) . "+W" . ($startDataRow + $count);
                        break;
                    case 'AK':
                        $data['AK'] = "=+G" . ($startDataRow + $count) . "+X" . ($startDataRow + $count);
                        break;
                    case 'AL':
                        $data['AL'] = "=+H" . ($startDataRow + $count) . "+AI" . ($startDataRow + $count);
                        break;
                    case 'AM':
                        $data['AM'] = "=+I" . ($startDataRow + $count) . "+K" . ($startDataRow + $count) . "-W" . ($startDataRow + $count);
                        break;
                    case 'AN':
                        $data['AN'] = "=+J" . ($startDataRow + $count) . "+L" . ($startDataRow + $count) . "-X" . ($startDataRow + $count);
                        break;
                    case 'AO':
                        $data['AO'] = "=AJ" . ($startDataRow + $count) . "/C" . ($startDataRow + $count);
                        break;
                    case 'AP':
                        $data['AP'] = "=AL" . ($startDataRow + $count) . "/E" . ($startDataRow + $count);
                        break;
                    case 'AQ':
                        $data['AQ'] = "=AL" . ($startDataRow + $count) . "/AJ" . ($startDataRow + $count);
                        break;

                }

                foreach ($dataSum as $k => $v) {
                    $bt = "=";
                    foreach ($dataWeek as $k1 => $v1) {
                        $bt .= "+" . $v1[$k] . ($startDataRow + $count);
                    }
                    $data[$v] = $bt;
                }

                for ($i = 0; $i < $week; $i++) {
                    foreach ($dataWeek[$i] as $k1 => $v1) {
                        $data[$v1] = $value1[$v1] ? $value1[$v1] : '0';
                    }
                }
            }

            $sheet[] = $data;
            $count++;
        }

        $setCellValues->insertNewRowBefore($startDataRow + 2, count($sheet) - 3);
        $setCellValues->fromArray($sheet, null, 'A' . ($startDataRow));

        if ($year == '2017') {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('3', '8', 45);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('3', '9', 45);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('3', '10', 45);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('3', '11', 45);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('3', '12', 45);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('3', '13', 38);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('3', '14', 45);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('3', '15', 45);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('3', '16', 38);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('3', '17', 38);

            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('4', '8', 29);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('4', '9', 29);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('4', '10', 29);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('4', '11', 29);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('4', '12', 29);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('4', '13', 28);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('4', '14', 29);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('4', '15', 29);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('4', '16', 28);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('4', '17', 28);

            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('5', '8', 7600);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('5', '9', 7600);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('5', '10', 7600);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('5', '11', 7600);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('5', '12', 7600);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('5', '13', 7600);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('5', '14', 7600);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('5', '15', 5600);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('5', '16', 5600);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('5', '17', 5600);
        }

        $newFile = './result/' . time() . $fileName;
        $objWriter = IOFactory::createWriter($objPHPExcel, $fileType);
        $objWriter->save($newFile);
        ExportExcelHelper::download($newFile);
    }
}