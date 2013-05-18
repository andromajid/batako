<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of html
 *
 * @author arkananta
 */
class html {
    /**
     * fungsi buat generate color di box task
     * @param String $color hexadecimal warna
     */
    public static function generateGradien($color) {
        return str_replace(array('\n',' '), '', 'style="
                       background-color: #'.$color.';
background-image: -moz-linear-gradient(top,#fff,#'.$color.');
background-image: -webkit-gradient(linear,0 0,0 100%,from(#fff),to(#'.$color.'));
background-image: -webkit-linear-gradient(top,#fff,#'.$color.');
background-image: -o-linear-gradient(top,#fff,#'.$color.');
background-image: linear-gradient(to bottom,#fff,#'.$color.');"
                ');
    }
}

?>
