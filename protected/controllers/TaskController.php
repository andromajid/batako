<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TaskController
 *
 * @author arkananta
 */
class TaskController extends adminController {
    //put your code here
    public function actionCreate($project_id) {
        $data_project = project::model()->getProjectById($project_id);
        if(!$data_project)
            throw new CHttpException(404, 'The requested page does not exist.');
        $task = new task;
        $this->render('task_create', array('data_project' => $data_project,
                                           'task' => $task));
    }
}

?>
