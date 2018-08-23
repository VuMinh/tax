<?php

namespace app\helpers;

use PHPExcel_IOFactory;
use PHPExcel_Style_NumberFormat;
use DateTime;

class ExportExcelBaoCaoKiemTraHelper1
{
    public static function exportExcel($dataProvider, $start, $end)
    {
        $endDate = DateTime::createFromFormat('Y-m-d H:i:s', $end);
        $month = (int)$endDate->format('m');
        $year = (int)$endDate->format('Y');

        $styleArray = [
            'font' => [
                'bold' => true,
            ],
            'borders' => [
                'allborders' => [
                'style' => \PHPExcel_Style_Border::BORDER_THIN
                ]
            ]
        ];

        $styleArray1 = [
            'borders' => array(
                'allborders' => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN
                )
            )
        ];

        $fileName = "Mau-2-bao-cao-kiem-tra.xlsx";
        $activeSheetIndex = 0;

        $xlsColArray = [
            'AV', 'AW', 'BB', 'BF', 'BK', 'BN', 'BP', 'BT', 'BU', 'BV', 'Q', 'N'
        ];

        $loaiKhuVucColArray = [
            '1' => 'T',
            '2' => 'U',
            '3' => 'V',
            '4' => 'W',
        ];

        $loaiQuyMoColArray = [
            '1' => 'X',
            '2' => 'Y',
            '3' => 'Z',
        ];

        $loaiNoiDungColArray = [
            '1' => 'AA',
            '2' => 'AB',
            '3' => 'AC',
            '4' => 'AD',
            '5' => 'AE',
            '6' => 'AF',
            '7' => 'AG',
            '8' => 'AH',
            '9' => 'AI',
            '10' => 'AJ',
            '11' => 'AK',
            '12' => 'AL',
            '13' => 'AM',
            '14' => 'AN',
            '15' => 'AO',
            '16' => 'AP',
            '17' => 'AQ',
        ];

        $attrBaocaoKt = [
            'doiKiemTra' => 'A',
            'dangKiemTra' => 'M',
            'nganhNgheKinhDoanh' => 'D',
            'hoanThanhChoNoDongKiTruoc' => 'O',
            'hoanThanhChoPhatSinhTrongKi' => 'P',
            'kiemTraTheoQuyetToanChiDao' => 'AR',
            'ngayKyBbkt' => 'AS',
            'truyThuThueGtgt' => 'AX',
            'truyThuThueTndn' => 'AY',
            'truyThuThueTncn' => 'AZ',
            'truyThuThueKhac' => 'BA',
            'truyHoanThueGtgt' => 'BC',
            'truyHoanThueTncn' => 'BD',
            'truyHoanThueKhac' => 'BE',
            'phatTronThue' => 'BG',
            'phatHanhChinhKhac1020' => 'BH',
            'phatChamNop' => 'BI',
            'phatKhac' => 'BJ',
            'noDongNamTruocChuyenSang' => 'BL',
            'noDongPhatSinhTrongNam' => 'BM',
            'thueMienGiamTheoKeKhai' => 'BW',
            'thueMienGiamTheoKiemTra' => 'BX',
            'mienGiamChenhLech' => 'BY',
            'giamKhauTru' => 'BZ',
            'thueKhongDuocHoan' => 'CA',
            'giamLo' => 'CB',
            'ghiChu' => 'CC',
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
            'ngayCongBoQdkt' => 'K',
            'ngayTrinhVbTamDungKt' => 'L',
        ];

        $attrQuyetDxl = [
            'soQdXuLy' => 'AT',
            'ngayQdXuLy' => 'AU',
        ];

        $attrLichsn = [
            'daNopDongNamTruoc' => 'BO',
            'daNopPhatSinhTruyThu' => 'BQ',
            'daNopPhatSinhTruyHoan' => 'BR',
            'daNopTienPhat' => 'BS',
        ];

        $startDataRow = 11;
        $fileType = 'Excel2007';
        $objReader = PHPExcel_IOFactory::createReader($fileType);
        $objPhpExcel = $objReader->load('./excel/' . $fileName);

        $objPhpExcel->setActiveSheetIndex($activeSheetIndex);

        $setCellValues = $objPhpExcel->getActiveSheet();
        $setCellValues->setCellValue('A3', 'BÁO CÁO CHI TIẾT KẾT QUẢ KIỂM TRA TẠI TRỤ SỞ NGƯỜI NỘP THUẾ NĂM '.$year);
        $count = 0;
        $dataToYear = array();
        $dataLastYear = array();
        foreach ($dataProvider as $key => $value) {
            $y = explode('/', $value['soQdkt']['ngayQdKiemTra']);

            if (1 < count($y) && $y[2] == $year) {
                $dataToYear[] = $value;
            } else {
                $dataLastYear[$key] = $value;
            }

        }

        $month = array();
        foreach ($dataToYear as $key => $value) {
            $y = explode('/', $value['soQdkt']['ngayQdKiemTra']);
            if ((int)$y[1] == 1) {
                if ($y[0] < 25) {
                    $month[1] [] = $value;
                } else {
                    $month[2] [] = $value;
                }
            } elseif ((int)$y[1] == 12) {
                $month[12] [] = $value;
            } else {
                if ($y[0] < 25) {
                    $month[(int)$y[1]][] = $value;
                } else {
                    $month[intval($y[1]) + 1][] = $value;
                }
            }
        }

        /*
         * Count and sum value
         * */
        $ARR = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
        foreach ($ARR as $text => $abc) {
            switch ($abc) {
                case 'A' :
                case 'B' :
                case 'D' :
                case 'E' :
                case 'F' :
                case 'K' :
                    break;
                case 'C' :
                    $setCellValues->setCellValue('C' . $startDataRow, 'Các kì trước chuyển sang');
                    break;
                default:
                    $setCellValues->setCellValue($abc . ($startDataRow), "=SUM(" . $abc . ($startDataRow + 1) . " : " . $abc . ($startDataRow + count($dataLastYear)) . ")");
            }
        }

        foreach ($ARR as $text => $abc) {
            $setCellValues->setCellValue('A' . $abc . $startDataRow, "=SUM(" . 'A' . $abc . ($startDataRow + 1) . " : " . 'A' . $abc . ($startDataRow + count($dataLastYear)) . ")");
        }

        foreach ($ARR as $text => $abc) {
            $setCellValues->setCellValue('B' . $abc . $startDataRow, "=SUM(" . 'B' . $abc . ($startDataRow + 1) . " : " . 'B' . $abc . ($startDataRow + count($dataLastYear)) . ")");
        }

        $setCellValues->setCellValue('CA' . $startDataRow, "=SUM(" . 'CA' . $startDataRow . " : " . 'CA' . ($startDataRow + count($dataLastYear)) . ")");
        $setCellValues->setCellValue('CB' . $startDataRow, "=SUM(" . 'CB' . $startDataRow . " : " . 'CB' . ($startDataRow + count($dataLastYear)) . ")");
        $setCellValues->setCellValue('CC' . $startDataRow, "=SUM(" . 'CC' . $startDataRow . " : " . 'CC' . ($startDataRow + count($dataLastYear)) . ")");

        $setCellValues->getStyle('A'.($startDataRow+$count).':CC'.($startDataRow+$count))->applyFromArray($styleArray);

        $count++;

        foreach ($dataLastYear as $key => $value) {
            foreach ($xlsColArray as $colNum => $colText) {
                switch ($colText) {
                    case 'N':
                        $setCellValues->setCellValue($colText . ($startDataRow + $count), "=IF(OR(O" . ($startDataRow + $count) . "=1,P" . ($startDataRow + $count) . "=1),1,\"\")");
                        break;
                    case 'Q':
                        $setCellValues->setCellValue($colText . ($startDataRow + $count), "=IF(" . 'AV' . ($startDataRow + $count) . ">0,1,\"\"" . ")");
                        break;
                    case 'AV':
                        $setCellValues->setCellValue($colText . ($startDataRow + $count), "=SUM(" . 'AW' . ($startDataRow + $count) . "+" . 'BB' . ($startDataRow + $count) . "+" . 'BF' . ($startDataRow + $count) . ")");
                        break;
                    case 'AW':
                        $setCellValues->setCellValue($colText . ($startDataRow + $count), "=SUM(" . 'AX' . ($startDataRow + $count) . "+" . 'AY' . ($startDataRow + $count) . "+" . 'AZ' . ($startDataRow + $count) . "+" . 'BA' . ($startDataRow + $count) . ")");
                        break;
                    case 'BB':
                        $setCellValues->setCellValue($colText . ($startDataRow + $count), "=SUM(" . 'BC' . ($startDataRow + $count) . "+" . 'BD' . ($startDataRow + $count) . "+" . 'BE' . ($startDataRow + $count) . ")");
                        break;
                    case 'BF':
                        $setCellValues->setCellValue($colText . ($startDataRow + $count), "=SUM(" . 'BG' . ($startDataRow + $count) . "+" . 'BH' . ($startDataRow + $count) . "+" . 'BI' . ($startDataRow + $count) . "+" . 'BJ' . ($startDataRow + $count) . ")");
                        break;
                    case 'BK':
                        $setCellValues->setCellValue($colText . ($startDataRow + $count), "=SUM(" . 'BL' . ($startDataRow + $count) . "+" . 'BM' . ($startDataRow + $count) . ")");
                        break;
                    case 'BN':
                        $setCellValues->setCellValue($colText . ($startDataRow + $count), "=SUM(" . 'BO' . ($startDataRow + $count) . "+" . 'BP' . ($startDataRow + $count) . ")");
                        break;
                    case 'BP':
                        $setCellValues->setCellValue($colText . ($startDataRow + $count), "=SUM(" . 'BQ' . ($startDataRow + $count) . "+" . 'BR' . ($startDataRow + $count) . "+" . 'BS' . ($startDataRow + $count) . ")");
                        break;
                    case 'BT':
                        $setCellValues->setCellValue($colText . ($startDataRow + $count), "=SUM(" . 'BU' . ($startDataRow + $count) . "+" . 'BV' . ($startDataRow + $count) . ")");
                        break;
                    case 'BU':
                        $setCellValues->setCellValue($colText . ($startDataRow + $count), "=SUM(" . 'BL' . ($startDataRow + $count) . "-" . 'BO' . ($startDataRow + $count) . ")");
                        break;
                    case 'BV':
                        $setCellValues->setCellValue($colText . ($startDataRow + $count), "=SUM(" . 'AV' . ($startDataRow + $count) . "+" . 'BM' . ($startDataRow + $count) . "-" . 'BP' . ($startDataRow + $count) . ")");
                        break;
                }
            }

            if ($value['soQdkt']['truongDoan']) {
                $setCellValues->setCellValue('J' . ($startDataRow + $count), $value['soQdkt']['truongDoan']['truongDoan']);
            }


            if ($value['qdHtThuocKhRuiRoTrongNam'] == 1) {
                $setCellValues->setCellValue('R' . ($startDataRow + $count), 1);
            } else {
                $setCellValues->setCellValue('S' . ($startDataRow + $count), 1);
            }

            $hoanThanhTrongKy = array_key_exists('soQdkt', $value) && array_key_exists('soQdXuLy', $value) &&
                $value['soQdkt']['ngayQdKiemTra'] && $value['soQdXuLy']['ngayQdXuLy'] &&
                DateTimeHelpers::kiemTra2NgayTrongKy($value['soQdkt']['ngayQdKiemTra'], $value['soQdXuLy']['ngayQdXuLy']);

            foreach ($attrBaocaoKt as $attr => $column) {
                switch ($attr) {
                    case 'nganhNgheKinhDoanh':
                        $setCellValues->setCellValue($column . ($startDataRow + $count), $value['nganhNghe'] ? $value['nganhNghe']['maNganhNgheKdChinh'] : null);
                        break;
                    case 'hoanThanhChoNoDongKiTruoc':
                        if(array_key_exists('soQdXuLy', $value) && $value['soQdXuLy']['ngayQdXuLy'] && !$hoanThanhTrongKy) {
                            $setCellValues->setCellValue($column . ($startDataRow + $count), 1);
                        }
                        break;
                    case 'hoanThanhChoPhatSinhTrongKi':
                        if($hoanThanhTrongKy) {
                            $setCellValues->setCellValue($column . ($startDataRow + $count), 1);
                        }
                        break;
                    default:
                        $setCellValues->setCellValue($column . ($startDataRow + $count), $value[$attr]);
                        break;
                }
            }

            foreach ($attrNguoiNt as $attr => $column) {
                $setCellValues->setCellValue($column . ($startDataRow + $count), array_key_exists('mst0', $value) ? $value['mst0'][$attr] : null);
            }

            foreach ($attrQuyetDkt as $attr => $column) {
                $setCellValues->setCellValue($column . ($startDataRow + $count), array_key_exists('soQdkt', $value) ? $value['soQdkt'][$attr] : null);
            }

            foreach ($attrQuyetDxl as $attr => $column) {
                $qdxlVal = null;
                if (array_key_exists('soQdXuLy', $value) && array_key_exists($attr, $value['soQdXuLy'])) {
                    $ngayQdXl = DateTime::createFromFormat('d/m/Y', $value['soQdXuLy']['ngayQdXuLy']);
                    if ($ngayQdXl && $ngayQdXl < $endDate) {
                        $qdxlVal = $value['soQdXuLy'][$attr];
                    }
                }
                $setCellValues->setCellValue($column . ($startDataRow + $count), $qdxlVal);
            }

            foreach ($loaiKhuVucColArray as $id => $loai) {
                if ($id == $value['loaiKhuVucId']) {
                    $setCellValues->setCellValue($loai . ($startDataRow + $count), 1);
                }
            }

            foreach ($loaiQuyMoColArray as $id => $loai) {
                if ($id == $value['loaiQuyMoId']) {
                    $setCellValues->setCellValue($loai . ($startDataRow + $count), 1);
                }
            }

            foreach ($loaiNoiDungColArray as $id => $loai) {
                if ($id == $value['loaiNdktId']) {
                    $setCellValues->setCellValue($loai . ($startDataRow + $count), 1);
                }
            }

            foreach ($attrLichsn as $attr => $column) {
                if ($value['lichsunopsaukiemtra']) {
                    $setCellValues->setCellValue($column . ($startDataRow + $count), array_key_exists('lichsunopsaukiemtra', $value) ? $value['lichsunopsaukiemtra'][$attr] : null);
                }
            }

            $setCellValues->getStyle('AS' . ($startDataRow + $count))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDDSLASH);
            $setCellValues->getStyle('AU' . ($startDataRow + $count))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDDSLASH);
            $setCellValues->getStyle('K' . ($startDataRow + $count))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDDSLASH);
            $setCellValues->getStyle('F' . ($startDataRow + $count))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDDSLASH);

            $setCellValues->getStyle('A'.($startDataRow+$count).':CC'.($startDataRow+$count))->applyFromArray($styleArray1);
            $count++;
        }

        for ($i = 0; $i < 13; $i++) {
            if (empty($month[$i])) {
                continue;
            }

            /*
 * Count and sum value
 * */
            $ARR = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
            foreach ($ARR as $text => $abc) {
                switch ($abc) {
                    case 'A' :
                    case 'B' :
                    case 'D' :
                    case 'E' :
                    case 'F' :
                    case 'K' :
                        break;
                    case 'C' :
                        $setCellValues->setCellValue('C' . ($startDataRow + $count), 'Tháng ' . $i . "/" . $year);
                        break;
                    default:
                        $setCellValues->setCellValue($abc . ($startDataRow + $count), "=SUM(" . $abc . ($startDataRow + $count + 1) . " : " . $abc . ($startDataRow + $count + count($month[$i])) . ")");
                }
            }
            foreach ($ARR as $text => $abc) {
                $setCellValues->setCellValue('A' . $abc . ($startDataRow + $count), "=SUM(" . 'A' . $abc . ($startDataRow + $count + 1) . " : " . 'A' . $abc . ($startDataRow + $count + count($month[$i])) . ")");
            }

            foreach ($ARR as $text => $abc) {
                $setCellValues->setCellValue('B' . $abc . ($startDataRow + $count), "=SUM(" . 'B' . $abc . ($startDataRow + $count + 1) . " : " . 'B' . $abc . ($startDataRow + $count + count($month[$i])) . ")");
            }

            $setCellValues->setCellValue('CA' . $startDataRow, "=SUM(" . 'CA' . $startDataRow . " : " . 'CA' . ($startDataRow + count($dataLastYear)) . ")");
            $setCellValues->setCellValue('CB' . $startDataRow, "=SUM(" . 'CB' . $startDataRow . " : " . 'CB' . ($startDataRow + count($dataLastYear)) . ")");
            $setCellValues->setCellValue('CC' . $startDataRow, "=SUM(" . 'CC' . $startDataRow . " : " . 'CC' . ($startDataRow + $count));

            $setCellValues->getStyle('A'.($startDataRow+$count).':CC'.($startDataRow+$count))->applyFromArray($styleArray);

            $count++;

            foreach ($month[$i] as $key => $value) {
                foreach ($xlsColArray as $colNum => $colText) {
                    switch ($colText) {
                        case 'N':
                            $setCellValues->setCellValue($colText . ($startDataRow + $count), "=IF(OR(O" . ($startDataRow + $count) . "=1,P" . ($startDataRow + $count) . "=1),1,\"\")");
                            break;
                        case 'Q':
                            $setCellValues->setCellValue($colText . ($startDataRow + $count), "=IF(" . 'AW' . ($startDataRow + $count) . ">0,1,\"\"" . ")");
                            break;
                        case 'AV':
                            $setCellValues->setCellValue($colText . ($startDataRow + $count), "=SUM(" . 'AW' . ($startDataRow + $count) . "+" . 'BB' . ($startDataRow + $count) . "+" . 'BF' . ($startDataRow + $count) . ")");
                            break;
                        case 'AW':
                            $setCellValues->setCellValue($colText . ($startDataRow + $count), "=SUM(" . 'AX' . ($startDataRow + $count) . "+" . 'AY' . ($startDataRow + $count) . "+" . 'AZ' . ($startDataRow + $count) . "+" . 'BA' . ($startDataRow + $count) . ")");
                            break;
                        case 'BB':
                            $setCellValues->setCellValue($colText . ($startDataRow + $count), "=SUM(" . 'BC' . ($startDataRow + $count) . "+" . 'BD' . ($startDataRow + $count) . "+" . 'BE' . ($startDataRow + $count) . ")");
                            break;
                        case 'BF':
                            $setCellValues->setCellValue($colText . ($startDataRow + $count), "=SUM(" . 'BG' . ($startDataRow + $count) . "+" . 'BH' . ($startDataRow + $count) . "+" . 'BI' . ($startDataRow + $count) . "+" . 'BJ' . ($startDataRow + $count) . ")");
                            break;
                        case 'BK':
                            $setCellValues->setCellValue($colText . ($startDataRow + $count), "=SUM(" . 'BL' . ($startDataRow + $count) . "+" . 'BM' . ($startDataRow + $count) . ")");
                            break;
                        case 'BN':
                            $setCellValues->setCellValue($colText . ($startDataRow + $count), "=SUM(" . 'BO' . ($startDataRow + $count) . "+" . 'BP' . ($startDataRow + $count) . ")");
                            break;
                        case 'BP':
                            $setCellValues->setCellValue($colText . ($startDataRow + $count), "=SUM(" . 'BQ' . ($startDataRow + $count) . "+" . 'BR' . ($startDataRow + $count) . "+" . 'BS' . ($startDataRow + $count) . ")");
                            break;
                        case 'BT':
                            $setCellValues->setCellValue($colText . ($startDataRow + $count), "=SUM(" . 'BU' . ($startDataRow + $count) . "+" . 'BV' . ($startDataRow + $count) . ")");
                            break;
                        case 'BU':
                            $setCellValues->setCellValue($colText . ($startDataRow + $count), "=SUM(" . 'BL' . ($startDataRow + $count) . "-" . 'BO' . ($startDataRow + $count) . ")");
                            break;
                        case 'BV':
                            $setCellValues->setCellValue($colText . ($startDataRow + $count), "=SUM(" . 'AV' . ($startDataRow + $count) . "+" . 'BM' . ($startDataRow + $count) . "-" . 'BP' . ($startDataRow + $count) . ")");
                            break;
                    }
                }

                if ($value['soQdkt']['truongDoan']) {
                    $setCellValues->setCellValue('J' . ($startDataRow + $count), $value['soQdkt']['truongDoan']['truongDoan']);
                }

                if ($value['qdHtThuocKhRuiRoTrongNam'] == 1) {
                    $setCellValues->setCellValue('R' . ($startDataRow + $count), 1);
                } else {
                    $setCellValues->setCellValue('S' . ($startDataRow + $count), 1);
                }

                $hoanThanhTrongKy = array_key_exists('soQdkt', $value) && array_key_exists('soQdXuLy', $value) &&
                    $value['soQdkt']['ngayQdKiemTra'] && $value['soQdXuLy']['ngayQdXuLy'] &&
                    DateTimeHelpers::kiemTra2NgayTrongKy($value['soQdkt']['ngayQdKiemTra'], $value['soQdXuLy']['ngayQdXuLy']);

                foreach ($attrBaocaoKt as $attr => $column) {
                    switch ($attr) {
                        case 'nganhNgheKinhDoanh':
                            $setCellValues->setCellValue($column . ($startDataRow + $count), $value['nganhNghe'] ? $value['nganhNghe']['maNganhNgheKdChinh'] : null);
                            break;
                        case 'hoanThanhChoNoDongKiTruoc':
                            if(array_key_exists('soQdXuLy', $value) && $value['soQdXuLy']['ngayQdXuLy'] && !$hoanThanhTrongKy) {
                                $setCellValues->setCellValue($column . ($startDataRow + $count), 1);
                            }
                            break;
                        case 'hoanThanhChoPhatSinhTrongKi':
                            if($hoanThanhTrongKy) {
                                $setCellValues->setCellValue($column . ($startDataRow + $count), 1);
                            }
                            break;
                        default:
                            $setCellValues->setCellValue($column . ($startDataRow + $count), $value[$attr]);
                            break;
                    }
                }

                foreach ($attrNguoiNt as $attr => $column) {
                    $setCellValues->setCellValue($column . ($startDataRow + $count), array_key_exists('mst0', $value) ? $value['mst0'][$attr] : null);
                }

                foreach ($attrQuyetDkt as $attr => $column) {
                    $setCellValues->setCellValue($column . ($startDataRow + $count), array_key_exists('soQdkt', $value) ? $value['soQdkt'][$attr] : null);
                }

                foreach ($attrQuyetDxl as $attr => $column) {
                    $qdxlVal = null;
                    if (array_key_exists('soQdXuLy', $value) && array_key_exists($attr, $value['soQdXuLy'])) {
                        $ngayQdXl = DateTime::createFromFormat('d/m/Y', $value['soQdXuLy']['ngayQdXuLy']);
                        if ($ngayQdXl && $ngayQdXl < $endDate) {
                            $qdxlVal = $value['soQdXuLy'][$attr];
                        }
                    }
                    $setCellValues->setCellValue($column . ($startDataRow + $count), $qdxlVal);
                }

                foreach ($loaiKhuVucColArray as $id => $loai) {
                    if ($id == $value['loaiKhuVucId']) {
                        $setCellValues->setCellValue($loai . ($startDataRow + $count), 1);
                    }
                }

                foreach ($loaiQuyMoColArray as $id => $loai) {
                    if ($id == $value['loaiQuyMoId']) {
                        $setCellValues->setCellValue($loai . ($startDataRow + $count), 1);
                    }
                }

                foreach ($loaiNoiDungColArray as $id => $loai) {
                    if ($id == $value['loaiNdktId']) {
                        $setCellValues->setCellValue($loai . ($startDataRow + $count), 1);
                    }
                }

                foreach ($attrLichsn as $attr => $column) {
                    if ($value['lichsunopsaukiemtra']) {
                        $setCellValues->setCellValue($column . ($startDataRow + $count), $value['lichsunopsaukiemtra'][$attr]);
                    }
                }

                $setCellValues->getStyle('AS' . ($startDataRow + $count))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDDSLASH);
                $setCellValues->getStyle('AU' . ($startDataRow + $count))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDDSLASH);
                $setCellValues->getStyle('K' . ($startDataRow + $count))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDDSLASH);
                $setCellValues->getStyle('F' . ($startDataRow + $count))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDDSLASH);
                $setCellValues->getStyle('A'.($startDataRow+$count).':CC'.($startDataRow+$count))->applyFromArray($styleArray1);
                $count++;
            }
        }

        $setCellValues->setCellValue('C' . ($startDataRow + $count), 'Tổng Năm ' . $year);
        $objPhpExcel->getActiveSheet()->getStyle('C' . ($startDataRow + $count))->applyFromArray($styleArray);
        $hung = ($startDataRow + $count);
        $ARR = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
        foreach ($ARR as $text => $abc) {
            switch ($abc) {
                case 'A' :
                case 'B' :
                case 'D' :
                case 'E' :
                case 'F' :
                case 'K' :
                case 'C' :
                    break;
                default:
                    $setCellValues->setCellValue($abc . $hung, "=(SUM(" . $abc . $startDataRow . " : " . $abc . ($hung - 1) . "))/ 2");
                    $objPhpExcel->getActiveSheet()->getStyle('C' . ($startDataRow + $count))->applyFromArray($styleArray);
                    break;
            }
        }

        foreach ($ARR as $text => $abc) {
            $setCellValues->setCellValue('A' . $abc . $hung, "=(SUM(" . 'A' . $abc . $startDataRow . " : " . 'A' . $abc . ($hung - 1) . "))/ 2");
        }
        foreach ($ARR as $text => $abc) {
            $setCellValues->setCellValue('B' . $abc . $hung, "=(SUM(" . 'B' . $abc . $startDataRow . " : " . 'B' . $abc . ($hung - 1) . "))/ 2");
        }

        $setCellValues->setCellValue('CA' . $hung, "=(SUM(" . 'CA' . $startDataRow . " : " . 'CA' . ($hung - 1) . "))/ 2");
        $setCellValues->setCellValue('CB' . $hung, "=(SUM(" . 'CB' . $startDataRow . " : " . 'CB' . ($hung - 1) . "))/ 2");
        $setCellValues->setCellValue('CC' . $hung, "=(SUM(" . 'CC' . $startDataRow . " : " . 'CC' . ($hung - 1) . "))/ 2");

        $setCellValues->getStyle('A'.($startDataRow+$count).':CC'.($startDataRow+$count))->applyFromArray($styleArray);

        $newFile = './result/' . time() . $fileName;

        $objWriter = PHPExcel_IOFactory::createWriter($objPhpExcel, $fileType);
        $objWriter->save($newFile);

        ExportExcelHelper::download($newFile);
    }

    public static function download($file)
    {
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($file) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            exit;
        }
    }

    /**
     * @param int $column
     * @return string column
     */
    public static function excelColumnFromNumber($column)
    {
        $columnString = "";
        $columnNumber = $column;
        while ($columnNumber > 0) {
            $currentLetterNumber = ($columnNumber - 1) % 26;
            $currentLetter = chr($currentLetterNumber + 65);
            $columnString = $currentLetter . $columnString;
            $columnNumber = ($columnNumber - ($currentLetterNumber + 1)) / 26;
        }
        return $columnString;
    }

    protected static function getDate_($s, $t)
    {
        $time = $s . "/" . $t . "/1";
        $time = strtotime($time);

        $newformat = date('Y-m-d', $time);
        return $newformat;
    }
}