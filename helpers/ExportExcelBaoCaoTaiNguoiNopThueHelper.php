<?php
/**
 * Created by PhpStorm.
 * User: haiye_000
 * Date: 4/9/2017
 * Time: 3:47 PM
 */

namespace app\helpers;

use PHPExcel_IOFactory;


class ExportExcelBaoCaoTaiNguoiNopThueHelper
{
    public static function exportExcel($dataProvider, $end)
    {
        function changeDonVi($tien)
        {
            return round(floatval($tien) / 1000, 3);
        }

        set_time_limit(2000);
        $fileName = 'Mau-10-Bao-cao-chi-tiet-KT-tai-ban.xlsx';
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

        $attrBaocaotnnt = [
            'nhiemVuKiemTra' => 'C',
            'soQdkt' => 'D',
            'ngayQdkt' => 'E',
            'tienDoThucHien' => 'H',
            'soQdXuLy' => 'J',
            'ngayQdxl' => 'K',
            'soKetLuan' => 'L',
            'ngayKetLuan' => 'M',
            'doanhNghiepCoViPham' => 'N',
            'soThueTruyThuVat' => 'Y',
            'soThueTruyThuTndn' => 'Z',
            'soThueTruyThuTncn' => 'AA',
            'soThueTruyThuTtdb' => 'AB',
            'soThueTruyThuKhac' => 'AC',
            'soThueKhongDuocHoan' => 'AD',
            'soThueTruyHoan' => 'AE',
            'anDinh' => 'AF',
            'tienPhat' => 'AH',
            'tienKkSai' => 'AI',
            'tienPhatNopCham' => 'AJ',
            'tienPhatViPhamHanhChinhKhac' => 'AK',
            'noDongNamTruoc' => 'AM',
            'noPhatSinhTrongNam' => 'AN',
            'daNopChoNoDongNamTruoc' => 'AO',
            'daNopPhatSinhTrongNam' => 'AP',
            'conPhaiNopDongNamTruoc' => 'AQ',
            'conPhaiNopPhatSinhTrongNam' => 'AR',
            'soThueDuocGiamTheoKeKhai' => 'AS',
            'soThueDuocGiamTheoTtkt' => 'AT',
            'chenhLech' => 'AU',
            'giamLo' => 'AV',
            'giamKhauTru' => 'AW',
        ];

        $attrInt = [
            'soThueTruyThuVat' => 'Y',
            'soThueTruyThuTndn' => 'Z',
            'soThueTruyThuTncn' => 'AA',
            'soThueTruyThuTtdb' => 'AB',
            'soThueTruyThuKhac' => 'AC',
            'soThueKhongDuocHoan' => 'AD',
            'soThueTruyHoan' => 'AE',
            'anDinh' => 'AF',
            'tienPhat' => 'AH',
            'tienKkSai' => 'AI',
            'tienPhatNopCham' => 'AJ',
            'tienPhatViPhamHanhChinhKhac' => 'AK',
            'noDongNamTruoc' => 'AM',
            'noPhatSinhTrongNam' => 'AN',
            'daNopChoNoDongNamTruoc' => 'AO',
            'daNopPhatSinhTrongNam' => 'AP',
            'conPhaiNopDongNamTruoc' => 'AQ',
            'conPhaiNopPhatSinhTrongNam' => 'AR',
            'soThueDuocGiamTheoKeKhai' => 'AS',
            'soThueDuocGiamTheoTtkt' => 'AT',
            'chenhLech' => 'AU',
            'giamLo' => 'AV',
            'giamKhauTru' => 'AW',
        ];

        $fileType = 'Excel2007';
        $objReader = PHPExcel_IOFactory::createReader($fileType);
        $objPhpExcel = $objReader->load('./excel/' . $fileName);

        $objPhpExcel->setActiveSheetIndex($activeSheetIndex);

        $setCellValues = $objPhpExcel->getActiveSheet();

        $year = explode('/', $end);
        $setCellValues->setCellValue('N4', 'Tháng ' . $year[1] . ' năm ' . $year[2]);

        $maChiTieu = [
            '0' => '10',
            '4' => '15',
            '5' => '18',
            '6' => '21',
            '7' => '24',
            '8' => '27',
            '9' => '30',
            '10' => '35',
            '11' => '38',
        ];

        $dataProviderFilter = [];
        $dataProviderFilter['after'][0][0] = [];
        $dataProviderFilter['before'] = [];

        foreach ($dataProvider as $key => $value) {

            $y = explode('/', $value['ngayQdkt']);

            if (1 < count($y) && $y[2] == $year[2]) {
                foreach ($maChiTieu as $id => $ma) {
                    if ($value['chiTieuKiemTraId'] == $id) {

                        if ((int)$y[1] == 1) {
                            if ($y[0] < 25) {
                                $dataProviderFilter['before'][$id][1][] = $value;
                            } else {
                                $dataProviderFilter['before'][$id][2][] = $value;
                            }
                        } elseif ((int)$y[1] == 12) {
                            $dataProviderFilter['before'][$id][] = $value;
                        } else {
                            if ($y[0] < 25) {
                                $dataProviderFilter['before'][$id][(int)$y[1]][] = $value;
                            } else {
                                $dataProviderFilter['before'][$id][intval($y[1]) + 1][] = $value;
                            }
                        }
                    }
                }
            } else {
                $dataProviderFilter['after'][0][0][] = $value;
            }

        }

        ksort($dataProviderFilter['before']);

        $change = 0;
        $startDataRow = 10;
        foreach ($dataProviderFilter as $key => $value) {
                foreach ($value as $k => $chitieu) {

                    $count = 0;
                    foreach ($maChiTieu as $id => $c) {

                        if ($k == $id) {

                            $startDataRow = $c + $change;
//                            echo 'startDataRow ' . $startDataRow.'<br>';
                            foreach ($chitieu as $x => $thang) {
                                $length = $key == 'after' ? count($thang)-1 : count($thang);
//                                echo 'length ' . $length .'<br>';
                                $setCellValues->insertNewRowBefore($startDataRow + $count, $length);
                                $change += $length;
//                                echo 'change ' . $change.'<br>';
                                if($key != 'after'){

                                    $setCellValues->setCellValue('B' . ($startDataRow + $count), 'Tháng ' . $x);
                                    foreach ($attrInt as $colNum => $colText) {
                                        $setCellValues->setCellValue($colText . ($startDataRow + $count), "=(SUM(" . $colText . ($startDataRow + 1) . " : " . $colText . ($startDataRow + count($thang)) . ")/1000)");
//                                        $setCellValues->getStyle($colText . ($startDataRow + $count))->getNumberFormat()->setFormatCode('#,#');
                                    }

                                    $setCellValues->getStyle('A' . ($startDataRow + $count) . ':AW' . ($startDataRow + $count))->applyFromArray($styleArray1);

                                    $count++;
                                }

                                foreach ($thang as $y => $giatri) {
                                    $setCellValues->setCellValue('G' . ($startDataRow + $count), empty($giatri['loaiNoiDungChuyenDe']) ? $giatri['loaiNoiDungChuyenDe']['loaiNd'] : '');

                                    $setCellValues->setCellValue('B' . ($startDataRow + $count), $giatri['nguoiNopThue']['tenNguoiNop']);
                                    $setCellValues->setCellValue('F' . ($startDataRow + $count), $giatri['nguoiNopThue']['maSoThue']);
                                    foreach ($attrBaocaotnnt as $colNum => $colText) {
                                        $setCellValues->setCellValue($colText . ($startDataRow + $count), $giatri[$colNum]);
                                    }

                                    foreach ($attrInt as $colNum => $colText) {
                                        $setCellValues->setCellValue($colText . ($startDataRow + $count), round($giatri[$colNum]/1000,3));
//                                        $setCellValues->getStyle($colText . ($startDataRow + $count))->getNumberFormat()->setFormatCode('#,#');
                                    }

                                    foreach ($loaiQuyMoColArray as $colNum => $colText) {
                                        if ($colNum == $giatri['loaiQuyMoDoanhNghiepId']) {
                                            $setCellValues->setCellValue($colText . ($startDataRow + $count), 1);
                                        }
                                    }

                                    foreach ($loaiKhuVucColArray as $colNum => $colText) {
                                        if ($colNum == $giatri['loaiQuyMoDoanhNghiepId']) {
                                            $setCellValues->setCellValue($colText . ($startDataRow + $count), 1);
                                        }
                                    }

                                    $setCellValues->getStyle('A' . ($startDataRow + $count) . ':AW' . ($startDataRow + $count))->applyFromArray($styleArray);
                                    $count++;
                                }
                            }

                            $name = $key != 'after' ? 'Công lũy kế từ đầu năm' : 'Công lũy kế';

                            $setCellValues->setCellValue('B' . ($startDataRow + $count),$name);
                            foreach ($attrInt as $colNum => $colText) {
                                if($key == 'after'){
                                    $setCellValues->setCellValue($colText . ($startDataRow + $count), "=(SUM(" . $colText . $startDataRow . " : " . $colText . ($startDataRow + $count - 1) . "))");
                                }
                                else{
                                    $setCellValues->setCellValue($colText . ($startDataRow + $count), "=(SUM(" . $colText . $startDataRow . " : " . $colText . ($startDataRow + $count - 1) . ")/2)");
                                }

//                                $setCellValues->getStyle($colText . ($startDataRow + $count))->getNumberFormat()->setFormatCode('#,#');
                            }

                            $setCellValues->getStyle('A' . ($startDataRow + $count) . ':AW' . ($startDataRow + $count))->applyFromArray($styleArray1);
                        }
                    }
                }

        }

        $newFile = './result/' . time() . $fileName;
        $objWriter = PHPExcel_IOFactory::createWriter($objPhpExcel, $fileType);
        $objWriter->save($newFile);
        ExportExcelHelper::download($newFile);

    }
}