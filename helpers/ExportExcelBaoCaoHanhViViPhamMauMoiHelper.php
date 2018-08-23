<?php
/**
 * Created by PhpStorm.
 * User: MinhVT
 * Date: 1/26/2018
 * Time: 2:24 PM
 */

namespace app\helpers;


use PhpOffice\PhpSpreadsheet\IOFactory;

class ExportExcelBaoCaoHanhViViPhamMauMoiHelper
{
    public static function exportExcel($dataProvider, $start, $end)
    {
        set_time_limit(-1);
        $fileName = "Mau-3-bao-cao-HVVP-mau-moi.xlsx";
        $activeSheetIndex = 0;
        $arrayStyle = [
            'font' => [
                'bold' => false
            ],
            'borders' => [
                'allborders' => [
                    'style' => \PHPExcel_Style_Border::BORDER_THIN
                ]
            ]
        ];

        $startDataRow = 10;
        $count = 0;
        $inputFileType = 'Xlsx';
        $objReader = IOFactory::createReader($inputFileType);

        $objPhpExcel = $objReader->load('./excel/' . $fileName);
        $objPhpExcel->setActiveSheetIndex($activeSheetIndex);
        $setCellValues = $objPhpExcel->getActiveSheet();

        $s = explode('/', $start);
        $e = explode('/', $end);

        $startMonth = $s[1] . '/' . $s[2];
        $endMonth = $e[1] . '/' . $e[2];
        if ($startMonth == $endMonth) {
            $string = 'Tháng ' . $startMonth;
        } else {
            $string = 'Tháng ' . $startMonth . ' - ' . 'Tháng ' . $endMonth;
        }
        $setCellValues->setCellValue('A4', $string);

        $sheet = [];
        $dataNew = ExportExcelHelper::createData('A', 'AY');
        $configStyle = [];

        $yNhap = explode('/', $start);

        if ($yNhap[1] >= 2 && $yNhap[1] <= 12) {
            $startYearT1 = $yNhap[2] + 1 . '-' . '01-01 00:00:00';
        } else {
            $startYearT1 = $yNhap[2] . '-' . '01-01 00:00:00';
        }

        $totalColArray = [
            'AW', 'R', 'O'
        ];

        $loaiKhuVucColArray = [
            '1' => 'U',
            '2' => 'V',
            '3' => 'W',
            '4' => 'X'
        ];
        $loaiQuyMoColArray = [
            '1' => 'Y',
            '2' => 'Z',
            '3' => 'AA',
        ];

        $loaiNoiDungColArray = [
            '1' => 'AB',
            '2' => 'AC',
            '3' => 'AE',
            '4' => 'AF',
            '5' => 'AG',
            '6' => 'AH',
            '7' => 'AI',
            '8' => 'AJ',
            '9' => 'AK',
            '10' => 'AL',
            '11' => 'AM',
            '12' => 'AN',
            '13' => 'AO',
            '14' => 'AP',
            '15' => 'AQ',
            '16' => 'AR',
            '17' => 'AD',
        ];

        $attrBaocaoKt = [
            'dangKiemTra' => 'N',
            'nganhNgheKinhDoanh' => 'E',
            'hoanThanhChoNoDongKiTruoc' => 'P',
            'hoanThanhChoPhatSinhTrongKi' => 'Q',
            'kiemTraTheoQuyetToanChiDao' => 'AS',
            'ngayKyBbkt' => 'AT',
            'hanhViViPhamDh' => 'AX',
            'moTaCachThucPhatHienVp' => 'AY'
        ];

        $attrNguoiNt = [
            'maSoThue' => 'C',
            'tenNguoiNop' => 'D',
        ];

        $attrQuyetDkt = [
            'soQdKiemTra' => 'F',
            'ngayQdKiemTra' => 'G',
            'noDongKyTruocChuyenSang' => 'H',
            'phatSinhTrongKy' => 'I',
            'nienDoKiemTra' => 'J',
            'ngayCongBoQdkt' => 'L',
            'ngayTrinhVbTamDungKt' => 'M',
        ];

        $attrQuyetDxl = [
            'soQdXuLy' => 'AU',
            'ngayQdXuLy' => 'AV',
        ];


        foreach ($dataProvider as $key => $value) {
            $data = $dataNew;

            foreach ($attrNguoiNt as $colNum => $colText) {
                $data[$colText] = $value['mst0'][$colNum];
            }
            foreach ($attrQuyetDkt as $colNum => $colText) {
                $data[$colText] = array_key_exists('soQdkt', $value) ? $value['soQdkt'][$colNum] : null;
            }

            foreach ($attrQuyetDxl as $attr => $column) {
                $qdxlVal = null;
                if (array_key_exists('soQdXuLy', $value) && array_key_exists($attr, $value['soQdXuLy'])) {
                    $qdxlVal = $value['soQdXuLy'][$attr];
                }
                $data[$column] = $qdxlVal;
            }
            if ($value['soQdkt']['truongDoan']) {
                $data['K'] = $value['soQdkt']['truongDoan']['truongDoan'];
            }

            if ($value['qdHtThuocKhRuiRoTrongNam'] == 1) {
                $data['S'] = 1;
            } else {
                $data['T'] = 1;
            }

            $hoanThanhTrongKy = array_key_exists('soQdkt', $value) && array_key_exists('soQdXuLy', $value) && $value['soQdkt']['ngayQdKiemTra'] && $value['soQdXuLy']['ngayQdXuLy'] &&
                DateTimeHelpers::kiemTra2NgayTrongKy($value['soQdkt']['ngayQdKiemTra'], $value['soQdXuLy']['ngayQdXuLy']);

            foreach ($attrBaocaoKt as $attr => $column) {
                switch ($attr) {
                    case 'nganhNgheKinhDoanh':
                        $data[$column] = $value['nganhNghe'] ? $value['nganhNghe']['maNganhNgheKdChinh'] : null;
                        break;
                    case 'hoanThanhChoNoDongKiTruoc':
                        if (array_key_exists('soQdXuLy', $value) && $value['soQdXuLy']['ngayQdXuLy'] && !$hoanThanhTrongKy) {
                            $data[$column] = 1;
                        }
                        break;
                    case 'hoanThanhChoPhatSinhTrongKi':
                        if ($hoanThanhTrongKy) {
                            $data[$column] = 1;
                        }
                        break;
                    default:
                        $data[$column] = $value[$attr];
                        break;
                }
            }
            foreach ($loaiKhuVucColArray as $id => $loai) {
                if ($id == $value['loaiKhuVucId']) {
                    $data[$loai] = 1;
                }
            }
            foreach ($loaiQuyMoColArray as $id => $loai) {
                if ($id == $value['loaiQuyMoId']) {
                    $data[$loai] = 1;
                }
            }

            foreach ($loaiNoiDungColArray as $id => $loai) {
                if ($id + 1 == $value['loaiNdktId']) {
                    $data[$loai] = 1;
                }
            }

            foreach ($totalColArray as $colNum => $colText) {
                $hang = $startDataRow + $count;
                switch ($colText) {
                    case 'O':
                        if (array_key_exists('soQdXuLy', $value['soQdXuLy']) && $value['soQdXuLy']['soQdXuLy'] && isset($value['soQdXuLy']['ngayTao']) && $value['soQdXuLy']['ngayTao'] >= $startYearT1 && $value['soQdkt']['ngayTao'] < $startYearT1) {
                            $data[$colText] = '';
                        } elseif (array_key_exists('soQdXuLy', $value['soQdXuLy']) && $value['soQdXuLy']['soQdXuLy'] && isset($value['soQdXuLy']['ngayTao'])) {
                            $data[$colText] = 1;
                        }
                        break;
                    case 'R':
                        $data[$colText] = "=IF(" . 'AW' . $hang . ">0,1,\"\"" . ")";
                        break;
                    case'AW':
                        $data[$colText] = (($value['truyThuThueGtgt'] + $value['truyThuThueTndn'] + $value['truyThuThueTncn'] + $value['truyThuThueKhac']) + ($value['truyHoanThueGtgt'] + $value['truyHoanThueTncn'] + $value['truyHoanThueKhac']) + ($value['phatTronThue'] + $value['phatHanhChinhKhac1020'] + $value['phatChamNop'] + $value['phatKhac'])) / 1000;
                        break;
                }
            }
            $data['A'] = $count + 1;
            $configStyle[] = $startDataRow + $count;
            $sheet[] = $data;
            $count++;
        }

        $setCellValues->insertNewRowBefore($startDataRow + 1, count($sheet) - 1);
        $setCellValues->fromArray($sheet, null, 'A' . $startDataRow);

        foreach ($configStyle as $key => $value) {
            $setCellValues->getStyle('A' . ($value) . ':AY' . ($value))->applyFromArray($arrayStyle);
        }

        $newFile = './result/' . time() . $fileName;

        $objWriter = IOFactory::createWriter($objPhpExcel, $inputFileType);
        $objWriter->save($newFile);

        ExportExcelHelper::download($newFile);

    }

}