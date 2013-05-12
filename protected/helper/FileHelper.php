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
        Yii::import('application.extensions.image.Image');
        $upload_file = self::upload_with_model($model, $name);
        if (!empty($upload_file)) {
            $model->$name = $upload_file->name;
            $image_location = Yii::getPathOfAlias('webroot') . '/files/images/user/' . $upload_file->name;
            $upload_file->saveAs($image_location);
            self::resize_image(180, 180, $image_location);
            return $uploadedFile->name;
        } else {
            return '';
        }
    }

    public static function project_upload($model, $name) {
        Yii::import('application.extensions.image.Image');
        $upload_file = self::upload_with_model($model, $name);
        if (!empty($upload_file)) {
            $model->$name = $upload_file->name;
            $image_location = Yii::getPathOfAlias('webroot') . '/files/images/project/' . $upload_file->name;
            $upload_file->saveAs($image_location);
            self::resize_image(150, 150, $image_location);
            return $uploadedFile->name;
        } else {
            return '';
        }
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

}

?>
