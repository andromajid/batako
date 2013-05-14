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
    public $layout = '//layouts/column1';
    //put your code here
    public function actionCreate($project_id) {
        $this->title = "Create Task";
        $data_project = project::model()->getProjectById($project_id);
        if(!$data_project)
            throw new CHttpException(404, 'The requested page does not exist.');
        $task = new task;
        if (isset($_POST['task'])) {
            $task->attributes = $_POST['task'];
            if ($task->validate()) {
                $task->save(false);
                //$this->redirect(array('view', 'id' => $model->project_id));
                Yii::app()->user->setFlash('success', 'Succed adding task');
            }
        }
        $this->render('task_create', array('data_project' => $data_project,
                                           'model' => $task));
    }
}

?>
