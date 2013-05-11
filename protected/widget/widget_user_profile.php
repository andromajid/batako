<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of widget_user_profile
 *
 * @author arkananta
 */
class widget_user_profile extends CWidget{
    public $username;
    public function run() {
        $data = $this->getUser();
        $this->render('widget_user_profile',
                      array('data' => $data));
    }
    /**
     * fungsi buat mendapatkan semua data user
     * @param Mixed $username username atau id dari user
     */
    public function getUser() {
        $result = Yii::app()->db->createCommand()->from('user')->where('user_id=:id OR username=:id', array(':id' => $this->username))->queryRow();
        return $result;
    }
}

?>
