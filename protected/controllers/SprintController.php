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
    public function actionCreate() {
        $sprint = new sprint;
        if (isset($_POST['sprint'])) {
            $sprint->attributes = $_POST['sprint'];
            if ($sprint->validate()) {
                $sprint->save(false);
                if (is_array($_POST['task_sprint']) && count($_POST['task_sprint']) > 0) {
                    foreach ($_POST['task_sprint'] as $row_sprint) {
                        //save ke task_sprint
                        Yii::app()->db->createCommand()->insert('task_sprint', array('task_task_id' => $row_sprint,
                            'sprint_sprint_id' => $sprint->sprint_id));
                    }
                }
            }
        }
        $task_project = task::model()->getAllTask();
        $this->title = 'Buat Sprint';
        $this->render('sprint_create', array('sprint' => $sprint,
            'task_project' => $task_project));
    }

    /**
     * fungsi buat view data sprint
     */
    public function actionView($id) {
        $sprint = sprint::model()->getSprintBySprintId($id);
        $task_sprint = task::model()->getAllTaskBySprintId($id);
        $this->title = $sprint['sprint_name'];
        $this->render('sprint_view', array('sprint' => $sprint,
            'task_sprint' => $task_sprint));
    }

    /**
     * ajax request buat assign task
     */
    public function actionAssign_task() {
        $task_id = $_POST['task_id'];
        //get the task 
        $task = task::model()->getTaskById($task_id);
        if (count($task) > 0) {
            if (empty($task['task_assign_user_id'])) {
                //assign to user
                Yii::app()->db->createCommand()->update('task', array('task_assign_user_id' => $this->admin_auth->user_id), 'task_id=:id', array(':id' => $task_id));
                echo json_encode(array('error' => false,
                    'username' => $this->admin_auth->username,
                    'btn' => 'btn-danger'));
            } elseif ($task['task_assign_user_id'] == $this->admin_auth->user_id) {
                Yii::app()->db->createCommand()->update('task', array('task_assign_user_id' => null), 'task_id=:id', array(':id' => $task_id));
                echo json_encode(array('error' => false,
                    'btn' => 'btn-success'));
            } else {
                echo json_encode(array('error' => true,
                    'message' => 'Its not your task'));
            }
        } else {
            echo json_encode(array('error' => true,
                'message' => 'task not found'));
        }
    }

}

?>
