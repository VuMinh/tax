<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Huy Hoang
 * Date: 5/10/2017
 * Time: 2:41 PM
 */

namespace app\helpers;

use PHPExcel_IOFactory;
use PhpOffice\PhpSpreadsheet\IOFactory;


class ExportExcellBaoCaoMau7aHelper
{
    public static function exportExcel($dataProvider, $end)
    {
        set_time_limit(2000);
        $fileName = 'Mau-7-a-So-theo-doi-QD-TT-KT-sau-hoan-T2-24-hang-thang.xlsx';
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

        $objPhpExcel = $objReader->load('./excel/' . $fileName);

        $objPhpExcel->setActiveSheetIndex($activeSheetIndex);

        $setCellValues = $objPhpExcel->getActiveSheet();

        $date = new \DateTime($end);

        $setCellValues->setCellValue('A5','Kỳ báo cáo: Tháng '.$date->format('m').' năm '.$date->format('Y'));

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

        $dataNew = ExportExcelHelper::createData('A', 'O');

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
                    case 'H' :
                    case 'K' :
                        $data[$stt] = count($value);
                        break;
                    case 'M' :
                    case 'N' :
                        if(count($value)==0){
                            $data[$stt] = "0";
                        }
                        else{
                            $data[$stt] = "=SUM(" . $stt . ($startDataRow + $count + 1) . " : " . $stt . ($startDataRow + count($value) + $count) . ")";
                        }
                        break;
                    default:
                        break;
                }
            }

            $sheet[] = $data;
            $configStyle[] = $startDataRow + $count;

            $x= 1;
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
                                $data[$stt] = 1;
                            }
                            break;
                        case 'F':
                            if ($vl['laToChuc'] == 0) {
                                $data[$stt] = 1;
                            }
                            break;
                        case 'G':
                            $data[$stt] = $vl['loaiHoanThue']['lyDoHoanThue'];
                            break;
                        case 'H' :
                            $data[$stt] = count($value);
                            break;
                        case 'I' :
                            $data[$stt] = DateTimeHelpers::convertDate($vl['soQdKt']['ngayQdKiemTra']);
                            break;
                        case 'J':
                            $data[$stt] = $vl['thoiKyThanhTra'];
                            break;
                        case 'K' :
                            $data[$stt] = $vl['soVbHoanThue']['soVb'];
                            break;
                        case 'L' :
                            $data[$stt] = DateTimeHelpers::convertDate($vl['soVbHoanThue']['ngayVb']);
                            break;
                        case 'M' :
                            $data[$stt] = $vl['soVbHoanThue']['soTienThue'];
                            break;
                        case 'N' :
                            $data[$stt] = "=SUM(" . $stt . ($startDataRow + $count + 1) . " : " . $stt . ($startDataRow + count($value) + $count) . ")";
                            break;
                        case 'O' :
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

        $h = "=SUM(";
        $k = "=SUM(";
        foreach ($configStyle as $key => $value) {
            $setCellValues->getStyle('A' . ($value) . ':O' . ($value))->applyFromArray($styleArray);
            $h.='+H' . ($value);
            $k.='+K' . ($value);
        }
        $h.=")";
        $k.=")";

        $setCellValues->setCellValue('H12', $h);
        $setCellValues->setCellValue('K12', $k);

        $setCellValues->getStyle('A12:O12')->applyFromArray($styleArray);

        foreach ($data as $stt => $v) {
            $setCellValues->setCellValue('M12', "=SUM(" . 'M' . ($startDataRow) . " : " . 'M' . ($startDataRow + count($v) + $count) . ")/2");
            $setCellValues->setCellValue('N12', "=SUM(" . 'N' . ($startDataRow) . " : " . 'N' . ($startDataRow + count($v) + $count) . ")/2");
        }

        $newFile = './result/' . time() . $fileName;

        $objWriter = IOFactory::createWriter($objPhpExcel, $fileType);
        $objWriter->save($newFile);

        ExportExcelHelper::download($newFile);
    }
}