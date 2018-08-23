<?php

namespace app\helpers;

use app\models\Baocaobaohiemxahoi;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PHPExcel_IOFactory;
use yii\helpers\ArrayHelper;

class ExportExcelBaoCaoBaoHiemXaHoiTheoNamMoiHelper
{
    public static function exportExcel($dataProvider, $start, $end)
    {
        set_time_limit(-1);
        ini_set('memory_limit', '3G');

        $fileName = 'Mau-BC-BHXHKPCD-nam-2018.xlsx';
        $inputFileName = './excel/' . $fileName;
        $activeSheetIndex = 0;

        $attrBaocaobhxh = [
            'namKtbhxh' => 'G',
            'soBhxhPhaiNop' => 'M',
            'soBhxhDaNop' => 'N',
            'soKpcdPhaiNop' => 'P',
            'soKpcdDaNop' => 'Q',
            'laoDongTrichBhxh' => 'I',
            'laoDongChuaTrichBhxh' => 'J',
            'laoDongTrichKpcd' => 'K',
            'laoDongChuaTrichKpcd' => 'L',
            'ghiChu' => 'Y',
        ];

        $attrNguoiNt = [
            'maSoThue' => 'C',
            'tenNguoiNop' => 'B',
            'diaChi' => 'D',
            'tenNganhNgheKdChinh' => 'F'
        ];

        $attrCheck1 = [
            'J' => 'S',
            'L' => 'T',
            'O' => 'U',
            'R' => 'V',
        ];

        $dataTotal = [
            'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'W', 'X'
        ];

        $startDataRow = 10;
        $count = 0;
        $countNguoint = 1;
        $inputFileType = 'Xlsx';

        /** Load $inputFileName to a PHPExcel Object  **/
        $objReader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $objPHPExcel = $objReader->load($inputFileName);
        $objPHPExcel->setActiveSheetIndex($activeSheetIndex);
        $setCellValues = $objPHPExcel->getActiveSheet();
        $sheet = [];

        $dataNew = ExportExcelHelper::createData('A', 'AA');

        $configStyle = [];

        foreach ($dataProvider as $key => $value) {
            $data = $dataNew;
            $data['A'] = $countNguoint;

            foreach ($attrNguoiNt as $colNum => $colText) {
                $data[$colText] = $value['mst0'][$colNum];
            }
            $monthReport = explode('/', DateTimeHelpers::convertDate($value['soQdxl']['ngayQdXuLy']));
            $data['AA'] = $monthReport[1];

            foreach ($attrCheck1 as $colNum => $colText) {
                switch ($colText) {
                    case 'U':
                    case 'V':
                        $data[$colText] = "=IF((SUM(" . 'O' . ($startDataRow + $count) . ':' . 'O' . ($startDataRow + $count + count($value['baocaobaohiemxahoitheonams'])) . ")+SUM(" . 'R' . ($startDataRow + $count) . ':' . 'R' . ($startDataRow + $count + count($value['baocaobaohiemxahoitheonams'])) . "))>0,\"1\",\"\"" . ")";
                        break;
                    default:
                        $data[$colText] = "=IF((SUM(" . $colNum . ($startDataRow + $count) . ':' . $colNum . ($startDataRow + $count + count($value['baocaobaohiemxahoitheonams'])) . "))>0,\"1\",\"\"" . ")";
                        break;
                }
            }
            $baocaobaohiemxahoi = Baocaobaohiemxahoi::find()->where(['and', ['=', 'mst', $value['mst']], ['=', 'soQdxlId', $value['soQdxlId']]])->one();
            $data['Z'] = $baocaobaohiemxahoi['phongChiCucThue'];
            $data['Y'] = $baocaobaohiemxahoi['ghiChu'];

            $countYear = count($value['baocaobaohiemxahoitheonams']);
            $countYearNotNull = 0;
            for ($i = 0; $i < $countYear; $i++) {
                if ($value['baocaobaohiemxahoitheonams'][$i]['namKtbhxh'] != null) {
                    $countYearNotNull = $countYearNotNull + 1;
                }
            }
//            foreach ($dataTotal as $column) {
//                $data[$column] = "=SUM(" . $column . ($startDataRow + $count + 1) . ':' . $column . ($startDataRow + $countYear + $count + 1) . ")";
//            }

            foreach ($dataTotal as $column) {
                $data[$column] = "=SUM(" . $column . ($startDataRow + $countYearNotNull + $count) . ")";
            }
            $configStyle[] = $startDataRow + $count;
            $sheet[] = $data;
            $arrayNam = [];
//            for ($i = 0; $i < $countYear; $i++) {
//                $arrayNam[] = $value['baocaobaohiemxahoitheonams'][$i]['namKtbhxh'];
//                rsort($arrayNam);
//            }

            if ($value['baocaobaohiemxahoitheonams'][0]) {
                $data = $dataNew;
                foreach ($attrBaocaobhxh as $colNum => $colText) {
                    if ($value['baocaobaohiemxahoitheonams'][0]['namKtbhxh'] != null) {
                        $data[$colText] = $value['baocaobaohiemxahoitheonams'][0][$colNum];
                    }
                }
                $data['H'] = "=(" . 'I' . ($startDataRow + $count) . " + " . 'J' . ($startDataRow + $count) . ")";
                $data['O'] = "=(" . 'M' . ($startDataRow + $count) . " - " . 'N' . ($startDataRow + $count) . ")";
                $data['R'] = "=(" . 'P' . ($startDataRow + $count) . " - " . 'Q' . ($startDataRow + $count) . ")";
                $count++;
                $sheet[] = $data;
            }
            for ($i = 1; $i < $countYearNotNull; $i++) {
                $data = $dataNew;
                foreach ($attrBaocaobhxh as $colNum => $colText) {
                    if (isset($value['baocaobaohiemxahoitheonams'][$i]['namKtbhxh'])) {
                        $data[$colText] = $value['baocaobaohiemxahoitheonams'][$i][$colNum];
                        $data['H'] = "=(" . 'I' . ($startDataRow + $count) . " + " . 'J' . ($startDataRow + $count) . ")";
                        $data['O'] = "=(" . 'O' . ($startDataRow + $count - 1) . "+" . 'M' . ($startDataRow + $count) . " - " . 'N' . ($startDataRow + $count) . ")";
                        $data['R'] = "=(" . 'P' . ($startDataRow + $count) . " - " . 'Q' . ($startDataRow + $count) . ")";
                    }
                }
                $count++;
                $sheet[] = $data;
            }
            $count++;
            $countNguoint++;
        }

        if (count($sheet) > 1) {
            $setCellValues->insertNewRowBefore($startDataRow + 1, count($sheet) - 2);
        }

        $setCellValues->fromArray($sheet, null, 'A' . $startDataRow);
        $setCellValues->getStyle('M' . ($startDataRow) . ':R' . ($startDataRow + count($sheet)))->getNumberFormat()->setFormatCode('#,#');

        foreach ($configStyle as $key => $value) {
            $setCellValues->getRowDimension($value)->setRowHeight(-1);
        }

        $monthSheet = explode('/', DateTimeHelpers::convertDate($end));
        $monthStart = explode('/', DateTimeHelpers::convertDate($start));

        $objPHPExcel->setActiveSheetIndex(2);
        $objPHPExcel->getActiveSheet()->setCellValue('G4', $monthSheet[1]);

        $newFile = './result/' . time() . $fileName;
        $objWriter = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($objPHPExcel);
        $objWriter->setPreCalculateFormulas(false);
        $objWriter->save($newFile);
        ExportExcelHelper::download($newFile);
    }

}