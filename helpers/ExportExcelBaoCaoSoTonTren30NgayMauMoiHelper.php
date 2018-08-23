<?php
/**
 * Created by PhpStorm.
 * User: MinhVT
 * Date: 1/30/2018
 * Time: 3:15 PM
 */

namespace app\helpers;

use yii\helpers\ArrayHelper;
use PhpOffice\PhpSpreadsheet\IOFactory;


class ExportExcelBaoCaoSoTonTren30NgayMauMoiHelper
{
    public static function exportExcel($dataProvider, $start)
    {
        set_time_limit(-1);
        $fileName = "Bao-cao-ton-tren-30-ngay-mau-moi.xlsx";
        $inputFileName = './excel/' . $fileName;
        $activeSheetIndex = 0;
        $fileType = "Xlsx";

        $startDataRow = 9;
        $count = 0;

        /** Load inputFile to PhpExcel Object*/

        $objReader = IOFactory::createReader($fileType);
        $objPHPExcel = $objReader->load($inputFileName);
        $setCellValues = $objPHPExcel->getActiveSheet();
        $objPHPExcel->setActiveSheetIndex($activeSheetIndex);

        $yMax = 0;
        $yDefault = 2018;

        foreach ($dataProvider as $key => $values) {
//            $temp = date('Y', strtotime($values['soQdkt']['ngayCongBoQdkt']));
            if (isset($values['soQdkt']['ngayCongBoQdkt'])) {
                $tem = explode('/', DateTimeHelpers::convertDate($values['soQdkt']['ngayCongBoQdkt']));
                $year = $tem[2];
                if ($year > $yMax) {
                    $yMax = $year;
                }
            } else {
                $yDefault = 2018;
            }
        }

        $key = ['H', 'I', 'J', 'K', 'L', 'M'];
        $year = [];

        if (isset($values['soQdkt']['ngayCongBoQdkt'])) {
            for ($i = 0; $i < 6; $i++) {
                var_dump($key[$i]);
                if ($i == 0) {
                    $setCellValues->setCellValue($key[$i] . '8', 'Trước năm ' . ($yMax - 4));
                    $year[$yMax - 4] = $key[$i];
                } else {
                    $setCellValues->setCellValue($key[$i] . '8', 'Năm ' . ($yMax - 4));
                    $year[$yMax - 4] = $key[$i];
                    $yMax++;
                }

            }
        } else {
            for ($i = 0; $i < 6; $i++) {
                if ($i == 0) {
                    $setCellValues->setCellValue($key[$i] . '8', 'Trước năm ' . ($yDefault - 4));
                    $year[$yDefault - 4] = $key[$i];
                } else {
                    $setCellValues->setCellValue($key[$i] . '8', 'Năm ' . ($yDefault - 4));
                    $year[$yDefault - 4] = $key[$i];
                    $yDefault++;
                }
            }
        }


        $sheet = [];
        $dataNew = ExportExcelHelper::createData('A', 'V');

        $data = $dataNew;

//        foreach ($data as $colNum => $colText) {
//            switch ($colNum) {
//                case 'A':
//                    $data[$colText] = 'Tổng';
//                    break;
//                case 'E':
//                case 'F':
//                case 'V':
//                    break;
//                case 'G':
//                    $data[$colText] = "=SUM(" . 'H' . ($startDataRow - 1) . ":" . 'M' . (count($dataProvider) - 1) . ")";
//                    break;
//                case 'N':
//                    $data[$colText] = "=SUM(" . 'O' . ($startDataRow - 1) . ":" . 'U' . (count($dataProvider) - 1) . ")";
//                    break;
//                default:
//                    $data[$colText] = "=SUM(" . $colText . ($startDataRow - 1) . ":" . $colText . (count($dataProvider) - 1) . ")";
//                    break;
//            }
//        }
        $sheet[] = $data;
        $count++;

        foreach ($dataProvider as $key => $values) {
            $data = $dataNew;

            $temp = date('Y', strtotime($values['soQdkt']['ngayCongBoQdkt']));
//            $e = date('d/m/Y', strtotime($values['soQdkt']['ngayCongBoQdkt']));
            $ngayCongBoQdkt = DateTimeHelpers::convertDate($values['soQdkt']['ngayCongBoQdkt']);

            if (!empty($year[$temp])) {
                $data[$year[$temp]] = 1;
            }

            foreach ($data as $col => $text) {
                switch ($col) {
                    case 'A':
                        $data[$col] = $count;
                        break;
                    case 'B':
                        $data[$col] = $values['chiCucThue'];
                        break;
                    case 'C':
                        $data[$col] = $values['mst0']['maSoThue'];
                        break;
                    case 'D':
                        $data[$col] = $values['mst0']['tenNguoiNop'];
                        break;
                    case 'E':
                        $data[$col] = $values['soQdkt']['soQdKiemTra'];
                        break;
                    case 'F':
                        $data[$col] = $ngayCongBoQdkt;
                        break;
                    case 'O':
                        $data[$col] = $values['lydoxulychams']['vuongMacChinhSach'];
                        break;
                    case 'P':
                        $data[$col] = $values['lydoxulychams']['chuaThongNhatSoLieuGiaiTrinhCham'];
                        break;
                    case 'Q':
                        $data[$col] = $values['lydoxulychams']['dvCoCongVanXinTamLui'];
                        break;
                    case 'R':
                        $data[$col] = $values['lydoxulychams']['doiChieuSoLieuVoiCucThue'];
                        break;
                    case 'S':
                        $data[$col] = $values['lydoxulychams']['chuyenHsSangCqCongAnThanhTra'];
                        break;
                    case 'T':
                        $data[$col] = $values['lydoxulychams']['motSoNnKhac'];
                        break;
                    case 'U':
                        $data[$col] = $values['lydoxulychams']['toTrinhBcLanhDao'];
                        break;
                    case 'V':
                        $data[$col] = $values['lydoxulychams']['trichYeuNoiDungTonDong'];
                        break;
                    case 'G':
                        $data[$col] = "=SUM(" . 'H' . ($startDataRow + $count) . ":" . 'M' . ($startDataRow + $count) . ")";
                        break;
                    case 'N':
                        $data[$col] = "=SUM(" . 'O' . ($startDataRow + $count) . ":" . 'U' . ($startDataRow + $count) . ")";
                        break;
                }

            }

            $sheet[] = $data;
            $count++;

        }

        $setCellValues->insertNewRowBefore($startDataRow + 1, count($sheet) - 2);
        $setCellValues->fromArray($sheet, null, 'A' . ($startDataRow - 1));

//        $setCellValues->mergeCells("A" . $startDataRow . ":D" . $startDataRow);
//        for ($i = $startDataRow; $i < ($startDataRow + $count); $i++) {
//            $setCellValues->getRowDimension($i)->setRowHeight(-1);
//        }

        $newFile = './result/' . time() . $fileName;
        $objWriter = IOFactory::createWriter($objPHPExcel, $fileType);
        $objWriter->save($newFile);
        ExportExcelHelper::download($newFile);
    }

}