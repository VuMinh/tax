<?php
/**
 * Created by PhpStorm.
 * User: haiye_000
 * Date: 4/9/2017
 * Time: 3:47 PM
 */

namespace app\helpers;

use PHPExcel_IOFactory;


class ExportExcelBaoCaoChuyenCongAnHelper
{
    public static function exportExcel($dataProvider, $end)
    {
        set_time_limit(2000);
        $fileName = 'Mau-7-Bao-cao-chuyen-CQ-Cong-an.xlsx';
        $activeSheetIndex = 0;

        $styleArray = [
            'font' => [
                'bold' => false,
            ],
            'borders' => array(
                'allborders' => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN
                )
            ),
            'alignment' => array(
                'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )

        ];

        $styleArray1 = [
            'font' => [
                'bold' => true,
            ]
        ];

        $loaiKhuVucColArray = [
            '3' => 'S',
            '1' => 'V',
            '2' => 'W',
            '6' => 'U',
            '5' => 'T',
            '4' => 'R'
        ];

        $loaiQuyMoColArray = [
            '1' => 'O',
            '2' => 'P',
            '3' => 'Q',
        ];

        $attrNguoinopthue = [
            'tenNguoiNop' => 'C',
            'maSoThue' => 'D',
        ];

        $attrBaocaocca = [
            'soKetLuanThanhKiemTraDaBanHanh' => 'E',
            'ngayKetLuan' => 'F',
            'tongSoHoaDon' => 'G',
//            'doanhSo' => 'H',
//            'thueGtgt' => 'I',
            'ghiChu' => 'J',
        ];
        $attrDonVi = [
            'doanhSo' => 'H',
            'thueGtgt' => 'I',
        ];

        $attrInt = [
        ];

        $fileType = 'Excel2007';
        $objReader = PHPExcel_IOFactory::createReader($fileType);
        $objPhpExcel = $objReader->load('./excel/' . $fileName);

        $objPhpExcel->setActiveSheetIndex($activeSheetIndex);

        $setCellValues = $objPhpExcel->getActiveSheet();

        $startDataRow = 5;
        $count =0;

        if(count($dataProvider) >2){
            $setCellValues->insertNewRowBefore($startDataRow + $count+1, count($dataProvider)-2);
        }

        foreach ($dataProvider as $key => $value) {
            $setCellValues->setCellValue('B' . ($startDataRow + $count), $key+1);

            foreach ($attrBaocaocca as $colNum => $colText) {
                $setCellValues->setCellValue('F' . ($startDataRow + $count ), DateTimeHelpers::convertDate($value['ngayKetLuan']));
                $setCellValues->setCellValue($colText . ($startDataRow + $count), $value[$colNum]);
            }

            foreach ($attrDonVi as $dv => $colText) {
                $setCellValues->setCellValue($colText . ($startDataRow + $count), round($value[$dv] / 1000, 3));
            }

            foreach ($attrNguoinopthue as $colNum => $colText) {
                $setCellValues->setCellValue($colText . ($startDataRow + $count), $value['mst0'][$colNum]);
            }
//            $setCellValues->getStyle('F' . ($startDataRow + $count))->getNumberFormat()->setFormatCode(\PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDD2);
            $count++;
        }

        $setCellValues->setCellValue('G' . ($startDataRow + $count), "=(SUM(" . 'G' . ($startDataRow) . " : " . 'G' . ($startDataRow + $count-1) . "))");
        $setCellValues->setCellValue('H' . ($startDataRow + $count), "=(SUM(" . 'H' . ($startDataRow) . " : " . 'H' . ($startDataRow + $count-1) . "))");
        $setCellValues->setCellValue('I' . ($startDataRow + $count), "=(SUM(" . 'I' . ($startDataRow) . " : " . 'I' . ($startDataRow + $count-1) . "))");

        $newFile = './result/' . time() . $fileName;
        $objWriter = PHPExcel_IOFactory::createWriter($objPhpExcel, $fileType);
        $objWriter->save($newFile);
        ExportExcelHelper::download($newFile);


    }


}