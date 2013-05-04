<?php

/**
 * Description of adminController
 *
 * @author arkananta
 */
class VofficeController extends CController {

    public $breadcrumbs=array();
    public $menu=array();

    /**
     * authentifikasi di sini
     */
    public function __construct($id, $module = null) {
        parent::__construct($id, $module);
        Yii::app()->theme = 'abound_vo';
        
        
        if(!session_id())
        {
            session_start();
        }
        
        if(!$this->checkIsLogin())
        {
            $this->redirect(Yii::app()->baseUrl.'/member/login');
        }
        
    }

    public function checkIsLogin()
    {
        $status=true;
        if(!isset($_SESSION['member']) OR empty($_SESSION['member']))
        {
            $status=false;
        }
        
        return $status;
    }
    
    /**
     * dapatkan network id
     */
    public function getNetworkId()
    {
        return $_SESSION['member']['network_id'];
    }

}

?>
