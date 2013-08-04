<?php

class DashboardController extends adminController
{
    public $layout = '//layouts/column1';
    
    public function actionIndex() {
        $this->render('index');
    }
    public function actionCalendar() {
        $start_date =  date('Y-m-d', $_GET['start']);
        $end_date = date('Y-m-d', $_GET['end']);
    }
}