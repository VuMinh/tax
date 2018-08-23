<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Huy Hoang
 * Date: 5/12/2017
 * Time: 2:20 PM
 */
namespace app\helpers;
use Faker\Provider\DateTime;
use PHPExcel_IOFactory;
use PhpOffice\PhpSpreadsheet\IOFactory;
class ExportExcelBaoCaoMau8AHelper
{
    public static function exportExcel($dataProvider, $start, $end)
    {
        function changeDonVi($tien)
        {
            return round(floatval($tien) / 1000000, 3);
        }
        set_time_limit(2000);
        $fileName = 'Mau-8-a-BCkiemtrasauhoan-24-hang-thang.xlsx';
        $inputFileName = './excel/' . $fileName;
        $activeSheetIndex = 0;
        $startDataRow = 12;
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
        $date = new \DateTime($end);
        $dataDanhMuc = [
            'A' => [
                '1.1' => ['14', 'A1'],
                '1.2' => ['15', 'A2'],
                '2.1.1' => ['18', 'A3'],
                '2.1.2' => ['19', 'A4'],
                '2.2.1' => ['21', 'A5'],
                '2.2.2' => ['22', 'A6'],
                '3.1' => ['25', 'A7'],
                '3.2' => ['26', 'A8'],
                '3.3' => ['27', 'A9'],
                '3.4' => ['38', 'A10'],
                '4.1' => ['31', 'A11'],
                '5' => ['34', 'A12'],
                '6' => ['35', 'A13'],
                '7' => ['36', 'A14'],
            ],
            'B' => [
                '1' => ['38', 'B1'],
                '2' => ['39', 'B2'],
            ],
            'C' => [
                '1' => ['42', 'C1'],
                '2' => ['43', 'C2'],
            ],
            'D' => [
                ['45', 'D1']
            ],
            'E' => [
                '1' => ['47', 'E1'],
                '2' => ['48', 'E2'],
            ],
            'F' => [
                '1' => ['51', 'F'],
            ]
        ];
        $sheet = [];
        $date = new \DateTime();
        $startYear = DateTimeHelpers::convertDatetime('1/1' . '/' . ($date->format('Y')));
        $start_date = new \DateTime($start);
        $end_date = new \DateTime($end);
        $start = DateTimeHelpers::convertDatetime($start_date->format('d') . '/' . $start_date->format('m') . '/' . $start_date->format('Y'));
        $end = DateTimeHelpers::convertDatetime($end_date->format('d') . '/' . $end_date->format('m') . '/' . $end_date->format('Y'));
        $dataNew = ExportExcelHelper::createData('C', 'P');
        $dataColumm = ExportExcelHelper::createData('C', 'P');
        $configStyle = [];
        $dataProviderFilter = [];
        foreach ($dataDanhMuc as $k1 => $v1) {
            foreach ($v1 as $k2 => $v2) {
                foreach ($dataColumm as $c => $c1) {
                    $dataProviderFilter[$k1][$k2][$c] = 0;
                }
            }
        }
        foreach ($dataProvider as $key => $value) {
            foreach ($dataDanhMuc as $k1 => $v1) {
                foreach ($v1 as $k2 => $v2) {
                    if ($value['loaiHoanThue']['maLyDoHoanThue'] == $v2[1]) {
                        if ($value['ngayTao'] >= $start && $value['ngayTao'] < $end) {
                            if ($value['soQdThanhTraId'] == null) {
                                $dataProviderFilter[$k1][$k2]['C']++;
                            } else {
                                $dataProviderFilter[$k1][$k2]['D']++;
                            }
                            $dataProviderFilter[$k1][$k2]['E']++;
                            $yearReport = (new \DateTime($end))->format('Y');
                            $yearCurrent = (new \DateTime($value['soVbHoanThue']['ngayVb']))->format('Y');
                            if ($yearReport == $yearCurrent) {
                                $dataProviderFilter[$k1][$k2]['H']++;
                                $dataProviderFilter[$k1][$k2]['I'] += changeDonVi($value['soThueDeNghiHoan'] - $value['soThueKhongDuocHoan']);
                            } else {
                                $dataProviderFilter[$k1][$k2]['J']++;
                                $dataProviderFilter[$k1][$k2]['K'] += changeDonVi($value['soThueDeNghiHoan'] - $value['soThueKhongDuocHoan']);
                            }
                            $dataProviderFilter[$k1][$k2]['L']++;
                            $dataProviderFilter[$k1][$k2]['M']++;
                            $dataProviderFilter[$k1][$k2]['N']++;
                            $dataProviderFilter[$k1][$k2]['O']++;
                            $dataProviderFilter[$k1][$k2]['P']++;
                            $dataProviderFilter[$k1][$k2]['F'] += $dataProviderFilter[$k1][$k2]['H'] + $dataProviderFilter[$k1][$k2]['J'];
                            $dataProviderFilter[$k1][$k2]['G'] += $dataProviderFilter[$k1][$k2]['I'] + $dataProviderFilter[$k1][$k2]['K'];
                        }
                        if ($value['ngayTao'] >= $startYear && $value['ngayTao'] < $end) {
                            if ($value['soQdThanhTraId'] == null) {
                                $dataProviderFilter[$k1][$k2]['L']++;
                            } else {
                                $dataProviderFilter[$k1][$k2]['M']++;
                            }
                            $dataProviderFilter[$k1][$k2]['N']++;
                            $dataProviderFilter[$k1][$k2]['O']++;
                            $dataProviderFilter[$k1][$k2]['P'] += changeDonVi($value['soThueDeNghiHoan'] - $value['soThueKhongDuocHoan']);
                        }
                    }
                }
            }
            foreach ($dataProviderFilter as $k1 => $v1) {
                foreach ($v1 as $k2 => $v2) {
                    $data = $dataColumm;
                    foreach ($data as $k3 => $v3) {
                        $data[$k3] = $dataProviderFilter[$k1][$k2][$k3];
                    }
                    $setCellValues->fromArray($data, null, 'C' . $dataDanhMuc[$k1][$k2][0]);
                }
            }
        }
        $newFile = './result/' . time() . $fileName;
        $objWriter = IOFactory::createWriter($objPhpExcel, $fileType);
        $objWriter->save($newFile);
        ExportExcelHelper::download($newFile);
    }
}