<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of widgetTaskUser
 *
 * @author andro
 */
class widgetTaskUser extends CWidget {

    public $id;

    //put your code here
    public function run() {
        $task = new task();
        //$active_task = $task->search($id);
        $task->unsetAttributes();
        if (isset($_GET['task'])) {
            $task->attributes = $_GET['task'];
        }
        $this->render('viewTaskUser', array('task' => $task));
    }

}

?>
