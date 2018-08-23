<?php

namespace app\helpers;

use PHPExcel_IOFactory;
use PHPExcel_Style_Alignment;

class ExportExcelBaoCaoSoTonHelper
{
    public static function exportExcel($dataProvider, $year)
    {
        $fileName = "Mau-12-bc-so-ton.xlsx";
        $activeSheetIndex = 0;

        $styleArray = [
            'font' => [
                'bold' => false,
            ],
            'borders' => [
                'allborders' => [
                    'style' => \PHPExcel_Style_Border::BORDER_THIN
                ]
            ]
        ];

        $yearRow = [
            '1' => 'N3',
            '2' => 'Q3',
            '3' => 'T3',
            '4' => 'W3',
            '5' => 'Z3',
            '6' => 'AC3',
            '7' => 'AF3',
            '8' => 'AH3',
            '9' => 'AL3',
            '10' => 'AO3',
            '11' => 'AR3',
            '12' => 'AU3',
        ];

        $xlsColArray = [
            '01' => ['N', 'O', 'P'],
            '02' => ['Q', 'R', 'S'],
            '03' => ['T', 'U', 'V'],
            '04' => ['W', 'X', 'Y'],
            '05' => ['Z', 'AA', 'AB'],
            '06' => ['AC', 'AD', 'AE'],
            '07' => ['AF', 'AG', 'AH'],
            '08' => ['AH', 'AJ', 'AK'],
            '09' => ['AL', 'AM', 'AN'],
            '10' => ['AO', 'AP', 'AQ'],
            '11' => ['AR', 'AS', 'AT'],
            '12' => ['AU', 'AV', 'AW'],
        ];
        $plus = [
            'truyThuThueGtgt', 'truyThuThueTndn', 'truyThuThueTncn', 'truyThuThueKhac', 'truyHoanThueGtgt', 'truyHoanThueTncn', 'truyHoanThueKhac', 'phatTronThue', 'phatHanhChinhKhac1020', 'phatChamNop', 'phatKhac',
            'noDongNamTruocChuyenSang', 'noDongPhatSinhTrongNam'
        ];

        $minus = [
            'daNopDongNamTruoc', 'daNopPhatSinhTruyThu', 'daNopPhatSinhTruyHoan', 'daNopTienPhat'
        ];

        $startDataRow = 6;
        $fileType = 'Excel2007';
        $objReader = PHPExcel_IOFactory::createReader($fileType);
        $objPhpExcel = $objReader->load('./excel/' . $fileName);

        $objPhpExcel->setActiveSheetIndex($activeSheetIndex);

        $setCellValues = $objPhpExcel->getActiveSheet();

        $count = 0;

        foreach ($yearRow as $key => $value) {
            $setCellValues->setCellValue($value, 'Tháng ' . $key . '/' . $year);
        }

        foreach ($dataProvider as $key => $value) {
            foreach ($value as $month => $row) {
                $sum = 0;
                foreach ($row as $x => $y) {
                    foreach ($plus as $i => $j) {
                        $sum += $y[$j];
                    }

                    foreach ($minus as $i => $j) {
                        $sum -= $y['lichsunopsaukiemtra'][$j];
                    }
                }

                $setCellValues->setCellValue('A' . ($startDataRow + $count), $count + 1);
                $setCellValues->duplicateStyle($setCellValues->getStyle('A' . $startDataRow), 'A' . ($startDataRow + $count));

                $setCellValues->setCellValue('B' . ($startDataRow + $count), $key);
                $setCellValues->duplicateStyle($setCellValues->getStyle('B' . $startDataRow), 'B' . ($startDataRow + $count));

                $setCellValues->setCellValue('C' . ($startDataRow + $count), $row[0]['mst0']['tenNguoiNop']);
                $setCellValues->duplicateStyle($setCellValues->getStyle('C' . $startDataRow), 'C' . ($startDataRow + $count));

                $setCellValues->setCellValue('AX' . ($startDataRow + $count), $row[0]['ghiChu']);
                $setCellValues->duplicateStyle($setCellValues->getStyle('AX' . $startDataRow), 'AX' . ($startDataRow + $count));

                $setCellValues->setCellValue('AY' . ($startDataRow + $count), $row[0]['doiKiemTra']);
                $setCellValues->duplicateStyle($setCellValues->getStyle('AY' . $startDataRow), 'AY' . ($startDataRow + $count));

                $setCellValues->setCellValue($xlsColArray[$month][0] . ($startDataRow + $count), count($row));

                $setCellValues->setCellValue($xlsColArray[$month][1] . ($startDataRow + $count), "=IF(" . $xlsColArray[$month][0] . '' . ($startDataRow + $count) . ">0,1,\"\")");

                $setCellValues->setCellValue($xlsColArray[$month][2] . ($startDataRow + $count), round($sum / 1000000, 3));

            }

            foreach ($xlsColArray as $x => $y) {
                foreach ($y as $key => $value) {
                    $setCellValues->duplicateStyle($setCellValues->getStyle($value . $startDataRow), $value . ($startDataRow + $count));
                }
            }

            $count++;
        }

        $setCellValues->getStyle('A' . ($startDataRow) . ':AY' . ($startDataRow + $count - 1))->applyFromArray($styleArray);

        for ($i = $startDataRow; $i < $startDataRow + $count; $i++) {
            $setCellValues->getRowDimension($i)->setRowHeight(-1);
        }

        $newFile = './result/' . time() . $fileName;

        $objWriter = PHPExcel_IOFactory::createWriter($objPhpExcel, $fileType);
        $objWriter->save($newFile);

        ExportExcelHelper::download($newFile);
    }

}