<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of widget_user_menu
 *
 * @author andro
 */
class widget_user_menu extends CWidget {
    public $admin_auth;
    //put your code here
    public function run() {
        $data = array('project' => $this->getProject(),
                      'sprint' => $this->getSprint());
        $this->render('widget_user_menu', array('data' => $data));
    }

    private function getProject() {
        $data = project::Model()->getProjectByUserId($this->admin_auth->user_id);
        return $data;
    }
    
    private function getSprint() {
        $data = Yii::app()->db->createCommand()->from('sprint')->order('sprint_start_date DESC')->queryAll();
        return $data;
    }
}

?>
