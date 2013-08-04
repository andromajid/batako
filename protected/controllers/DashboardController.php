<?php

class DashboardController extends adminController
{
    public $layout = '//layouts/column1';
    
    public function actionIndex() {
        $this->render('index');
    }
}