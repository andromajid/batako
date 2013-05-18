<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of function_lib
 *
 * @author tejomurti
 */
class function_lib {

    /**
     * function for word minifi
     * @param String $word
     * @param Int $max
     */
    public static function wordPendekin($word, $max) {
        $implode_arr = array();
        //first remove word html tag
        $word = strip_tags($word);
        $explode_arr = explode(' ', $word);
        $no = 1;
        foreach ($explode_arr as $row) {
            if ($no <= $max) {
                $implode_arr[] = $row;
                $no++;
            } else {
                break;
            }
        }
        return implode(' ', $implode_arr);
    }

    public static function convert_month($month, $lang = 'eng') {
        $month = (int) $month;
        switch ($lang) {
            case 'ina':
                $arr_month = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember');
                break;

            default:
                $arr_month = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
                break;
        }
        $month_converted = $arr_month[$month - 1];

        return $month_converted;
    }

    public static function convert_date($date, $type = 'num', $format = '.', $lang = 'eng') {
        if ($type == 'num') {
            $date = substr($date, 0, 10);
            $date_converted = str_replace('-', $format, $date);
        } else {
            $year = substr($date, 0, 4);
            $month = substr($date, 5, 2);
            $month = self::convert_month($month, $lang);
            $day = substr($date, 8, 2);

            $date_converted = $day . ' ' . $month . ' ' . $year;
        }

        return $date_converted;
    }

    public static function convert_datetime($date, $type = 'num', $formatdate = '.', $formattime = ':', $lang = 'eng') {
        if ($type == 'num') {
            $date_converted = str_replace('-', $formatdate, str_replace(':', $formattime, $date));
        } else {
            $year = substr($date, 0, 4);
            $month = substr($date, 5, 2);
            $month = self::convert_month($month, $lang);
            $day = substr($date, 8, 2);
            $time = strlen($date) > 10 ? substr($date, 11, 8) : '';
            $time = str_replace(':', $formattime, $time);

            $date_converted = $day . ' ' . $month . ' ' . $year . ' ' . $time;
        }

        return $date_converted;
    }
    /**
     * fungsi buat ngecek extensi adalah file image atau bukan
     * @param String $filepath filepathnya
     * @return Boolean 
     */
    public static function checkImage($filepath) {
        $array_image = array('jpg','jpeg','png','gif');
        if(is_readable($filepath)) {
            $file_type = CFileHelper::getExtension($filepath);
            if(in_array($file_type, $array_image)) {
                return TRUE;
            } else 
                return FALSE;
        } else 
            return FALSE;
    }
}

?>
