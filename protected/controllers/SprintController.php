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
        $data_project = project::model()->getProjectById($project_id);
        $task_project = task::model()->getAllTaskFromProject($project_id);
        $this->title = 'Buat Sprint Pada Proyek '.$data_project['project_name'];
        $sprint = new sprint;
        $this->render('sprint_create', array('sprint' => $sprint,
                                             'task_project' => $task_project));
    }
}

?>
