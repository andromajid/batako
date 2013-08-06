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
        echo CJSON::encode(task::model()->getTaskCalendarDate($arr_date));
        Yii::app()->end();
        
    }
}