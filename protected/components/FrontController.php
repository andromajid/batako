<?php

/**
 * Description of FrontController
 *
 * @author arkananta
 */
class FrontController extends CController {

    public $breadcrumbs=array();
    public $menu=array();

    /**
     * authentifikasi di sini
     */
    public function __construct($id, $module = null) {
        parent::__construct($id, $module);
        Yii::app()->theme = 'front';
        
        
        if(!session_id())
        {
            session_start();
        }
        
        
    }
    

}

?>
