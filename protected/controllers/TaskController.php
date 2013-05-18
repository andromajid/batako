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

    public $layout = '//layouts/column2';

    //put your code here
    public function actionCreate($project_id) {
        $this->title = "Create Task";
        $data_project = project::model()->getProjectById($project_id);
        if (!$data_project)
            throw new CHttpException(404, 'The requested page does not exist.');
        $task = new task;
        $file = new file;
        if (isset($_POST['task'])) {
            $task->attributes = $_POST['task'];
            if ($task->validate()) {
                $task->task_project_id = $project_id;
                $task->task_create_datetime = date("Y-m-d H:i:s");
                $task->save(false);
                //upload multiple file
                Yii::import('application.helper.FileHelper');
                $file_id = FileHelper::massUpload($_FILES, 'file_name');
                //add ke task file
                foreach ($file_id as $row_file_id) {
                    Yii::app()->db->createCommand()->insert('task_file', array('task_file_task_id' => $task->task_id,
                        'task_file_file_id' => $row_file_id));
                }
                //$this->redirect(array('view', 'id' => $model->project_id));
                Yii::app()->user->setFlash('success', 'Succed adding task');
            }
        }
        $this->render('task_create', array('data_project' => $data_project,
            'model' => $task,
            'file' => $file));
    }

    /**
     * buat nampilin semua user story dari project
     * @param Int $project_id
     */
    public function actionProject($project_id) {
        $this->layout = '//layouts/column1';
        yii::import('application.helper.html');
        $this->title = "Create Task";
        $data_project = project::model()->getProjectById($project_id);
        if (!$data_project)
            throw new CHttpException(404, 'The requested page does not exist.');
        //ambil semua data task di tiap project
        $task_project = task::model()->getAllTaskFromProject($project_id);
        $this->render('task_project', array('task_project' => $task_project));
    }

    /**
     * buat melihat data task 
     * @param Int $task_id
     */
    public function actionView($task_id) {
        $task = task::model()->getTaskById($task_id);
        $task_comment = new task_comment;
        if (!$task)
            throw new CHttpException(404, 'The requested page does not exist.');

        if (isset($_POST['submit_comment'])) {
            $task_comment->task_comment_text = preg_replace('/[\s]+/', '', $_POST['task_comment']['task_comment_text']);
            $task_comment->task_comment_datetime = date("Y-m-d H:i:s");
            $task_comment->task_comment_task_id = $task_id;
            $task_comment->task_comment_user_id = $this->admin_auth->user_id;
            if ($task_comment->validate()) {
                $task_comment->save(false);
                Yii::import('application.helper.FileHelper');
                $file_id = FileHelper::massUpload($_FILES, 'file_name');
                //add ke task file
                foreach ($file_id as $row_file_id) {
                    Yii::app()->db->createCommand()->insert('task_comment_file', array('task_comment_file_task_comment_id' => $task_comment->task_comment_id,
                        'task_comment_file_file_id' => $row_file_id));
                }
                //$this->redirect(array('view', 'id' => $model->project_id));
                Yii::app()->user->setFlash('success', 'Succed adding comment');
                $this->refresh();
            }
        }
        //ambil task filenya
        $file = task_file::model()->getFileByTaskId($task_id);
        //ambil comment-nya
        $comment = task_comment::model()->getCommentByTaskId($task_id);
        $this->render('task_view', array('task' => $task,
            'file' => $file,
            'model' => $task_comment,
            'comment' => $comment));
    }

    /**
     * Method buat update progress via ajax
     */
    public function actionUpdate_progress() {
        Yii::app()->db->createCommand()->update('task', array('task_progress' => $_POST['progress_task']), 'task_id=:id', array(':id' => $_POST['task_id']));
    }

}

?>
