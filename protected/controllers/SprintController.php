<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sprintController
 *
 * @author arkananta
 */
class SprintController extends adminController {
     public $layout = '//layouts/column1';
    //put your code here
    public function actionCreate($project_id) {
        $sprint = new sprint;
        if(isset($_POST['sprint'])) {
            $sprint->attributes = $_POST['sprint'];
            if($sprint->validate()) {
                $sprint->save(false);
                if(is_array($_POST['task_sprint']) && count($_POST['task_sprint']) > 0) {
                    foreach($_POST['task_sprint'] as $row_sprint) {
                        //save ke task_sprint
                        Yii::app()->db->createCommand()->insert('task_sprint', array('task_task_id' => $row_sprint,
                                                                                     'sprint_sprint_id' => $sprint->sprint_id));
                    }
                }
            }
        }
        $data_project = project::model()->getProjectById($project_id);
        $task_project = task::model()->getAllTaskFromProject($project_id);
        $this->title = 'Buat Sprint Pada Proyek '.$data_project['project_name'];
        $this->render('sprint_create', array('sprint' => $sprint,
                                             'task_project' => $task_project));
    }
}

?>
