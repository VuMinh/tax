<?php

namespace app\helpers;

use PhpOffice\PhpSpreadsheet\IOFactory;

class ExportExcelBaoCaoHanhViViPhamHelper
{
    public static function exportExcel($dataProvider, $start, $end)
    {
        $fileName = "Mau-3-bao-cao-hanh-vi-vi-pham-24-hang-thang.xlsx";
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

        $attrToColumns = [
//            'doiKiemTra' => 'A',
//            'nganhNgheKinhDoanh' => 'D',
            'hanhViViPham' => 'AW',
            'moTaCachThucPhatHien' => 'AX',
            'doiKiemTra' => 'AY',
        ];
        $attrNganhnghe = [
            'tenNganhNgheKdChinh' => 'D',
        ];

        $attrNguoiNt = [
            'maSoThue' => 'B',
            'tenNguoiNop' => 'C',
        ];

        $attrQuyetDkt = [
            'soQdKiemTra' => 'E',
            'ngayQdKiemTra' => 'F',
            'noDongKyTruocChuyenSang' => 'G',
            'phatSinhTrongKy' => 'H',
            'nienDoKiemTra' => 'I',
        ];

        $startDataRow = 10;
        $count = 0;
        $inputFileType = 'Xlsx';
        $objReader = IOFactory::createReader($inputFileType);
        $objPhpExcel = $objReader->load('./excel/' . $fileName);

        $objPhpExcel->setActiveSheetIndex($activeSheetIndex);

        $setCellValues = $objPhpExcel->getActiveSheet();

        $s = explode("/", $start);
        $e = explode("/", $end);

        $month1 = $s[1] . '/' . $s[2];
        $month2 = $e[1] . '/' . $e[2];

        if ($month1 == $month2) {
            $string = 'Tháng ' . $month1;
        } else {
            $string = 'Tháng ' . $month1 . ' - ' . 'Tháng ' . $month2;
        }

        $setCellValues->setCellValue('A4', $string);

        $sheet = [];

        $dataNew = ExportExcelHelper::createData('A', 'AY');

        foreach ($dataProvider as $key => $value) {
            $data = $dataNew;
            foreach ($attrToColumns as $attr => $column) {
                $data[$column] = $value[$attr];
            }

            foreach ($attrNguoiNt as $attr => $column) {
                $data[$column] = $value['mst0'][$attr];
            }

            foreach ($attrQuyetDkt as $attr => $column) {
                $data[$column] = $value['soQdkt'][$attr];
            }

            if ($value['soQdkt']['truongDoan']) {
                $data['J'] = $value['soQdkt']['truongDoan']['truongDoan'];
            }
            foreach ($attrNganhnghe as $attr => $column) {
                $data[$column] = $value['nganhNghe'][$attr];
            }
            $data['A'] = $count + 1;

            $sheet[] = $data;
            $count++;
        }

        $setCellValues->fromArray($sheet, null, 'A' . $startDataRow);

        $setCellValues->getStyle('A' . ($startDataRow) . ':AY' . ($startDataRow + $count - 1))->applyFromArray($styleArray);

        $newFile = './result/' . time() . $fileName;

        $objWriter = IOFactory::createWriter($objPhpExcel, $inputFileType);
        $objWriter->save($newFile);

        ExportExcelHelper::download($newFile);
    }
}