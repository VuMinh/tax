<?php

namespace app\helpers;

use DateTime;

class DateTimeHelpers
{
    /**
     * @param string $date1
     * @param string $date2
     * @return bool
     */
    public static function kiemTra2NgayTrongKy($date1, $date2)
    {
        return self::layKyTuNgay($date1) === self::layKyTuNgay($date2);
    }

    /**
     * @param $date
     * @return string
     */
    public static function layKyTuNgay($date)
    {
        $y = explode('/', $date);
        if ((int)$y[1] == 1) {
            if (intval($y[0]) < 25) {
                return "1-" . $y[2];
            } else {
                return "2-" . $y[2];
            }
        } elseif ((int)$y[1] == 12) {
            return "12-" . $y[2];
        } else {
            if (intval($y[0]) < 25) {
                return (string)(intval($y[1])) . "-" . $y[2];
            } else {
                return (string)(intval($y[1]) + 1) . "-" . $y[2];
            }
        }
    }

    public static function convertDate($string)
    {
        if ($string) {
            $date = DateTime::createFromFormat('Y-m-d H:i:s', $string);
            return $date->format('d/m/Y');
        }

        return '';

    }

    public static function convertDate_Month($string)
    {
        if ($string) {
            $date = DateTime::createFromFormat('Y-m-d H:i:s', $string);
            return $date->format('d/m');
        }

        return '';

    }


    public static function convertDatetime($string)
    {
        if ($string) {
            $date = DateTime::createFromFormat("d/m/Y", $string);
            return $date->format('Y-m-d 00:00:00');
        }

        return '';

    }
}