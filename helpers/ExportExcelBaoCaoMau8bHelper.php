<?php
/**
 * Created by PhpStorm.
 * User: MinhVT
 * Date: 5/12/2017
 * Time: 11:20 AM
 */

namespace app\helpers;

use app\models\ExportExcel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use DateTime;

class ExportExcelBaoCaoMau8bHelper
{
    public static function exportExcel($dataProvider, $start, $end)
    {
        function changeDonVi($tien)
        {
            return round(floatval($tien) / 1000000, 3);
        }
        set_time_limit(2000);
        $fileName = 'Mau-8-b-BCkiemtrasauhoan-T2-24-hang-thang.xlsx';
        $inputFileName = './excel/' . $fileName;
        $activeSheetIndex = 0;
        $startDataRow = 16;
        $count = 0;
        $fileType = 'Xlsx';

        $styleArray = [
            'font' => [
                'bold' => true,
                'text-align' => 'center',
                'color' => array('rgb' => '000000'),
            ],

        ];

        /** Load $inputFileName to a PHPExcel Object  **/
        $objReader = IOFactory::createReader($fileType);
        $objPHPExcel = $objReader->load($inputFileName);
        $setCellValues = $objPHPExcel->getActiveSheet();
        $objPHPExcel->setActiveSheetIndex($activeSheetIndex);

        $date = new DateTime($end);
        $setCellValues->setCellValue('A4', 'BÁO CÁO TỔNG HỢP KẾT QUẢ THỰC HIỆN CÁC QUYẾT ĐỊNH THANH TRA, KIỂM TRA SAU HOÀN THUẾ');
        $setCellValues->setCellValue('A5', 'Kỳ báo cáo: ' . 'Tháng ' . $date->format('m') . ' năm ' . $date->format('Y'));

        $startYear = DateTimeHelpers::convertDatetime('1/1' . '/' . $date->format('Y'));
        $end_date = new DateTime($end);
        $date_start = new DateTime($start);
        $start = DateTimeHelpers::convertDatetime($date_start->format('d') . '/' . $date_start->format('m') . '/' . $date_start->format('Y'));
        $end = DateTimeHelpers::convertDatetime($end_date->format('d') . '/' . $end_date->format('m') . '/' . $end_date->format('Y'));

        $dataDanhMuc = [
            'A' => [
                '1.1' => ['16', 'A1'],
                '1.2' => ['17', 'A2'],
                '2.1.1' => ['21', 'A3'],
                '2.1.2' => ['22', 'A4'],
                '2.2.1' => ['24', 'A5'],
                '2.2.2' => ['25', 'A6'],
                '3.1' => ['28', 'A7'],
                '3.2' => ['29', 'A8'],
                '3.3' => ['30', 'A9'],
                '3.4' => ['31', 'A10'],
                '4.1' => ['34', 'A11'],
                '5' => ['36', 'A12'],
                '6' => ['37', 'A13'],
                '7' => ['38', 'A14'],
            ],
            'B' => [
                '1' => ['40', 'B1'],
                '2' => ['41', 'B2'],
            ],
            'C' => [
                '1' => ['44', 'C1'],
                '2' => ['45', 'C2'],
            ],
            'D' => [
                ['47', 'D1']
            ],
            'E' => [
                '1' => ['49', 'E1'],
                '2' => ['50', 'E2'],
            ],
            'F' => [
                '1' => ['52', 'F'],
            ]
        ];
        $dataProviderFilter = [];
        $sheet = [];
//        $dataNew = ExportExcelHelper::createData('A', 'AI');
        $dataColumn = ExportExcelHelper::createData('C', 'AH');
        foreach ($dataDanhMuc as $key => $value) {
            foreach ($value as $k1 => $v1) {
                foreach ($dataColumn as $c => $c1) {
                    $dataProviderFilter[$key][$k1][$c] = 0;
                }

            }
        }

        foreach ($dataProvider as $key => $value) {
            foreach ($dataDanhMuc as $k1 => $v1) {
                foreach ($v1 as $k2 => $v2) {
                    if ($value['loaiHoanThue']['maLyDoHoanThue'] == $v2[1]) {
                        if ($value['ngayTao'] >= $start && $value['ngayTao'] < $end) {
                            if ($value['soQdThanhTraId'] == null) {
                                $dataProviderFilter[$k1][$k2]['F']++;
                            } else {
                                $dataProviderFilter[$k1][$k2]['G']++;
                            }
                            $dataProviderFilter[$k1][$k2]['H']++;
                            if ($value['soQdXuPhatId']) {
                                $dataProviderFilter[$k1][$k2]['I']++;
                                $dataProviderFilter[$k1][$k2]['J'] += changeDonVi($value['soQdThuHoiHoan']['soTienThueThuHoi']);
                                $dataProviderFilter[$k1][$k2]['K'] += changeDonVi($value['soQdXuPhat']['soTienPhatViPham']);
                                $dataProviderFilter[$k1][$k2]['L'] += changeDonVi($value['soQdXuPhat']['tienChamNop']);
                            } else {
                                $dataProviderFilter[$k1][$k2]['I']++;
                                $dataProviderFilter[$k1][$k2]['J'] += changeDonVi($value['soQdThuHoiHoan']['soTienThueThuHoi']);
                                $dataProviderFilter[$k1][$k2]['K'] += changeDonVi($value['soQdXuPhat']['soTienPhatViPham']);
                                $dataProviderFilter[$k1][$k2]['L'] += changeDonVi($value['soQdXuPhat']['tienChamNop']);
                            }

                            $dataProviderFilter[$k1][$k2]['C'] = changeDonVi($value['soQdThuHoiHoan']['soTienThueThuHoi'] - $value['lichSuNopKiTruocChuyenSang']['daNopThueThuHoi']);
                            $dataProviderFilter[$k1][$k2]['D'] += changeDonVi($value['soQdXuPhat']['soTienPhatViPham'] - $value['lichSuNopKiTruocChuyenSang']['daNopTienPhatViPham']);
                            $dataProviderFilter[$k1][$k2]['E'] += changeDonVi($value['soQdXuPhat']['tienChamNop'] - $value['lichSuNopKiTruocChuyenSang']['daNopTienChamNop']);

                            $dataProviderFilter[$k1][$k2]['M'] += changeDonVi($value['lichSuNopQuyHoanThue']['daNopThueThuHoi']);
                            $dataProviderFilter[$k1][$k2]['N'] += changeDonVi($value['lichSuNopQuyHoanThue']['daNopTienPhatViPham']);
                            $dataProviderFilter[$k1][$k2]['O'] += changeDonVi($value['lichSuNopQuyHoanThue']['daNopTienChamNop']);

                            $dataProviderFilter[$k1][$k2]['P'] += $dataProviderFilter[$k1][$k2]['C'] + $dataProviderFilter[$k1][$k2]['J'] - $dataProviderFilter[$k1][$k2]['M'];
                            $dataProviderFilter[$k1][$k2]['Q'] += $dataProviderFilter[$k1][$k2]['D'] + $dataProviderFilter[$k1][$k2]['K'] - $dataProviderFilter[$k1][$k2]['N'];
                            $dataProviderFilter[$k1][$k2]['R'] += $dataProviderFilter[$k1][$k2]['E'] + $dataProviderFilter[$k1][$k2]['L'] - $dataProviderFilter[$k1][$k2]['O'];
                        }
                        $dataProviderFilter[$k1][$k2]['AF'] += $dataProviderFilter[$k1][$k2]['P'];
                        $dataProviderFilter[$k1][$k2]['AG'] += $dataProviderFilter[$k1][$k2]['Q'];
                        $dataProviderFilter[$k1][$k2]['AH'] += $dataProviderFilter[$k1][$k2]['R'];

                        if ($value['ngayTao'] >= $startYear && $value['ngayTao'] < $end) {
                            if ($value['soQdThanhTraId'] == null) {
                                $dataProviderFilter[$k1][$k2]['V']++;
                            } else {
                                $dataProviderFilter[$k1][$k2]['W']++;
                            }
                            $dataProviderFilter[$k1][$k2]['X']++;
                            if ($value['soQdXuPhatId']) {
                                $dataProviderFilter[$k1][$k2]['Y']++;
                                $dataProviderFilter[$k1][$k2]['Z'] += changeDonVi($value['soQdThuHoiHoan']['soTienThueThuHoi']);
                                $dataProviderFilter[$k1][$k2]['AA'] += changeDonVi($value['soQdXuPhat']['soTienPhatViPham']);
                                $dataProviderFilter[$k1][$k2]['AB'] += changeDonVi($value['soQdXuPhat']['tienChamNop']);
                            } else {
                                $dataProviderFilter[$k1][$k2]['Y']++;
                                $dataProviderFilter[$k1][$k2]['Z'] += changeDonVi($value['soQdThuHoiHoan']['soTienThueThuHoi']);
                                $dataProviderFilter[$k1][$k2]['AA'] += changeDonVi($value['soQdXuPhat']['soTienPhatViPham']);
                                $dataProviderFilter[$k1][$k2]['AB'] += changeDonVi($value['soQdXuPhat']['tienChamNop']);
                            }
                            $dataProviderFilter[$k1][$k2]['S'] += changeDonVi($value['soQdThuHoiHoan']['soTienThueThuHoi'] - $value['lichSuNopKiTruocChuyenSang']['daNopThueThuHoi']);
                            $dataProviderFilter[$k1][$k2]['T'] += changeDonVi($value['soQdXuPhat']['soTienPhatViPham'] - $value['lichSuNopKiTruocChuyenSang']['daNopTienPhatViPham']);
                            $dataProviderFilter[$k1][$k2]['U'] += changeDonVi($value['soQdXuPhat']['tienChamNop'] - $value['lichSuNopKiTruocChuyenSang']['daNopTienChamNop']);

//                            $dataProviderFilter[$k1][$k2]['AF'] += $value['soQdThuHoiHoan']['soTienThueThuHoi'] - $value['lichSuNopChuyenKiSau']['daNopThueThuHoi'];
//                            $dataProviderFilter[$k1][$k2]['AG'] += $value['soQdXuPhat']['soTienPhatViPham'] - $value['lichSuNopChuyenKiSau']['daNopTienPhatViPham'];
//                            $dataProviderFilter[$k1][$k2]['AH'] += $value['soQdXuPhat']['tienChamNop'] - $value['lichSuNopChuyenKiSau']['daNopTienChamNop'];
                            $dataProviderFilter[$k1][$k2]['AC'] += changeDonVi($value['lichSuNopQuyHoanThue']['daNopThueThuHoi']);
                            $dataProviderFilter[$k1][$k2]['AD'] += changeDonVi($value['lichSuNopQuyHoanThue']['daNopTienPhatViPham']);
                            $dataProviderFilter[$k1][$k2]['AE'] += changeDonVi($value['lichSuNopQuyHoanThue']['daNopTienChamNop']);
                        }
                    }
                }
            }

            foreach ($dataProviderFilter as $k3 => $v3) {
                foreach ($v3 as $k4 => $v4) {
                    $data = $dataColumn;
                    foreach ($data as $k5 => $v5) {
                        $data[$k5] = $dataProviderFilter[$k3][$k4][$k5];
                    }
                    $setCellValues->insertNewRowBefore($startDataRow, count($sheet));
                    $setCellValues->fromArray($data, null, 'C' . $dataDanhMuc[$k3][$k4][0]);
                }
            }
        }
        $newFile = './result/' . time() . $fileName;
        $objWriter = IOFactory::createWriter($objPHPExcel, $fileType);
        $objWriter->save($newFile);
        ExportExcelHelper::download($newFile);
    }
}