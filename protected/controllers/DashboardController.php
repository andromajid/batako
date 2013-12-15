<?php

class DashboardController extends adminController
{
    public $layout = '//layouts/column1';
    
    public function actionIndex() {
        $this->render('index');
    }
    public function actionCalendar() {
        $arr_date = array('start_date' => date('Y-m', $_GET['start']),
                          'end_date' => date('Y-m', $_GET['end']));
        //$data_task = task::model()->getTaskCalendarDate($arr_date);
        $data_sprint = sprint::model()->getSprintCalendarDate($arr_date);
        //$data_merge = array_merge($data_task, $data_sprint);
        echo CJSON::encode($data_sprint);
        Yii::app()->end();
        
    }
}