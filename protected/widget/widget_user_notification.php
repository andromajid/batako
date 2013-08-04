<?php

/**
 * widget to show user notification
 * @author andro
 */
class widget_user_notification extends CWidget {

    public $adminAuth;

    //put your code here
    public function getUserNotification() {
        $data_return = array();
        //get all project from user_id if the user is superuser show all user notification
        if ($this->admin_auth->user_is_administrator == '1') {
            $data_return = Yii::app()->db->createCommand()->from('user_notification')->rightJoin('user', 'user_id = user_notification_user_id')
                            ->limit(10)->order('user_notification_datetime DESC')->queryAll();
        } else {
            //get all project first
            $project = project::model()->getProjectByUserId($this->adminAuth->user_id);
            if (is_array($project)) {
                $array_project_id = array();
                foreach ($project as $row) {
                    $array_project_id[] = $row['project_id'];
                }
                $data_return = 
            }
        }
        Yii::app()->db->createCommand()->from('user_notification')->rightJoin('user', $conditions);
    }

}

?>
