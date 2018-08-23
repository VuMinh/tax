<?php
/**
 * Created by PhpStorm.
 * User: haiye_000
 * Date: 4/9/2017
 * Time: 3:47 PM
 */

namespace app\helpers;

use yii\helpers\ArrayHelper;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExportExcelDanhSachQuyetDinhTren30Ngay
{
    public static function exportExcel($dataProvider, $start)
    {
        set_time_limit(-1);
        $fileName = 'Mau 1-c Danh Sach Quyet Dinh Tren 30 ngay.xlsx';
        $inputFileName = './excel/' . $fileName;
        $activeSheetIndex = 0;
        $fileType = 'Xlsx';

        $startDataRow = 10;
        $count = 0;

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

        $key = ['F', 'G', 'H', 'I'];
        $year = [];
        if (isset($values['soQdkt']['ngayCongBoQdkt'])) {
            for ($i = 0; $i < 4; $i++) {
                $setCellValues->setCellValue($key[$i] . '8', 'Năm ' . ($yMax - 3));
                $year[$yMax - 3] = $key[$i];
                $yMax++;
            }
        } else {
            for ($i = 0; $i < 4; $i++) {
                $setCellValues->setCellValue($key[$i] . '8', 'Năm ' . ($yDefault - 3));
                $year[$yDefault - 3] = $key[$i];
                $yDefault++;
            }
        }


        $sheet = [];
        $dataNew = ExportExcelHelper::createData('A', 'R');

        $data = $dataNew;

        foreach ($data as $colNum => $colText) {
            switch ($colText) {
                case 'A':
                    $data[$colText] = 'Tổng';
                    break;
                case 'D':
                case 'E':
                case 'R':
                    break;
                case 'J':
                    $data[$colText] = "=SUM(" . 'K' . ($startDataRow - 1) . ":" . 'Q' . (count($dataProvider) - 1) . ")";
                    break;
                default:
                    $data[$colText] = "=SUM(" . $colText . ($startDataRow - 1) . ":" . $colText . (count($dataProvider) - 1) . ")";
                    break;
            }
        }

        $count++;

        foreach ($dataProvider as $key => $values) {
            $data = $dataNew;

            $temp = date('Y', strtotime($values['soQdkt']['ngayCongBoQdkt']));
//            $e = date('d/m/Y', strtotime($values['soQdkt']['ngayCongBoQdkt']));
            $ngayCongBoQdkt = DateTimeHelpers::convertDate($values['soQdkt']['ngayCongBoQdkt']);

            if (!empty($year[$temp])) {
                $data[$year[$temp]] = 1;
            }

            $data['A'] = $count;
            $data['B'] = $values['mst0']['maSoThue'];
            $data['C'] = $values['mst0']['tenNguoiNop'];
            $data['D'] = $values['soQdkt']['soQdKiemTra'];
            $data['E'] = $ngayCongBoQdkt;
            $data['K'] = $values['lydoxulychams']['vuongMacChinhSach'];
            $data['L'] = $values['lydoxulychams']['chuaThongNhatSoLieuGiaiTrinhCham'];
            $data['M'] = $values['lydoxulychams']['dvCoCongVanXinTamLui'];
            $data['N'] = $values['lydoxulychams']['doiChieuSoLieuVoiCucThue'];
            $data['O'] = $values['lydoxulychams']['chuyenHsSangCqCongAnThanhTra'];
            $data['P'] = $values['lydoxulychams']['motSoNnKhac'];
            $data['Q'] = $values['lydoxulychams']['toTrinhBcLanhDao'];
            $data['R'] = $values['lydoxulychams']['trichYeuNoiDungTonDong'];

            $sheet[] = $data;
            $count++;

        }

        $setCellValues->insertNewRowBefore($startDataRow + 1, count($sheet) - 1);
        $setCellValues->fromArray($sheet, null, 'A' . $startDataRow);

        for ($i = $startDataRow; $i < ($startDataRow + $count); $i++) {
            $setCellValues->getRowDimension($i)->setRowHeight(-1);
        }

        $newFile = './result/' . time() . $fileName;
        $objWriter = IOFactory::createWriter($objPHPExcel, $fileType);
        $objWriter->save($newFile);
        ExportExcelHelper::download($newFile);
    }
}