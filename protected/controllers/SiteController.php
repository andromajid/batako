<?php

class SiteController extends Controller {

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $this->render('index');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        Yii::app()->theme = 'classic';
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        Yii::app()->theme = 'abound';
        $this->layout = '//layouts/admin_login';
        $model = new LoginForm;

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate())
                $this->redirect(array('/dashboard'));
        }
        // display the login form
        $this->render('admin_login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        $admin = new adminAuth;
        $admin->logout();
        $this->redirect(Yii::app()->homeUrl);
    }
    /**
     * controller buat generate captcha
     */
    public function actionCaptcha($session_name = 'captcha_admin') {
         foreach (Yii::app()->log->routes as $route) {
            if ($route instanceof CWebLogRoute) {
                $route->enabled = false;
            }
        }
        yii::import('ext.captcha.captcha_class');
        $capthaOBJ = new captcha_class();
        $capthaOBJ->OutputCaptcha($width = 100, $height = 30, $length = 4, $session_name); // can be call also $capthaOBJ->OutputCaptcha(100,30,6) // param width, height, length respectively
        
    }
}