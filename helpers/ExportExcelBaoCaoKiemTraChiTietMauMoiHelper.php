<?php
/**
 * Created by PhpStorm.
 * User: MinhVT
 * Date: 1/31/2018
 * Time: 11:36 AM
 */

namespace app\helpers;


use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class ExportExcelBaoCaoKiemTraChiTietMauMoiHelper
{
    public static function exportExcel($dataProvider, $start, $end)
    {
        set_time_limit(-1);
        ini_set('memory_limit', '3G');

        $endDate = \DateTime::createFromFormat('Y-m-d H:i:s', $end);
        $yearNhap = (int)$endDate->format('Y');

        $fileName = "Mau-bao-cao-tai-tru-so-NNT-khoi-cct_edited.xlsx";
        $inputFileName = './excel/' . $fileName;
        $activeSheetIndex = 2;

        $startDataRowBckt = 15;
        $countBckt = 0;
        $sheetBckt = [];
        $dataNewBckt = ExportExcelHelper::createData('C', 'FB');

        $styleArray = [
            'font' => [
                'bold' => false
            ],
            'borders' => [
                'allborders' => [
                    'style' => \PHPExcel_Style_Border::BORDER_THIN
                ]
            ]
        ];
        $styleTitle = [
            'font' => [
                'bold' => true,
                'color' => array('rgb' => '000000'),
                'size' => 13,
            ]
        ];

        $objReader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $objPHPExcel = $objReader->load($inputFileName);
        $objPHPExcel->setActiveSheetIndex($activeSheetIndex);
        $setCellValues = $objPHPExcel->getActiveSheet();

        /*define arrays trong bao cao kiem tra*/
        $xslColArrayBckt = [
            'AX', 'AY', 'BD', 'BH', 'BM', 'BP', 'BR', 'BV', 'BW', 'BX', 'P', 'S'
        ];

        $loaiKhuVucColArray = [
            '1' => 'V',
            '2' => 'W',
            '3' => 'X',
            '4' => 'Y'
        ];
        $loaiQuyMoColArray = [
            '1' => 'Z',
            '2' => 'AA',
            '3' => 'AB',
        ];

        $loaiNoiDungColArray = [
            '1' => 'AC',
            '2' => 'AD',
            '3' => 'AF',
            '4' => 'AG',
            '5' => 'AH',
            '6' => 'AI',
            '7' => 'AJ',
            '8' => 'AK',
            '9' => 'AL',
            '10' => 'AM',
            '11' => 'AN',
            '12' => 'AO',
            '13' => 'AP',
            '14' => 'AQ',
            '15' => 'AR',
            '16' => 'AS',
            '17' => 'AE'
        ];

        $attrBaoCaoKt = [
            'dangKiemTra' => 'O',
            'nganhNgheKinhDoanh' => 'F',
            'hoanThanhChoNoDongKiTruoc' => 'Q',
            'hoanThanhChoPhatSinhTrongKi' => 'R',
            'kiemTraTheoQuyetToanChiDao' => 'AT',
            'ngayKyBbkt' => 'AU',
            'ghiChu' => 'CE',
            'hanhViViPham' => 'ED',
            'moTaCachThucPhatHien' => 'EE'
        ];

        $attrBaocaoKtMoney = [
            'truyThuThueGtgt' => 'AZ',
            'truyThuThueTndn' => 'BA',
            'truyThuThueTncn' => 'BB',
            'truyThuThueKhac' => 'BC',
            'truyHoanThueGtgt' => 'BE',
            'truyHoanThueTncn' => 'BF',
            'truyHoanThueKhac' => 'BG',
            'phatTronThue' => 'BI',
            'phatHanhChinhKhac1020' => 'BJ',
            'phatChamNop' => 'BK',
            'phatKhac' => 'BL',
            'noDongNamTruocChuyenSang' => 'BN',
            'noDongPhatSinhTrongNam' => 'BO',
            'thueMienGiamTheoKeKhai' => 'BY',
            'thueMienGiamTheoKiemTra' => 'BZ',
            'mienGiamChenhLech' => 'CA',
            'giamKhauTru' => 'CB',
            'thueKhongDuocHoan' => 'CC',
            'giamLo' => 'CD',
        ];

        $attrQdkt = [
            'soQdKiemTra' => 'G',
            'ngayQdKiemTra' => 'H',
            'noDongKyTruocChuyenSang' => 'I',
            'phatSinhTrongKy' => 'J',
            'nienDoKiemTra' => 'K',
            'ngayCongBoQdkt' => 'M',
            'ngayTrinhVbTamDungKt' => 'N',
        ];

        $attrNguoiNt = [
            'maSoThue' => 'D',
            'tenNguoiNop' => 'E'
        ];

        $attrQuyetDxl = [
            'soQdXuLy' => 'AV',
            'ngayQdXuLy' => 'AW',
        ];

        $attrLichsn = [
            'daNopDongNamTruoc' => 'BQ',
            'daNopPhatSinhTruyThu' => 'BS',
            'daNopPhatSinhTruyHoan' => 'BT',
            'daNopTienPhat' => 'BU',
        ];

        /* define array trong bao cao HVVP*/

        $arrayHvvp = [
            'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ', 'DA', 'DB', 'DC', 'DD', 'DE', 'DF', 'DG', 'DH', 'DI', 'DJ', 'DK', 'DL', 'DM', 'DN', 'DO', 'DP', 'DQ', 'DR', 'DS', 'DT', 'DU', 'DV', 'DW', 'DX', 'DY', 'DZ', 'EA', 'EB', 'EC'
        ];

        $arrayTonTren30Ngay = [
            'EF', 'EG', 'EH', 'EI', 'EJ', 'EK', 'EL', 'ES', 'FB'
        ];

//        $arrayCon = [
//            'A', 'B'
//        ];
        $yMax = 0;
        $yDefault = 2018;

        foreach ($dataProvider as $key => $values) {
            if (isset($values['soQdkt']['ngayCongBoQdkt'])) {
                $tem = explode('/', $values['soQdkt']['ngayCongBoQdkt']);
                if (isset($tem[2])) {
                    $year = $tem[2];
                    if ($year > $yMax) {
                        $yMax = $year;
                    }
                }
            } else {
                $yDefault = 2018;
            }
        }
        $key = ['EM', 'EN', 'EO', 'EP', 'EQ', 'ER'];
        $year = [];
        if (isset($values['soQdkt']['ngayCongBoQdkt'])) {
            for ($i = 0; $i < count($key); $i++) {
                if ($i == 0) {
                    $setCellValues->setCellValue($key[$i] . '13', 'Trước năm ' . ($yMax - 4));
                    $year[$yMax - 4] = $key[$i];
                } else {
                    $setCellValues->setCellValue($key[$i] . '13', 'Năm ' . ($yMax - 4));
                    $year[$yMax - 4] = $key[$i];
                    $yMax++;
                }
            }
        } else {
            for ($i = 0; $i < count($key); $i++) {
                if ($i == 0) {
                    $setCellValues->setCellValue($key[$i] . '13', 'Trước năm ' . ($yDefault - 4));
                    $year[$yDefault - 4] = $key[$i];
                } else {
                    $setCellValues->setCellValue($key[$i] . '13', 'Năm ' . ($yDefault - 4));
                    $year[$yDefault - 4] = $key[$i];
                    $yDefault++;
                }
            }
        }

        $dateExport = explode('/', DateTimeHelpers::convertDate($end));

        $setCellValues->setCellValue('M5', '25');
        $setCellValues->setCellValue('M6', $dateExport[1]);
        $setCellValues->setCellValue('M7', $dateExport[2]);
        /* save item for bckt to array*/
        $dataProviderFilterBckt = [];
        $dataProviderFilterBckt['after'] = [];
        $dataProviderFilterBckt['before'] = [];

        $data = $dataNewBckt;
        $sheetBckt[] = $data;
        $countBckt++;

        $yNhap = explode('/', DateTimeHelpers::convertDate($start));
        if ($yNhap[1] + 1 == 12) {
            $startYearT1 = $yNhap[2] + 1 . '-' . '01-01 00:00:00';
        } else {
            $startYearT1 = $yNhap[2] . '-' . '01-01 00:00:00';
        }

        foreach ($dataProvider as $key => $giatri) {
            $temp = date('Y', strtotime($giatri['soQdkt']['ngayCongBoQdkt']));

            $tienNoBV = ($giatri['noDongNamTruocChuyenSang'] - $giatri['lichsunopsaukiemtra']['daNopDongNamTruoc']) + (($giatri['truyThuThueGtgt'] + $giatri['truyThuThueTndn'] + $giatri['truyThuThueTncn'] + $giatri['truyThuThueKhac'] + $giatri['truyHoanThueGtgt'] + $giatri['truyHoanThueTncn'] + $giatri['truyHoanThueKhac'] + $giatri['phatTronThue'] + $giatri['phatHanhChinhKhac1020'] + $giatri['phatChamNop'] + $giatri['phatKhac']) + $giatri['noDongPhatSinhTrongNam'] - ($giatri['lichsunopsaukiemtra']['daNopPhatSinhTruyThu'] + $giatri['lichsunopsaukiemtra']['daNopPhatSinhTruyHoan'] + $giatri['lichsunopsaukiemtra']['daNopTienPhat']));

            if (!empty($year[$temp])) {
                $data[$year[$temp]] = 1;
            }

            $y = explode('/', DateTimeHelpers::convertDate($giatri['soQdkt']['ngayTao']));
            if ($giatri['soQdkt']['ngayTaoQDKT'] >= $start && $giatri['soQdkt']['ngayTaoQDKT'] <= $end) {
                if (1 < count($y) && $y[2] == $yearNhap) {
                    if ((int)$y[1] == 1) {
                        if ($y[0] < 25) {
                            $dataProviderFilterBckt['before'][1][] = $giatri;
                        } else {
                            $dataProviderFilterBckt['before'][2][] = $giatri;
                        }
                    } elseif ((int)$y[1] == 12) {
                        $dataProviderFilterBckt['before'][12][] = $giatri;
                    } else {
                        if ($y[0] < 25) {
                            $dataProviderFilterBckt['before'][(int)$y[1]][] = $giatri;
                        } else {
                            $dataProviderFilterBckt['before'][intval($y[1]) + 1][] = $giatri;
                        }
                    }
                }
            } else {
                if ($giatri['dangKiemTra'] != 1 && $tienNoBV > 0 && $yearNhap > 2017) {
//                if ($giatri['dangKiemTra'] != 1 && $tienNoBV > 0) {
                    $dataProviderFilterBckt['after'][0][] = $giatri;
                }
            }

        }

        ksort($dataProviderFilterBckt['before']);

        $configStyle = [];
        $configStyleTitle = [];
        foreach ($dataProviderFilterBckt as $stt => $nam) {
            if ($stt != 'after') {
                $data = $dataNewBckt;
                foreach ($data as $id => $value) {
                    switch ($id) {
                        case 'C':
                            $data[$id] = "B. CÁC CUỘC KIỂM TRA TRONG KỲ BÁO CÁO (BAO GỒM QĐ HOÀN THÀNH TRONG KỲ VÀ TỒN TRONG KỲ)" . PHP_EOL;
                            break;
                        case 'D':
                        case 'F':
                        case 'H':
                        case 'I':
                        case 'M':
                            break;
                    }
                }
                $configStyleTitle[] = $startDataRowBckt + $countBckt;
                $sheetBckt[] = $data;
                $countBckt++;
            }
            foreach ($nam as $sttthang => $thang) {
                $data = $dataNewBckt;
                foreach ($data as $id => $value) {
                    switch ($id) {
                        case 'C':
                            if ($stt == 'after') {
                                $data[$id] = "A. CÁC CUỘC KIỂM TRA KỲ TRƯỚC ĐÃ HOÀN THÀNH NHƯNG ĐƠN VỊ CÒN NỢ ĐỌNG THUẾ (THEO DÕI NỢ ĐỌNG CÁC CUỘC KIỂM TRA KỲ TRƯỚC ĐÃ HOÀN THÀNH)" . PHP_EOL;
                            }
                            break;
                        case 'D':
                        case 'F':
                        case 'H':
                        case 'I':
                        case 'M':
                            break;
                        case 'E':
                            $data[$id] = "Tháng " . $sttthang . "/" . $yearNhap;
                            if ($stt == 'after') {
                                $data[$id] = "";
                            }
                            break;
                    }
                }

                $configStyleTitle[] = $startDataRowBckt + $countBckt;
                $sheetBckt[] = $data;
                $countBckt++;

                foreach ($thang as $sttgiatri => $giatri) {
                    $data = $dataNewBckt;

                    foreach ($attrNguoiNt as $colNum => $colText) {
                        $data[$colText] = $giatri['mst0'][$colNum];
                    }
                    foreach ($attrQdkt as $colNum => $colText) {
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
                        $data['L'] = $giatri['soQdkt']['truongDoan']['truongDoan'];
                    }
                    if ($giatri['qdHtThuocKhRuiRoTrongNam'] == 1) {
                        $data['T'] = 1;
                    } else {
                        $data['U'] = 1;
                    }

                    $hoanThanhTrongki = array_key_exists('soQdkt', $giatri) && array_key_exists('soQdXuLy', $giatri) && $giatri['soQdkt']['ngayQdKiemTra'] && $giatri['soQdXuLy']['ngayQdXuLy'] && DateTimeHelpers::kiemTra2NgayTrongKy($giatri['soQdkt']['ngayQdKiemTra'], $giatri['soQdXuLy']['ngayQdXuLy']);
                    foreach ($attrBaoCaoKt as $attr => $column) {
                        switch ($attr) {
                            case 'nganhNgheKinhDoanh':
                                $data[$column] = $giatri['nganhNghe'] ? $giatri['nganhNghe']['maNganhNgheKdChinh'] : null;
                                break;
                            case 'hoanThanhChoNoDongKiTruoc':
                                if (array_key_exists('soQdXyLy', $giatri) && $giatri['soQdXuLy']['ngayQdXuLy'] && !$hoanThanhTrongki) {
                                    $data[$column] = 1;
                                }
                                break;
                            case 'hoanThanhChoPhatSinhTrongKi':
                                if ($hoanThanhTrongki) {
                                    $data[$column] = 1;
                                }
                                break;
                            case'hanhViViPham':
                                if ($stt != 'after') {
                                    $data[$column] = $giatri['hanhViViPham'] . PHP_EOL . 'Tổng truy thu: ' . ($giatri['truyThuThueGtgt'] + $giatri['truyThuThueTndn'] + $giatri['truyThuThueTncn'] + $giatri['truyThuThueKhac']) . PHP_EOL . 'Tổng phạt: ' . ($giatri['phatTronThue'] + $giatri['phatHanhChinhKhac1020'] + $giatri['phatChamNop'] + $giatri['phatKhac']);
                                }
                                break;
                            case 'moTaCachThucPhatHien':
                                if ($stt != 'after') {
                                    $data[$column] = $giatri['moTaCachThucPhatHien'];
                                }
                                break;
                            default:
                                $data[$column] = $giatri[$attr];
                                break;
                        }
                    }

                    foreach ($attrBaocaoKtMoney as $attr => $column) {
                        $data[$column] = $giatri[$attr];
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
                            $data[$column] = array_key_exists('lichsunopsaukiemtra', $giatri) ? $giatri['lichsunopsaukiemtra'][$attr] : null;
                        }
                    }
                    foreach ($xslColArrayBckt as $colNum => $colText) {
                        $hang = $startDataRowBckt + $countBckt;
                        switch ($colText) {
                            case 'P':
                                if (array_key_exists('soQdXuLy', $giatri['soQdXuLy']) && $giatri['soQdXuLy']['soQdXuLy'] && isset($giatri['soQdXuLy']['ngayTao']) && $giatri['soQdXuLy']['ngayTao'] >= $startYearT1 && $giatri['soQdkt']['ngayTao'] < $startYearT1) {
                                    $data[$colText] = '';
                                } elseif (array_key_exists('soQdXuLy', $giatri['soQdXuLy']) && $giatri['soQdXuLy']['soQdXuLy'] && isset($giatri['soQdXuLy']['ngayTao'])) {
                                    $data[$colText] = 1;
                                }
                                break;
                            case 'S':
                                $data[$colText] = "=IF(" . 'AX' . $hang . ">0,1,\"\"" . ")";
                                break;
                            case 'AX':
                                $data[$colText] = "=SUM(" . 'AY' . $hang . "+" . 'BD' . $hang . "+" . 'BH' . $hang . ")";
                                break;
                            case 'AY':
                                $data[$colText] = "=SUM(" . 'AZ' . $hang . "+" . 'BA' . $hang . "+" . 'BB' . $hang . "+" . 'BC' . $hang . ")";
                                break;
                            case 'BD':
                                $data[$colText] = "=SUM(" . 'BE' . $hang . "+" . 'BF' . $hang . "+" . 'BG' . $hang . ")";
                                break;
                            case 'BH':
                                $data[$colText] = "=SUM(" . 'BI' . $hang . "+" . 'BJ' . $hang . "+" . 'BK' . $hang . "+" . 'BL' . $hang . ")";
                                break;
                            case 'BM':
                                $data[$colText] = "=SUM(" . 'BN' . $hang . "+" . 'BO' . $hang . ")";
                                break;
                            case 'BP':
                                $data[$colText] = "=SUM(" . 'BQ' . $hang . "+" . 'BR' . $hang . ")";
                                break;
                            case 'BR':
                                $data[$colText] = "=SUM(" . 'BS' . $hang . "+" . 'BT' . $hang . "+" . 'BU' . $hang . ")";
                                break;
                            case 'BV':
                                $data[$colText] = "=SUM(" . 'BW' . $hang . "+" . 'BX' . $hang . ")";
                                break;
                            case 'BW':
                                $data[$colText] = "=SUM(" . 'BN' . $hang . "-" . 'BQ' . $hang . ")";
                                break;
                            case 'BX':
                                $data[$colText] = "=SUM(" . 'AX' . $hang . "+" . 'BO' . $hang . "-" . 'BR' . $hang . ")";
                                break;
                        }
                    }
                    if ($stt != 'after') {
                        foreach ($arrayHvvp as $colNum => $colText) {
                            $hang = $startDataRowBckt + $countBckt;
                            switch ($colText) {
                                case 'CG':
                                    $data[$colText] = "=+IF(" . 'AX' . $hang . "<>0,1,\"\"" . ")";
                                    break;
                                case 'CH':
                                    $data[$colText] = "=+IF(" . '$CG' . $hang . "=1,\$D\$9,\"\"" . ")";
                                    break;
                                case 'CI':
                                    $data[$colText] = "=+IF(" . "(" . '$CG' . $hang . "=1" . "),D$hang,\"\"" . ")";
                                    break;
                                case 'CJ':
                                    $data[$colText] = "=+IF(" . "(" . '$CG' . $hang . "=1" . "),E$hang,\"\"" . ")";
                                    break;
                                case 'CK':
                                    $data[$colText] = "=+IF(" . "(" . '$CG' . $hang . "=1" . "),F$hang,\"\"" . ")";
                                    break;
                                case 'CL':
                                    $data[$colText] = "=+IF((" . '$CG' . $hang . "=1" . "),G$hang,\"\")";
                                    break;
                                case 'CM':
                                    $data[$colText] = "=+IF((" . '$CG' . $hang . "=1" . "),H$hang,\"\")";
                                    break;
                                case 'CN':
                                    $data[$colText] = "=+IF((" . '$CG' . $hang . "=1" . "),I$hang,\"\")";
                                    break;
                                case 'CO':
                                    $data[$colText] = "=+IF((" . '$CG' . $hang . "=1" . "),J$hang,\"\")";
                                    break;
                                case 'CP':
                                    $data[$colText] = "=+IF((" . '$CG' . $hang . "=1" . "),K$hang,\"\")";
                                    break;
                                case 'CQ':
                                    $data[$colText] = "=+IF((" . '$CG' . $hang . "=1" . "),L$hang,\"\")";
                                    break;
                                case 'CR':
                                    $data[$colText] = "=+IF((" . '$CG' . $hang . "=1" . "),M$hang,\"\")";
                                    break;
                                case 'CS':
                                    $data[$colText] = "=+IF((" . '$CG' . $hang . "=1" . "),N$hang,\"\")";
                                    break;
                                case 'CT':
                                    $data[$colText] = "=+IF((" . '$CG' . $hang . "=1" . "),O$hang,\"\")";
                                    break;
                                case 'CU':
                                    $data[$colText] = "=+IF((" . '$CG' . $hang . "=1" . "),P$hang,\"\")";
                                    break;
                                case 'CV':
                                    $data[$colText] = "=+IF((" . '$CG' . $hang . "=1" . "),Q$hang,\"\")";
                                    break;
                                case 'CW':
                                    $data[$colText] = "=+IF((" . '$CG' . $hang . "=1" . "),R$hang,\"\")";
                                    break;
                                case 'CX':
                                    $data[$colText] = "=+IF((" . '$CG' . $hang . "=1" . "),S$hang,\"\")";
                                    break;
                                case 'CY':
                                    $data[$colText] = "=+IF((" . '$CG' . $hang . "=1" . "),T$hang,\"\")";
                                    break;
                                case 'CZ':
                                    $data[$colText] = "=+IF((" . '$CG' . $hang . "=1" . "),U$hang,\"\")";
                                    break;
                                case 'DA':
                                    $data[$colText] = "=+IF((" . '$CG' . $hang . "=1" . "),V$hang,\"\")";
                                    break;
                                case 'DB':
                                    $data[$colText] = "=+IF((" . '$CG' . $hang . "=1" . "),W$hang,\"\")";
                                    break;
                                case 'DC':
                                    $data[$colText] = "=+IF((" . '$CG' . $hang . "=1" . "),X$hang,\"\")";
                                    break;
                                case 'DD':
                                    $data[$colText] = "=+IF((" . '$CG' . $hang . "=1" . "),Y$hang,\"\")";
                                    break;
                                case 'DE':
                                    $data[$colText] = "=+IF((" . '$CG' . $hang . "=1" . "),Z$hang,\"\")";
                                    break;
                                case 'DF':
                                    $data[$colText] = "=+IF((" . '$CG' . $hang . "=1" . "),AA$hang,\"\")";
                                    break;
                                case 'DG':
                                    $data[$colText] = "=+IF((" . '$CG' . $hang . "=1" . "),AB$hang,\"\")";
                                    break;
                                case 'DH':
                                    $data[$colText] = "=+IF((" . '$CG' . $hang . "=1" . "),AC$hang,\"\")";
                                    break;
                                case 'DI':
                                    $data[$colText] = "=+IF((" . '$CG' . $hang . "=1" . "),AD$hang,\"\")";
                                    break;
                                case 'DJ':
                                    $data[$colText] = "=+IF((" . '$CG' . $hang . "=1" . "),AE$hang,\"\")";
                                    break;
                                case 'DK':
                                    $data[$colText] = "=+IF((" . '$CG' . $hang . "=1" . "),AF$hang,\"\")";
                                    break;
                                case 'DL':
                                    $data[$colText] = "=+IF((" . '$CG' . $hang . "=1" . "),AG$hang,\"\")";
                                    break;
                                case 'DM':
                                    $data[$colText] = "=+IF((" . '$CG' . $hang . "=1" . "),AH$hang,\"\")";
                                    break;
                                case 'DN':
                                    $data[$colText] = "=+IF((" . '$CG' . $hang . "=1" . "),AI$hang,\"\")";
                                    break;
                                case 'DO':
                                    $data[$colText] = "=+IF((" . '$CG' . $hang . "=1" . "),AJ$hang,\"\")";
                                    break;
                                case 'DP':
                                    $data[$colText] = "=+IF((" . '$CG' . $hang . "=1" . "),AK$hang,\"\")";
                                    break;
                                case 'DQ':
                                    $data[$colText] = "=+IF((" . '$CG' . $hang . "=1" . "),AL$hang,\"\")";
                                    break;
                                case 'DR':
                                    $data[$colText] = "=+IF((" . '$CG' . $hang . "=1" . "),AM$hang,\"\")";
                                    break;
                                case 'DS':
                                    $data[$colText] = "=+IF((" . '$CG' . $hang . "=1" . "),AN$hang,\"\")";
                                    break;
                                case 'DT':
                                    $data[$colText] = "=+IF((" . '$CG' . $hang . "=1" . "),AO$hang,\"\")";
                                    break;
                                case 'DU':
                                    $data[$colText] = "=+IF((" . '$CG' . $hang . "=1" . "),AP$hang,\"\")";
                                    break;
                                case 'DV':
                                    $data[$colText] = "=+IF((" . '$CG' . $hang . "=1" . "),AQ$hang,\"\")";
                                    break;
                                case 'DW':
                                    $data[$colText] = "=+IF((" . '$CG' . $hang . "=1" . "),AR$hang,\"\")";
                                    break;
                                case 'DX':
                                    $data[$colText] = "=+IF((" . '$CG' . $hang . "=1" . "),AS$hang,\"\")";
                                    break;
                                case 'DY':
                                    $data[$colText] = "=+IF((" . '$CG' . $hang . "=1" . "),AT$hang,\"\")";
                                    break;
                                case 'DZ':
                                    $data[$colText] = "=+IF((" . '$CG' . $hang . "=1" . "),AU$hang,\"\")";
                                    break;
                                case 'EA':
                                    $data[$colText] = "=+IF((" . '$CG' . $hang . "=1" . "),AV$hang,\"\")";
                                    break;
                                case 'EB':
                                    $data[$colText] = "=+IF((" . '$CG' . $hang . "=1" . "),AW$hang,\"\")";
                                    break;
                                case 'EC':
                                    $data[$colText] = "=+IF((" . '$CG' . $hang . "=1" . "),AX$hang,\"\")";
                                    break;
                            }
                        }
                        foreach ($arrayTonTren30Ngay as $colNum => $colText) {
                            $hang = $startDataRowBckt + $countBckt;
                            switch ($colText) {
                                case 'EF':
                                    $data[$colText] = "=IFERROR(IF(AND((" . 'FB' . $hang . ">30),(O$hang=1)),1,\"\"),\"\")";
                                    break;
                                case 'EG':
                                    $data[$colText] = "=+IF(" . 'EF' . $hang . "=1,\$D\$9,\"\"" . ")";
                                    break;
                                case 'EH':
                                    $data[$colText] = "=+IF(" . '$EF' . $hang . "=1,D$hang,\"\"" . ")";
                                    break;
                                case 'EI':
                                    $data[$colText] = "=+IF(" . '$EF' . $hang . "=1,E$hang,\"\"" . ")";
                                    break;
                                case 'EJ':
                                    $data[$colText] = "=+IF(" . '$EF' . $hang . "=1,G$hang,\"\"" . ")";
                                    break;
                                case 'EK':
                                    $data[$colText] = "=+IF(" . '$EF' . $hang . "=1,H$hang,\"\"" . ")";
                                    break;
                                case 'EL':
                                    $data[$colText] = "=+SUM(" . 'EM' . $hang . ":" . 'ER' . $hang . ")";
                                    break;
                                case 'ES':
                                    $data[$colText] = "=+SUM(" . 'ET' . $hang . ":" . 'EY' . $hang . ")";
                                    break;
                                case 'FB':
                                    $data[$colText] = "=IF((" . 'O' . $hang . "=1),(\$EF\$5-H$hang),\"\"" . ")";
                                    break;
                            }
                        }
                    }
                    $configStyle[] = $startDataRowBckt + $countBckt;
                    $countBckt++;
                    $sheetBckt[] = $data;
                }
            }
        }

        $setCellValues->insertNewRowBefore($startDataRowBckt + count($sheetBckt), count($sheetBckt));
//        $setCellValues->insertNewRowBefore($startDataRowBckt, count($sheetBckt));
        $setCellValues->fromArray($sheetBckt, null, 'C' . $startDataRowBckt);

        foreach ($configStyle as $key => $value) {
            $setCellValues->getStyle('C' . ($value) . ':FB' . ($value))->applyFromArray($styleArray);
        }
        foreach ($configStyleTitle as $key => $value) {
            $setCellValues->getStyle('C' . ($value) . ':FB' . ($value))->applyFromArray($styleTitle);
        }

        $monthReport = explode('/', DateTimeHelpers::convertDate($end));
        $objPHPExcel->setActiveSheetIndex(3);
        $objPHPExcel->getActiveSheet()->setCellValue('A5', 'Kỳ báo cáo: Tháng ' . $monthReport[1]);

        $newFile = './result/' . time() . $fileName;
        $objWriter = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($objPHPExcel);
        $objWriter->setPreCalculateFormulas(false);
        $objWriter->save($newFile);
        ExportExcelHelper::download($newFile);
    }
}