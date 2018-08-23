<?php

namespace app\helpers;

use app\models\Sotheodoisauhoanthue;
use PHPExcel_IOFactory;

class ExportExcelHelper
{
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

    public static function createData($start, $end)
    {

        $chars = [];

        for ($i = 64; $i <= 72; $i++) {
            $x = '';
            if ($i != 64) {
                $x = chr($i);
            }

            for ($j = 65; $j < 91; $j++) {
                $chars[] = $x . chr($j);
            }
        }

        $s = array_search($start, $chars);
        $e = array_search($end, $chars);
        if (($s + 1) && ($e + 1) && $e > $s) {
            $data = [];
            for ($i = $s; $i <= $e; $i++) {
                $data[$chars[$i]] = null;
            }

            return $data;
        }

        return null;
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

    public static function getWeeks($date, $rollover)
    {
        $cut = substr($date, 0, 8);
        $daylen = 86400;

        $timestamp = strtotime($date);
        $first = strtotime($cut . "00");
        $elapsed = ($timestamp - $first) / $daylen;

        $weeks = 1;

        for ($i = 1; $i <= $elapsed; $i++) {
            $dayfind = $cut . (strlen($i) < 2 ? '0' . $i : $i);
            $daytimestamp = strtotime($dayfind);

            $day = strtolower(date("l", $daytimestamp));

            if ($day == strtolower($rollover)) $weeks++;
        }

        return $weeks;
    }

    public static function findFriInMonth($month, $year)
    {
        $lastday = date("t", mktime(0, 0, 0, $month, 1, $year));

        $lastday_my = $lastday . '/' . $month . '/' . $year;
        $listFri = [];
        $weekOfMonth = [];
        $temp = [];

        for ($i = 1; $i <= $lastday; $i++) {
            $time = gregoriantojd($month, $i, $year);
            $day_of_week = jddayofweek($time, 1);

            if ($day_of_week == 'Friday') {
                $listFri[] = $i . '/' . $month . '/' . $year;
            }

        }
        foreach ($listFri as $key => $value) {
            $fri_last = $listFri[count($listFri) - 1];
            $convertDate = new \DateTime(DateTimeHelpers::convertDatetime($value));
            $temp[$key] = [];
            $count_day_of_month = 0;

            for ($i = 0; $i < 7; $i++) {
                $convertDate = $convertDate->modify('-1 day');
                $temp[$key][] = $convertDate->format('d/m');

                if ($convertDate->format('m') == $month) {
                    $count_day_of_month++;
                }
            }
            if ($count_day_of_month) {
                $weekOfMonth[] = $temp[$key];
            }
//            tính khoảng cách giữa 2 ngày trong tháng
            $first_date = str_replace('/', '-', $fri_last);
            $first_date_ex = strtotime($first_date);
            $second_date = str_replace('/', '-', $lastday_my);
            $second_date_ex = strtotime($second_date);
            $datediff = abs($second_date_ex - $first_date_ex);
            $distance_day = floor($datediff / (60 * 60 * 24));
//            var_dump($distance_day);die;

            if ($key == count($listFri) - 1) {
                $convertDate = new \DateTime(DateTimeHelpers::convertDatetime($value));
                $temp[$key] = [];
                $count_day_of_month = 0;
                $convertDate = $convertDate->modify(+$distance_day . 'day');
                for ($i = 0; $i < $distance_day; $i++) {
                    $temp[$key][] = $convertDate->format('d/m');
                    if ($convertDate->format('m') == $month) {
                        $count_day_of_month++;
                    }
                }
                if ($count_day_of_month) {
                    $weekOfMonth[] = $temp[$key];
                }
            }
        }
        return $weekOfMonth;
    }

    public static function findFriInMonthEdited($month, $year)
    {
        $lastday = (int)date("t", mktime(0, 0, 0, $month, 1, $year));

        $listFri = [];
        $weekOfMonth = [];

        for ($i = 1; $i <= $lastday; $i++) {
            $time = gregoriantojd($month, $i, $year);
            $day_of_week = jddayofweek($time, 1);

            if ($day_of_week == 'Friday') {
                $listFri[] = $i;
            }

        }

        $fri_first = $listFri[0];

        foreach ($listFri as $key => $value) {
            if ($fri_first > 1) {
                if ($value === $lastday) {
                    $weekOfMonth[$key][] = DateTimeHelpers::convertDatetime($lastday . '/' . $month . '/' . $year);
                } else if ($key == count($listFri) - 1 && $key < $lastday) {
                    for ($i = ($lastday - $value); $i >= 0; $i--) {
                        $weekOfMonth[$key + 1][] = DateTimeHelpers::convertDatetime($lastday - $i . '/' . $month . '/' . $year);
                    }
                }

                for ($i = 0; $i < 7; $i++) {

                    if ($fri_first + ($key) * 7 - 1 - $i > 0) {
                        $weekOfMonth[$key][] = DateTimeHelpers::convertDatetime($fri_first + ($key) * 7 - 1 - $i . '/' . $month . '/' . $year);
                    } else {
                        break;
                    }
                }
                usort($weekOfMonth[$key], function ($a, $b) {
                    return ($a > $b);
                });
            } else {

                if ($key == count($listFri) - 1) {
                    for ($i = 0; $i <= ($lastday - $value); $i++) {
                        $weekOfMonth[$key - 1][] = DateTimeHelpers::convertDatetime($listFri[count($listFri) - 1] + $i . '/' . $month . '/' . $year);
                    }
                } else {
                    for ($i = 0; $i < 7; $i++) {
                        $weekOfMonth[$key][] = DateTimeHelpers::convertDatetime($fri_first + ($key) * 7 + $i . '/' . $month . '/' . $year);
                    }
                }

            }

        }

        ksort($weekOfMonth);

        return $weekOfMonth;
    }
}