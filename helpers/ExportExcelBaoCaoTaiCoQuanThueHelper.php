<?php
/**
 * Created by PhpStorm.
 * User: haiye_000
 * Date: 4/9/2017
 * Time: 3:47 PM
 */

namespace app\helpers;

use PhpOffice\PhpSpreadsheet\IOFactory;

class ExportExcelBaoCaoTaiCoQuanThueHelper
{
    public static function exportExcel($dataProvider,$end)
    {
        set_time_limit(2000);
        $fileName = 'Mau-9-Bao-cao-chi-tiet-KT-tai-ban.xlsx';
        $activeSheetIndex = 0;

        $styleArray = [
            'font' => [
                'bold' => true,
            ]
        ];

        $attrTrangthaihs = [
            '1' => 'D',
            '2' => 'E',
            '3' => 'F',
            '4' => 'G',
            '5' => 'H',
        ];

        $attrBaocaotcqt = [
            'tongThueDieuChinhTang' => 'I',
            'tongThueDieuChinhGiam' => 'J',
            'anDinh' => 'K',
            'giamKhauTru' => 'L',
            'giamLo' => 'M',
            'tienDuocMineTang' => 'N',
            'tienDuocMienGiam' => 'O',
        ];

        $startDataRow = 17;
        $fileType = 'Xlsx';

        $objReader = IOFactory::createReader($fileType);
        $objPhpExcel = $objReader->load('./excel/' . $fileName);

        $objPhpExcel->setActiveSheetIndex($activeSheetIndex);

        $setCellValues = $objPhpExcel->getActiveSheet();

        $year = explode('/',$end);
        $setCellValues->setCellValue('A4', 'Tháng '.$year[1].' năm '.$year[2]);

        $count = 0;

        $sheet = [];

        $dataNew = ExportExcelHelper::createData('A', 'O');

        $configStyle = [];
        $configStyle[] = $startDataRow-1;

        $data = $dataNew;

        foreach ($attrBaocaotcqt as $colNum => $colText) {
            $data[$colText] = "=(SUM(" . $colText . $startDataRow . " : " . $colText . ($startDataRow+count($dataProvider)-1) . "))";

        }

        foreach ($attrTrangthaihs as $colNum => $colText) {
            $data[$colText] = "=(SUM(" . $colText . $startDataRow . " : " . $colText . ($startDataRow+count($dataProvider)-1) . "))";
        }

        $data['C'] =  "=(SUM(" . 'D' . ($startDataRow-1) . " : " . 'H' . ($startDataRow-1) . "))";
        $sheet[] = $data;

        foreach($dataProvider as $key => $value){
            $data = $dataNew;

            foreach ($attrBaocaotcqt as $colNum => $colText) {
                $data[$colText] = $value[$colNum]/1000;
            }

            foreach ($attrTrangthaihs as $colNum => $colText) {
                if($value['trangThaiHoSoId'] == $colNum){
                    $data[$colText] = 1;
                }
            }

            $data['B'] = $value['nguoiNopThue']['maSoThue'];

            $sheet[] = $data;
        }


        if (count($dataProvider) > 1) {
            $setCellValues->insertNewRowBefore($startDataRow, count($sheet) - 2);
        }

        $setCellValues->getStyle('I'.($startDataRow-1).':O'.($startDataRow+count($dataProvider)-1))->getNumberFormat()->setFormatCode('#,#');

        $setCellValues->fromArray($sheet, null, 'A'.($startDataRow-1));

        foreach ($configStyle as $key => $value){
            $setCellValues->getStyle('C'.($value).':O'.($value))->applyFromArray($styleArray);
        }

        $newFile = './result/' . time() . $fileName;
        $objWriter = IOFactory::createWriter($objPhpExcel, $fileType);
        $objWriter->save($newFile);
        ExportExcelHelper::download($newFile);
    }

}