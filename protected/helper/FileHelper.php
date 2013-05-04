<?php

class FileHelper {

    public static function generateRandomName($no_urut, $endStr) {
        $strFileName = '';
        $strFileName.=time() . '_';
        $strFileName.= FileHelper::randStr() . $no_urut . '.' . $endStr;
        return $strFileName;
    }

    public static function randStr($len=6, $format='ALL_WORD') {
        switch ($format) {
            case 'ALL_WORD':
                $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                break;
            case 'ALL':
                $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-@#~';
                break;
            case 'CHAR':
                $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz-@#~';
                break;
            case 'NUMBER':
                $chars = '0123456789';
                break;
            default :
                $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-@#~';
                break;
        }

        mt_srand((double) microtime() * 1000000 * getmypid());
        $password = "";
        while (strlen($password) < $len)
            $password.=substr($chars, (mt_rand() % strlen($chars)), 1);
        return $password;
    }

}

?>
