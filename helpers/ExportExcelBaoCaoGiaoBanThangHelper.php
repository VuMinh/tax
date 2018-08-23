<?php
/**
 * Created by PhpStorm.
 * User: vietv
 * Date: 5/8/2017
 * Time: 10:38 AM
 */

namespace app\helpers;

use PHPExcel_IOFactory;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExportExcelBaoCaoGiaoBanThangHelper
{
    public static function exportExcel($dataProvider, $end)
    {
        set_time_limit(2000);
        $fileName = 'Bao-cao-giao-ban-thang.xlsx';
        $inputFileName = './excel/' . $fileName;
        $activeSheetIndex = 0;
        $startDataRow = 3;
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

        $date = new \DateTime($end);
        $objPHPExcel->getActiveSheet()->setTitle("T" . (int)$date->format('m') . '-' . (int)$date->format('Y'));
        $setCellValues->setCellValue('A1', 'THEO DÕI QUYẾT ĐỊNH KiỂM TRA ' . (int)$date->format('Y'));
        $setCellValues->setCellValue('I2', 'Tổng QĐ thực hiện ' . (int)$date->format('Y'));

        $dataDanhMuc = [
            '1.1' => 'KT theo ĐG RR',
            '1.2' => 'KT ngoài ĐG RR',
            '2' => 'KT hoàn thuế',
            'A' => 'Kiểm tra trước hoàn',
            'B' => 'Kiểm tra sau hoàn',
            '3' => 'KT QT giải thể, đóng mã, đột xuất',
            '4' => 'Dược phẩm và thiết bị y tế',
            '6' => 'Bảo hiểm',
            '7' => 'Chuyên đề BCTC',
            '8' => 'Doanh nghiệp xã hội hóa',
            '9' => 'Doanh nghiệp kinh doanh thương mại điện tử',
            '10' => 'Doanh nghiệp có rủi ro cao về thuế theo công văn 7...',
            '11' => 'Doanh nghiệp bán hàng đa cấp',
            '12' => 'Doanh nghiệp kinh doanh thương mại nhà hàng, khách...',
            '13' => 'Doanh nghiệp kinh doanh dịch vụ viễn thông',
            '14' => 'Chuyên đề các thành viên thuộc tập đoàn và TCT lớn',
            '15' => 'Lỗ liên tục Từ 02 năm trở lên',
            '16' => 'DN có dấu hiệu chuyển giá',
            '17' => 'DN ưu đãi thuế',
            '18' => 'Nội dung khác',
        ];

        $dataDanhMucId = [
            '1' => '4',
            '2' => '6',
            '3' => '7',
            '4' => '8',
            '5' => '9',
            '6' => '10',
            '7' => '11',
            '8' => '12',
            '9' => '13',
            '10' => '14',
            '11' => '3',
            '12' => '15',
            '13' => '16',
            '14' => 'A',
            '15' => 'B',
            '16' => '17',
        ];

        $dataProviderFilter = [];
        foreach ($dataDanhMuc as $key => $value) {
            $dataProviderFilter[$key] = [];
        }

        foreach ($dataProvider as $key => $value) {
            $k = '';
            if ($value['loaiNdktId']) {
//                var_dump($value);
                $k = $dataDanhMucId[$value['loaiNdktId']];
                if (array_key_exists($value['soQdkt']['truongDoan']['truongDoan'], $dataProviderFilter[$k])) {
                    $dataProviderFilter[$k][$value['soQdkt']['truongDoan']['truongDoan']]['C'] += $value['tonDauThang'];
                    $dataProviderFilter[$k][$value['soQdkt']['truongDoan']['truongDoan']]['D'] += $value['banHanhTrongThang'];
                    $dataProviderFilter[$k][$value['soQdkt']['truongDoan']['truongDoan']]['E'] += $value['hoanThanhTrongThang'];
                    $dataProviderFilter[$k][$value['soQdkt']['truongDoan']['truongDoan']]['H'] += $value['hoanThanhTruocThang'];
                    $dataProviderFilter[$k][$value['soQdkt']['truongDoan']['truongDoan']]['G'] += $value['luyKeHTdenThangBc'];
                } else {
                    $dataProviderFilter[$k][$value['soQdkt']['truongDoan']['truongDoan']]['C'] = $value['tonDauThang'];
                    $dataProviderFilter[$k][$value['soQdkt']['truongDoan']['truongDoan']]['D'] = $value['banHanhTrongThang'];
                    $dataProviderFilter[$k][$value['soQdkt']['truongDoan']['truongDoan']]['E'] = $value['hoanThanhTrongThang'];
                    $dataProviderFilter[$k][$value['soQdkt']['truongDoan']['truongDoan']]['H'] = $value['hoanThanhTruocThang'];
                    $dataProviderFilter[$k][$value['soQdkt']['truongDoan']['truongDoan']]['G'] = $value['luyKeHTdenThangBc'];
                }
            }
            if (!$value['loaiNdktId']) {
//                var_dump($value);x
                if (array_key_exists($value['soQdkt']['truongDoan']['truongDoan'], $dataProviderFilter['18'])) {
                    $dataProviderFilter['18'][$value['soQdkt']['truongDoan']['truongDoan']]['C'] += $value['tonDauThang'];
                    $dataProviderFilter['18'][$value['soQdkt']['truongDoan']['truongDoan']]['D'] += $value['banHanhTrongThang'];
                    $dataProviderFilter['18'][$value['soQdkt']['truongDoan']['truongDoan']]['E'] += $value['hoanThanhTrongThang'];
                    $dataProviderFilter['18'][$value['soQdkt']['truongDoan']['truongDoan']]['H'] += $value['hoanThanhTruocThang'];
                    $dataProviderFilter['18'][$value['soQdkt']['truongDoan']['truongDoan']]['G'] += $value['luyKeHTdenThangBc'];
                } else {
                    $dataProviderFilter['18'][$value['soQdkt']['truongDoan']['truongDoan']]['C'] = $value['tonDauThang'];
                    $dataProviderFilter['18'][$value['soQdkt']['truongDoan']['truongDoan']]['D'] = $value['banHanhTrongThang'];
                    $dataProviderFilter['18'][$value['soQdkt']['truongDoan']['truongDoan']]['E'] = $value['hoanThanhTrongThang'];
                    $dataProviderFilter['18'][$value['soQdkt']['truongDoan']['truongDoan']]['H'] = $value['hoanThanhTruocThang'];
                    $dataProviderFilter['18'][$value['soQdkt']['truongDoan']['truongDoan']]['G'] = $value['luyKeHTdenThangBc'];
                }
            }
            if ($value['qdHtThuocKhRuiRoTrongNam']) {
                if (array_key_exists($value['soQdkt']['truongDoan']['truongDoan'], $dataProviderFilter['1.1'])) {
                    $dataProviderFilter['1.1'][$value['soQdkt']['truongDoan']['truongDoan']]['C'] += $value['tonDauThang'];
                    $dataProviderFilter['1.1'][$value['soQdkt']['truongDoan']['truongDoan']]['D'] += $value['banHanhTrongThang'];
                    $dataProviderFilter['1.1'][$value['soQdkt']['truongDoan']['truongDoan']]['E'] += $value['hoanThanhTrongThang'];
                    $dataProviderFilter['1.1'][$value['soQdkt']['truongDoan']['truongDoan']]['H'] += $value['hoanThanhTruocThang'];
                    $dataProviderFilter['1.1'][$value['soQdkt']['truongDoan']['truongDoan']]['G'] += $value['luyKeHTdenThangBc'];
                } else {
                    $dataProviderFilter['1.1'][$value['soQdkt']['truongDoan']['truongDoan']]['C'] = $value['tonDauThang'];
                    $dataProviderFilter['1.1'][$value['soQdkt']['truongDoan']['truongDoan']]['D'] = $value['banHanhTrongThang'];
                    $dataProviderFilter['1.1'][$value['soQdkt']['truongDoan']['truongDoan']]['E'] = $value['hoanThanhTrongThang'];
                    $dataProviderFilter['1.1'][$value['soQdkt']['truongDoan']['truongDoan']]['H'] = $value['hoanThanhTruocThang'];
                    $dataProviderFilter['1.1'][$value['soQdkt']['truongDoan']['truongDoan']]['G'] = $value['luyKeHTdenThangBc'];
                }
            }
            if (!$value['qdHtThuocKhRuiRoTrongNam']) {
                if (array_key_exists($value['soQdkt']['truongDoan']['truongDoan'], $dataProviderFilter['1.2'])) {
                    $dataProviderFilter['1.2'][$value['soQdkt']['truongDoan']['truongDoan']]['C'] += $value['tonDauThang'];
                    $dataProviderFilter['1.2'][$value['soQdkt']['truongDoan']['truongDoan']]['D'] += $value['banHanhTrongThang'];
                    $dataProviderFilter['1.2'][$value['soQdkt']['truongDoan']['truongDoan']]['E'] += $value['hoanThanhTrongThang'];
                    $dataProviderFilter['1.2'][$value['soQdkt']['truongDoan']['truongDoan']]['H'] += $value['hoanThanhTruocThang'];
                    $dataProviderFilter['1.2'][$value['soQdkt']['truongDoan']['truongDoan']]['G'] += $value['luyKeHTdenThangBc'];
                } else {
                    $dataProviderFilter['1.2'][$value['soQdkt']['truongDoan']['truongDoan']]['C'] = $value['tonDauThang'];
                    $dataProviderFilter['1.2'][$value['soQdkt']['truongDoan']['truongDoan']]['D'] = $value['banHanhTrongThang'];
                    $dataProviderFilter['1.2'][$value['soQdkt']['truongDoan']['truongDoan']]['E'] = $value['hoanThanhTrongThang'];
                    $dataProviderFilter['1.2'][$value['soQdkt']['truongDoan']['truongDoan']]['H'] = $value['hoanThanhTruocThang'];
                    $dataProviderFilter['1.2'][$value['soQdkt']['truongDoan']['truongDoan']]['G'] = $value['luyKeHTdenThangBc'];
                }
            }
        }
        $sheet = [];

        $dataNew = ExportExcelHelper::createData('A', 'J');

        $configStyle = [];
        $total = [];

        foreach ($dataProviderFilter as $key => $value) {
            $data = $dataNew;
            foreach ($data as $k => $v) {
                switch ($k) {
                    case 'J':
                        break;
                    case 'A':
                        $data[$k] = $key;
                        break;
                    case 'B':
                        $data[$k] = $dataDanhMuc[$key];
                        break;
                    default:
                        if ($key == '2') {
                            $data[$k] = "=" . $k . ($startDataRow + $count + 1) . "+" . $k . ($startDataRow + $count + count($dataProviderFilter['A']) + 2);
                        } else {
                            if (count($value)) {
                                $data[$k] = "=SUM(" . $k . ($startDataRow + $count + 1) . ":" . $k . ($startDataRow + $count + count($value)) . ")";
                            }
                        }

                        break;
                }
            }

            if ($key != '2') {
                $total[] = $startDataRow + $count;
            }

            $sheet[] = $data;
            $configStyle[] = $startDataRow + $count;
            $count++;

            $stt = 1;
            foreach ($value as $k => $v) {
                $data = $dataNew;
                foreach ($data as $k1 => $v1) {
                    switch ($k1) {
                        case 'J':
                            foreach ($dataProvider as $keyKt => $valueKt) {
                                $data[$k1] = $valueKt['doiKiemTra'];
                            }
                            break;
                        case 'A':
                            $data[$k1] = $stt;
                            break;
                        case 'B':
                            $data[$k1] = $k;
                            break;
                        case 'F':
                            $data[$k1] = "=C" . ($startDataRow + $count) . "+D" . ($startDataRow + $count) . "-E" . ($startDataRow + $count);
                            break;
                        case 'G':
                            $data[$k1] = "=E" . ($startDataRow + $count) . "+H" . ($startDataRow + $count);
                            break;
                        case 'I':
                            $data[$k1] = "=G" . ($startDataRow + $count) . "+F" . ($startDataRow + $count);
                            break;
                        default:
                            $data[$k1] = $v[$k1] ? $v[$k1] : '0';
                            break;
                    }
                }
                $stt++;
                $sheet[] = $data;
                $count++;
            }
        }

        $data = $dataNew;
        foreach ($data as $k1 => $v1) {
            switch ($k1) {
                case 'J':
                    break;
                case 'A':
                    break;
                case 'B':
                    $data[$k1] = 'Tổng cộng';
                    break;
                default:
                    $data[$k1] = "=(";
                    foreach ($total as $key => $value) {
                        $data[$k1] .= "+" . $k1 . $value;
                    }
                    $data[$k1] .= ")/2";
                    break;
            }
        }

        $sheet[] = $data;

        $configStyle[] = $startDataRow + $count;

        $setCellValues->insertNewRowBefore($startDataRow + 2, count($sheet) - 2);
        $setCellValues->fromArray($sheet, null, 'A' . ($startDataRow));

        foreach ($configStyle as $key => $value) {
            $setCellValues->getStyle('A' . ($value) . ':J' . ($value))->applyFromArray($styleArray);
        }

        $newFile = './result/' . time() . $fileName;
        $objWriter = IOFactory::createWriter($objPHPExcel, $fileType);
        $objWriter->save($newFile);
        ExportExcelHelper::download($newFile);
    }
}