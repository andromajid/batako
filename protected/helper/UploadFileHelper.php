<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * @param Author: Tejo Murti
 * This helper can upload file.
 * please set the model to determine the type of files allowed
 * 
 * $field_name : the name of your input type
 * $path: your path, where the file is located
 * $model: your model
 * 
 */
class UploadFileHelper {

    /**
     * @param string $field_name
     * @param string $path
     * @param object $model
     * @param string $type
     * @param int $size
     * 
     * @return array();
     * * */
    public static function upload_file($field_name, $path, $model, $type='image', $size=400, $fileName='') {


        //$photo_new_name=null;
        $photo_new_name = $old_name_photo = $fileName;
        // $upload_file=new CUploadedFile($photo_new_name,$path,$type,$size,204);   
        //print_r($_FILES);        
        $file = CUploadedFile::getInstance($model, $field_name);


        $type_file = explode('/', $file->getType());


        $size_file = $file->getSize() / 1024; //in KB



        $result = false;
        $result_string = '';


        // print_r($type_file);
        if (!empty($type_file) AND $type_file[0] != $type) {
            $result = false;
            $result_string = 'Only support for ' . $type;
        } elseif ($size_file > $size) {
            $result = false;
            $result_string = 'Max Size:' . $size . ' KB';
        } else {
            if ((is_object($file) && get_class($file) === 'CUploadedFile')) {

                $folder_module = Yii::app()->basePath . '/..' . $path;

                if (!is_dir($folder_module)) {
                    mkdir($folder_module);
                    chmod($folder_module, 0777);
                }

                $model->$field_name = $file;

                $endStr = $model->$field_name->extensionName;

                if (file_exists($folder_module . $file)) {
                    $photo_new_name = FileHelper::generateRandomName(rand(1, 9), str_replace($endStr, '', $file) . $endStr);
                } else {
                    $photo_new_name = $file;
                }

                $model->$field_name = $photo_new_name;
                $model->$field_name = CUploadedFile::getInstance($model, $field_name);

                //SIMPAN GAMBAR KE FOLDER
                $model->$field_name->saveAs($folder_module . $photo_new_name);

                if (isset($old_name_photo) AND $old_name_photo != '') {
                    if (file_exists($folder_module . $old_name_photo) AND $old_name_photo != '') {
                        unlink($folder_module . $old_name_photo);
                    }
                }

                $result = true;
                $result_string = $path . $photo_new_name;
            }
        }

        return array(
            'result' => $result, //boolean
            'result_string' => $result_string, //string message
        );
    }
    /**
     * Fungsi buat upload foto kemudian di resize ole EphpThumb
     * @param CformModel $model_image form model 
     */
    public static function UploadThumbPic($image_upload) {
        $member_image = CUploadedFile::getInstance($image_upload, 'member_image');
        if (!$member_image->hasError && $image_upload->validate()) {
            Yii::import("ext.EPhpThumb.EPhpThumb");
            
            $url = YiiBase::getPathOfAlias('webroot') . '/files/images/member/' . $member_image->name;
            
            if(trim($member_image->name)!='')
            {
                $member_image->saveAs($url, false);

                $thumb = new EPhpThumb();
                $thumb->init(); //this is needed
    //chain functions   

                $thumb->create($url)->resize(125, 125)->save($url);
                if($_POST['old_image'] !== '') {
                    if(file_exists(YiiBase::getPathOfAlias('webroot') . '/files/images/member/'.$_POST['old_image'])) {
                        @unlink(YiiBase::getPathOfAlias('webroot') . '/files/images/member/'.$_POST['old_image']);
                    }
                }
            }
           
        } else {
            Yii::app()->user->setFlash('message_error', 'upload image gagal');
        }
    }

}

?>
