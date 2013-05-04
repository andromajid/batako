<?php

/**
 * Description of adminController
 *
 * @author arkananta
 */
class adminController extends CController {

    public $admin_auth;
    public $breadcrumbs=array();
    public $menu=array();

       public $action_create = 0;
    public $action_update = 0;
    public $action_delete = 0;
    public $action_publish = 0;
    public $action_order_by = 0;
    public $action_activate = 0;
    public $action_process = 0;
    public $action_report = 0;
    /**
     * authentifikasi di sini
     */
    public function __construct($id, $module = null) {
        parent::__construct($id, $module);
        Yii::app()->theme = 'abound';
        $this->admin_auth = new adminAuth();
        $data_sesi = $this->admin_auth->authAdmin();
        $data_password = $this->admin_auth->checkPassword();
        if ($data_sesi['error'] || $data_password['error']) {
            Yii::app()->user->setFlash('error', isset($data_password['message']) ? $data_password['message'] : $data_sesi['message']);
            $this->redirect(array('/admin/login'));
        }
    }

    public function beforeAction($action) {
        $data_auth = $this->admin_auth->auth_action_cont($this);
//        var_dump($data_auth);
//        die();
        if ($data_auth['error']) {
            Yii::app()->user->setFlash('error', $data_auth['message']);
            $this->redirect(array('/admin/login'));
        }


        return parent::beforeAction($action);
    }

}

?>
