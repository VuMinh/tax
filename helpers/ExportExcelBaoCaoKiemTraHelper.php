<?php

namespace app\helpers;

use DateTime;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExportExcelBaoCaoKiemTraHelper
{
    public static function exportExcel($dataProvider, $start, $end)
    {
        set_time_limit(2000);
        ini_set('memory_limit', '-1');
        $endDate = DateTime::createFromFormat('Y-m-d H:i:s', $end);

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
            '3' => 'AD',
            '4' => 'AE',
            '5' => 'AF',
            '6' => 'AG',
            '7' => 'AH',
            '8' => 'AI',
            '9' => 'AJ',
            '10' => 'AK',
            '11' => 'AL',
            '12' => 'AM',
            '13' => 'AN',
            '14' => 'AO',
            '15' => 'AP',
            '16' => 'AQ',
            '17' => 'AC',
        ];

        $attrBaocaoKt = [
            'doiKiemTra' => 'A',
            'dangKiemTra' => 'M',
            'nganhNgheKinhDoanh' => 'D',
            'hoanThanhChoNoDongKiTruoc' => 'O',
            'hoanThanhChoPhatSinhTrongKi' => 'P',
            'kiemTraTheoQuyetToanChiDao' => 'AR',
            'ngayKyBbkt' => 'AS',
            'ghiChu' => 'CC',
        ];

        $attrBaocaoKtMoney = [
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
        $count = 0;
        $inputFileType = 'Xlsx';
        $objReader = IOFactory::createReader($inputFileType);

        $objPhpExcel = $objReader->load('./excel/' . $fileName);

        $objPhpExcel->setActiveSheetIndex($activeSheetIndex);

        $setCellValues = $objPhpExcel->getActiveSheet();
        $setCellValues->setCellValue('A3', 'BÁO CÁO CHI TIẾT KẾT QUẢ KIỂM TRA TẠI TRỤ SỞ NGƯỜI NỘP THUẾ NĂM ' . $year);

        $dataProviderFilter = [];
        $dataProviderFilter['after'] = [];
        $dataProviderFilter['before'] = [];

        $yNhap = explode('/', DateTimeHelpers::convertDate($start));

        if ($yNhap[1] + 1 == 12) {
            $startYearT1 = $yNhap[2] + 1 . '-' . '01-01 00:00:00';
        } else {
            $startYearT1 = $yNhap[2] . '-' . '01-01 00:00:00';
        }
        foreach ($dataProvider as $key => $giatri) {

            $y = explode('/', DateTimeHelpers::convertDate($giatri['soQdkt']['ngayTao']));

            if ($giatri['soQdkt']['ngayTaoQDKT'] >= $start && $giatri['soQdkt']['ngayTaoQDKT'] <= $end) {

                if (1 < count($y) && $y[2] == $year) {
                    if ((int)$y[1] == 1) {
                        if ($y[0] < 25) {
                            $dataProviderFilter['before'][1][] = $giatri;
                        } else {
                            $dataProviderFilter['before'][2][] = $giatri;
                        }
                    } elseif ((int)$y[1] == 12) {
                        $dataProviderFilter['before'][12][] = $giatri;
                    } else {
                        if ($y[0] < 25) {
                            $dataProviderFilter['before'][(int)$y[1]][] = $giatri;
                        } else {
                            $dataProviderFilter['before'][intval($y[1]) + 1][] = $giatri;
                        }
                    }
                }
            } else {
                if ($giatri['dangKiemTra'] == 1 && (int)$y[1] == 12 && $year > 2017) {
                    $dataProviderFilter['after'][0][] = $giatri;
                }

                /*if ((isset($yNhap[1]) && isset($yEnd[1]) && $year > '2017') && ((empty($giatri['soQdXuLy']['soQdXuLy']) && empty($giatri['soQdXuLy']['ngayQdXuLy'])) || (isset($giatri['soQdXuLy']['ngayTao']) && $giatri['soQdXuLy']['ngayTao'] >= $startYearT1 && isset($giatri['soQdkt']['ngayTao']) && $giatri['soQdkt']['ngayTao'] < $startYearT1))) {
                    $dataProviderFilter['after'][0][] = $giatri;
                }*/
            }
        }

        ksort($dataProviderFilter['before']);

        $sheet = [];

        $dataNew = ExportExcelHelper::createData('A', 'CC');

        $configStyle = [];
        foreach ($dataProviderFilter as $stt => $nam) {

            foreach ($nam as $sttthang => $thang) {

                $data = $dataNew;

                foreach ($data as $id => $value) {
                    switch ($id) {
                        case 'A' :
                        case 'B' :
                        case 'D' :
                        case 'E' :
                        case 'F' :
                        case 'K' :
                            break;
                        case 'C' :
                            $data[$id] = 'Tháng ' . $sttthang . '/' . $year;
                            if ($stt == 'after') {
                                $data[$id] = 'Các kì trước chuyển sang';
                            }

                            break;
                        default:
                            $data[$id] = "=SUM(" . $id . ($startDataRow + $count + 1) . " : " . $id . ($startDataRow + count($thang) + $count) . ")";
                            break;
                    }
                }

                $configStyle[] = $startDataRow + $count;

                $sheet[] = $data;
                $count++;

                foreach ($thang as $sttgiatri => $giatri) {

                    $data = $dataNew;

                    foreach ($attrNguoiNt as $colNum => $colText) {
                        $data[$colText] = $giatri['mst0'][$colNum];
                    }

                    foreach ($attrQuyetDkt as $colNum => $colText) {
                        $data[$colText] = array_key_exists('soQdkt', $giatri) ? $giatri['soQdkt'][$colNum] : null;
                    }

                    foreach ($attrQuyetDxl as $attr => $column) {
                        $qdxlVal = null;
                        if (array_key_exists('soQdXuLy', $giatri) && array_key_exists($attr, $giatri['soQdXuLy'])) {
                            $qdxlVal = $giatri['soQdXuLy'][$attr];
                        }

                        $data[$column] = $qdxlVal;
                    }

                    if ($giatri['soQdkt']['truongDoan']) {
                        $data['J'] = $giatri['soQdkt']['truongDoan']['truongDoan'];
                    }

                    if ($giatri['qdHtThuocKhRuiRoTrongNam'] == 1) {
                        $data['R'] = 1;
                    } else {
                        $data['S'] = 1;
                    }

                    $hoanThanhTrongKy = array_key_exists('soQdkt', $giatri) && array_key_exists('soQdXuLy', $giatri) &&
                        $giatri['soQdkt']['ngayQdKiemTra'] && $giatri['soQdXuLy']['ngayQdXuLy'] &&
                        DateTimeHelpers::kiemTra2NgayTrongKy($giatri['soQdkt']['ngayQdKiemTra'], $giatri['soQdXuLy']['ngayQdXuLy']);

                    foreach ($attrBaocaoKt as $attr => $column) {
                        switch ($attr) {
                            case 'nganhNgheKinhDoanh':
                                $data[$column] = $giatri['nganhNghe'] ? $giatri['nganhNghe']['maNganhNgheKdChinh'] : null;
                                break;
                            case 'hoanThanhChoNoDongKiTruoc':
                                if (array_key_exists('soQdXuLy', $giatri) && $giatri['soQdXuLy']['ngayQdXuLy'] && !$hoanThanhTrongKy) {
                                    $data[$column] = 1;
                                }
                                break;
                            case 'hoanThanhChoPhatSinhTrongKi':
                                if ($hoanThanhTrongKy) {
                                    $data[$column] = 1;
                                }
                                break;
                            default:
                                $data[$column] = $giatri[$attr];
                                break;
                        }
                    }

                    foreach ($attrBaocaoKtMoney as $attr => $column) {
                        $data[$column] = $giatri[$attr] / 1000;
                    }

                    foreach ($loaiKhuVucColArray as $id => $loai) {
                        if ($id == $giatri['loaiKhuVucId']) {
                            $data[$loai] = 1;
                        }
                    }

                    foreach ($loaiQuyMoColArray as $id => $loai) {
                        if ($id == $giatri['loaiQuyMoId']) {
                            $data[$loai] = 1;
                        }
                    }

                    foreach ($loaiNoiDungColArray as $id => $loai) {
                        if ($id + 1 == $giatri['loaiNdktId']) {
                            $data[$loai] = 1;
                        }
                    }

                    foreach ($attrLichsn as $attr => $column) {
                        if ($giatri['lichsunopsaukiemtra']) {
                            $data[$column] = array_key_exists('lichsunopsaukiemtra', $giatri) ? $giatri['lichsunopsaukiemtra'][$attr] / 1000 : null;
                        }
                    }

                    foreach ($xlsColArray as $colNum => $colText) {
                        $hang = $startDataRow + $count;
                        switch ($colText) {
                            case 'N':
                                if (array_key_exists('soQdXuLy', $giatri['soQdXuLy']) && $giatri['soQdXuLy']['soQdXuLy'] && isset($giatri['soQdXuLy']['ngayTao']) && $giatri['soQdXuLy']['ngayTao'] >= $startYearT1 && $giatri['soQdkt']['ngayTao'] < $startYearT1) {
                                    $data[$colText] = '';
                                } elseif (array_key_exists('soQdXuLy', $giatri['soQdXuLy']) && $giatri['soQdXuLy']['soQdXuLy'] && isset($giatri['soQdXuLy']['ngayTao'])) {
                                    $data[$colText] = 1;
                                }
                                break;
                            case 'Q':
                                $data[$colText] = "=IF(" . 'AV' . $hang . ">0,1,\"\"" . ")";
                                break;
                            case 'AV':
                                $data[$colText] = "=SUM(" . 'AW' . $hang . "+" . 'BB' . $hang . "+" . 'BF' . $hang . ")";
                                break;
                            case 'AW':
                                $data[$colText] = "=SUM(" . 'AX' . $hang . "+" . 'AY' . $hang . "+" . 'AZ' . $hang . "+" . 'BA' . $hang . ")";
                                break;
                            case 'BB':
                                $data[$colText] = "=SUM(" . 'BC' . $hang . "+" . 'BD' . $hang . "+" . 'BE' . $hang . ")";
                                break;
                            case 'BF':
                                $data[$colText] = "=SUM(" . 'BG' . $hang . "+" . 'BH' . $hang . "+" . 'BI' . $hang . "+" . 'BJ' . $hang . ")";
                                break;
                            case 'BK':
                                $data[$colText] = "=SUM(" . 'BL' . $hang . "+" . 'BM' . $hang . ")";
                                break;
                            case 'BN':
                                $data[$colText] = "=SUM(" . 'BO' . $hang . "+" . 'BP' . $hang . ")";
                                break;
                            case 'BP':
                                $data[$colText] = "=SUM(" . 'BQ' . $hang . "+" . 'BR' . $hang . "+" . 'BS' . $hang . ")";
                                break;
                            case 'BT':
                                $data[$colText] = "=SUM(" . 'BU' . $hang . "+" . 'BV' . $hang . ")";
                                break;
                            case 'BU':
                                $data[$colText] = "=SUM(" . 'BL' . $hang . "-" . 'BO' . $hang . ")";
                                break;
                            case 'BV':
                                $data[$colText] = "=SUM(" . 'AV' . $hang . "+" . 'BM' . $hang . "-" . 'BP' . $hang . ")";
                                break;
                        }
                    }

                    $count++;
                    $sheet[] = $data;
                }
            }
            if ($stt != 'after') {
                $data = $dataNew;

                foreach ($data as $id => $value) {
                    switch ($id) {
                        case 'A' :
                        case 'B' :
                        case 'D' :
                        case 'E' :
                        case 'F' :
                        case 'K' :
                            break;
                        case 'C' :
                            $data[$id] = 'Tổng Năm ' . $year;
                            break;
                        default:
                            $data[$id] = "=(SUM(" . $id . $startDataRow . " : " . $id . ($startDataRow + $count - 1) . "))/ 2";
                            break;
                    }
                }
                $configStyle[] = $startDataRow + $count;
                $sheet[] = $data;
                $count++;
            }

        }

        $setCellValues->insertNewRowBefore($startDataRow + 1, count($sheet));
        $setCellValues->fromArray($sheet, null, 'A' . $startDataRow);

        foreach ($configStyle as $key => $value) {
            $setCellValues->getStyle('A' . ($value) . ':CC' . ($value))->applyFromArray($styleArray);
        }

        $newFile = './result/' . time() . $fileName;

        $objWriter = IOFactory::createWriter($objPhpExcel, $inputFileType);
        $objWriter->save($newFile);

        ExportExcelHelper::download($newFile);
    }

}