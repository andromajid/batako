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

}

?>
