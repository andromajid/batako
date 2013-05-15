<?php

class FileHelper {

    public static function generateRandomName($no_urut, $endStr) {
        $strFileName = '';
        $strFileName.=time() . '_';
        $strFileName.= FileHelper::randStr() . $no_urut . '.' . $endStr;
        return $strFileName;
    }

    public static function randStr($len = 6, $format = 'ALL_WORD') {
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

    public static function avatar_upload($model, $name) {
        return self::upload_image($model, $name, 'user', array('width' => 180, 'height' => 180));
    }

    public static function project_upload($model, $name) {
        return self::upload_image($model, $name, 'project', array('width' => 150, 'height' => 150));
    }

    /**
     * upload file with model
     * @param Model $model Model-nya
     * @param String $name attribute image pada model 
     */
    public static function upload_with_model($model, $name) {
        $uploadedFile = CUploadedFile::getInstance($model, $name);
        return $uploadedFile;
    }

    /**
     * fungsi buat upload semua gambar dan di resize
     * @param Model $model modelnya
     * @param String $name attribut dari table yang berisi image
     * @param String $folder_name 
     * @param Array $size array('width' => 12,'height' => 13)
     */
    public static function upload_image($model, $name, $folder_name, $size) {
        Yii::import('application.extensions.image.Image');
        $upload_file = self::upload_with_model($model, $name);
        if (!empty($upload_file)) {
            $model->$name = $upload_file->name;
            $image_location = Yii::getPathOfAlias('webroot') . '/files/images/' . $folder_name . '/' . $upload_file->name;
            $upload_file->saveAs($image_location);
            self::resize_image($size['width'], $size['height'], $image_location);
            return $uploadedFile->name;
        } else {
            return '';
        }
    }

    /**
     * fungsi buat merisize image
     * @param Int $width lebar gambar
     * @param Int $height tinggi gambar
     */
    public static function resize_image($width, $height, $image_location) {
        Yii::import('application.extensions.image.Image');
        $image = new Image($image_location);
        $image->resize($width, $height, Image::NONE)->quality(75)->sharpen(20);
        $image->save();
    }

    /**
     * fungsi buat menghandle html5 file upload
     * @param Object $files $_FILES 
     * @param String $attribute attribut html dari input file
     * @return array
     */
    public static function massUpload($file, $attribute) {
        $array_file = array();
        if (is_array($file[$attribute])) {
            foreach ($file[$attribute]['name'] as $number => $value) {
                $file_dir = Yii::getPathOfAlias('webroot') . '/files/' . $value;
                move_uploaded_file($file[$attribute]['tmp_name'][$number], $file_dir);
                Yii::app()->db->createCommand()->insert('file', array('file_name' => $value,
                    'file_mime' => $file[$attribute]['type'][$number]));
                $array_file[] = yii::app()->db->getLastInsertID();
            }
        }
        return $array_file;
    }

}

?>
