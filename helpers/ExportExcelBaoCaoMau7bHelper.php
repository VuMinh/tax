<?php
/**
 * Created by PhpStorm.
 * User: MinhVT
 * Date: 1/3/2018
 * Time: 10:33 AM
 */

namespace app\helpers;

use PHPExcel_IOFactory;
use PhpOffice\PhpSpreadsheet\IOFactory;


class ExportExcelBaoCaoMau7bHelper
{
    public static function exportExcel($dataProvider, $start, $end)
    {
        set_time_limit(2000);
        $fileName = 'Mau-7-b.xlsx';
        $inputFileName = './excel/' . $fileName;
        $activeSheetIndex = 0;
        $startDataRow = 13;
        $count = 0;
        $fileType = 'Xlsx';

        $styleArray = [
            'font' => [
                'bold' => true,
                'color' => array('rgb' => '000000'),
            ],

        ];

        /** Load $inputFileName to a PHPExcel Object  **/
        $objReader = IOFactory::createReader($fileType);

        $objPhpExcel = $objReader->load($inputFileName);

        $objPhpExcel->setActiveSheetIndex($activeSheetIndex);

        $setCellValues = $objPhpExcel->getActiveSheet();

        $date = new \DateTime($end);

        $setCellValues->setCellValue('A5', 'Kỳ báo cáo: Tháng ' . $date->format('m') . ' năm ' . $date->format('Y'));

        $data = [
            'Xuất khẩu' => [1, 2],
            'Dự án sử dụng nguồn vốn ODA' => [7, 8, 9, 10],
            'Đầu tư mới, đầu tư mở rộng' => [3, 4, 5, 6],
            'CSKD trong 12 tháng liên tục có số thuế đầu vào chưa khấu trừ hết' => [11],
            'Hoàn thuế GTGT đối với CSKD nộp thuế GTGT theo phương pháp khấu trừ thuế khi chuyển đổi sở hữu, chuyển đổi doanh nghiệp, sáp nhập, hợp nhất, chia, tách, giải thể, phá sản, chấm dứt hoạt động' => [12],
            'Thuế TNCN' => [15, 16],
            'Hiệp định tránh đánh thuế hai lần' => [17, 18],
            'Hoàn thuế bảo vệ môi trường' => [19],
            'Hoàn thuế, phí nộp thừa theo Luật Quản lý thuế' => [20, 21],
            'Thuế, phí khác' => [22],
            'Cơ sở kinh doanh có quyết định xử lý hoàn thuế của cơ quan có thẩm quyền theo quy định của pháp luật (ngoài các trường hợp nêu trên)' => [13],
            'Trường hợp khác' => [14],
        ];

        $dataProviderFilter = [];
        foreach ($data as $key => $value) {
            $dataProviderFilter[$key] = [];
        }

        foreach ($dataProvider as $key => $value) {
            foreach ($data as $k => $v) {
                foreach ($v as $lydo => $id) {
                    if ($value['loaiHoanThue']['id'] == $id) {
                        $dataProviderFilter[$k][] = $value;
                        break;
                    }
                }
            }
        }

        $sheet = [];

        $dataNew = ExportExcelHelper::createData('A', 'AA');

        $configStyle = [];

        foreach ($dataProviderFilter as $key => $value) {
            $data = $dataNew;
            foreach ($data as $stt => $v) {
                switch ($stt) {
                    case 'A':
                    case 'B':
                    case 'C':
                    case 'D':
                    case 'E':
                    case 'F':
                        break;
                    case 'G':
                        $data[$stt] = $key;
                        break;
                    case 'K' :
                    case 'N' :
                    case 'R':
                        $data[$stt] = count($value);
                        break;
                    case 'H':
                    case 'I':
                    case 'J':
                    case 'M':
                    case 'P':
                    case 'Q':
                    case 'U':
                    case 'V':
                    case 'W':
                        if (count($value) == 0) {
                            $data[$stt] = "0";
                        } else {
                            $data[$stt] = "=SUM(" . $stt . ($startDataRow + $count + 1) . " : " . $stt . ($startDataRow + count($value) + $count) . ")";
                        }
                        break;
                    case 'X':
                        if (count($value) == 0) {
                            $data[$stt] = "0";
                        } else {
                            $data[$stt] = "=(" . 'H' . ($startDataRow + $count) . " + " . 'M' . ($startDataRow + $count) . "-" . 'U' . ($startDataRow + $count) . ")";
                        }
                        break;
                    case 'Y':
                        if (count($value) == 0) {
                            $data[$stt] = "0";
                        } else {
                            $data[$stt] = "=(" . 'I' . ($startDataRow + $count) . "+" . 'P' . ($startDataRow + $count) . "-" . 'V' . ($startDataRow + $count) . ")";
                        }
                        break;
                    case 'Z':
                        if (count($value) == 0) {
                            $data[$stt] = "0";
                        } else {
                            $data[$stt] = "=(" . 'J' . ($startDataRow + $count) . "+" . 'Q' . ($startDataRow + $count) . "-" . 'W' . ($startDataRow + $count) . ")";
                        }
                        break;
                    default:
                        break;
                }
            }

            $sheet[] = $data;
            $configStyle[] = $startDataRow + $count;

            $x = 1;
            foreach ($value as $kl => $vl) {
                $data = $dataNew;

                foreach ($data as $stt => $v) {
                    switch ($stt) {
                        case 'A':
                            $data[$stt] = $x;
                            break;
                        case 'B':
                            $data[$stt] = $vl['mst0']['maSoThue'];
                            break;
                        case 'C':
                            $data[$stt] = $vl['mst0']['tenNguoiNop'];
                            break;
                        case 'D':
                            $data[$stt] = $vl['maChuong'];
                            break;
                        case 'E':
                            if ($vl['laToChuc'] == 1) {
                                $data[$stt] = 'x';
                            }
                            break;
                        case 'F':
                            if ($vl['laToChuc'] == 0) {
                                $data[$stt] = 'x';
                            }
                            break;
                        case 'G':
                            $data[$stt] = $vl['loaiHoanThue']['lyDoHoanThue'];
                            break;
                        /* case 'H':
                             $data[$stt] = $vl['soQdThuHoiHoan']['soTienThueThuHoi'] - $vl['lichSuNopKiTruocChuyenSang']['daNopThueThuHoi'];
                             break;
                         case 'I':
                             $data[$stt]= $vl['soQdXuPhat']['soTienPhatViPham'] - $vl['lichSuNopKiTruocChuyenSang']['daNopTienPhatViPham'];
                             break;
                         case 'J':
                             $data[$stt]= $vl['soQdXuPhat']['tienChamNop'] - $vl['lichSuNopKiTruocChuyenSang']['daNopTienChamNop'];
                             break;*/
                        case 'H':
                            $data[$stt] = $vl['lichSuNopKiTruocChuyenSang']['daNopThueThuHoi'];
                            break;
                        case 'I':
                            $data[$stt] = $vl['lichSuNopKiTruocChuyenSang']['daNopTienPhatViPham'];
                            break;
                        case 'J':
                            $data[$stt] = $vl['lichSuNopKiTruocChuyenSang']['daNopTienChamNop'];
                            break;
                        case 'K' :
                            $data[$stt] = $vl['soQdThuHoiHoan']['soQdThuHoiHoan'];
                            break;
                        case 'L' :
                            $data[$stt] = DateTimeHelpers::convertDate($vl['soQdThuHoiHoan']['ngayQdThuHoiHoan']);
                            break;
                        case 'M' :
                            $data[$stt] = $vl['soQdThuHoiHoan']['soTienThueThuHoi'];
                            break;
                        case 'N' :
                            $data[$stt] = $vl['soQdXuPhat']['soQdXuPhat'];
                            break;
                        case 'O' :
                            $data[$stt] = DateTimeHelpers::convertDate($vl['soQdXuPhat']['ngayQdXuPhat']);
                            break;
                        case 'P':
                            $data[$stt] = $vl['soQdXuPhat']['soTienPhatViPham'];
                            break;
                        case 'Q':
                            $data[$stt] = $vl['soQdXuPhat']['tienChamNop'];
                            break;
                        case 'R':
                            $data[$stt] = $vl['soQdKt']['soQdKiemTra'];
                            break;
                        case 'S':
                            $data[$stt] = DateTimeHelpers::convertDate($vl['soQdKt']['ngayQdKiemTra']);
                            break;
                        case 'T':
                            $data[$stt] = $vl['thoiKyThanhTra'];
                            break;
                        case 'U':
                            $data[$stt] = $vl['lichSuNopQuyHoanThue']['daNopThueThuHoi'];
                            break;
                        case 'V':
                            $data[$stt] = $vl['lichSuNopQuyHoanThue']['daNopTienPhatViPham'];
                            break;
                        case 'W':
                            $data[$stt] = $vl['lichSuNopQuyHoanThue']['daNopTienChamNop'];
                            break;
                        case 'AA':
                            $data[$stt] = $vl['ghiChu'];
                            break;
                        default:
                            break;
                    }
                }
                $x++;
                $count++;
                $sheet[] = $data;
            }
            $count++;
        }
        $setCellValues->insertNewRowBefore($startDataRow + 1, count($sheet));
        $setCellValues->fromArray($sheet, null, 'A' . $startDataRow);

        $k = "=SUM(";
        $n = "=SUM(";
        $r = "=SUM(";
        foreach ($configStyle as $key => $value) {
            $setCellValues->getStyle('A' . ($value) . ':AA' . ($value))->applyFromArray($styleArray);
            $k .= '+K' . ($value);
            $n .= '+N' . ($value);
            $r .= '+R' . ($value);
        }
        $k .= ")";
        $n .= ")";
        $r .= ")";

        $setCellValues->setCellValue('K12', $k);
        $setCellValues->setCellValue('N12', $n);
        $setCellValues->setCellValue('R12', $r);

        $setCellValues->getStyle('A12:AA12')->applyFromArray($styleArray);

        $newFile = './result/' . time() . $fileName;

        $objWriter = IOFactory::createWriter($objPhpExcel, $fileType);
        $objWriter->save($newFile);

        ExportExcelHelper::download($newFile);
    }
}