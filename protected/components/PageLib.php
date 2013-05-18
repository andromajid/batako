<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PageLib
 *
 * @author tejomurti
 * Library Untuk Page Content
 */
class PageLib {
    //put your code here
    
    public $model;
   
    public function __construct() {
        $this->model=new site_page;
        
    }
    
    /**
     * detail page
     * @param int $id
     * @return object
     */
    public function page_detail($id,$additional_condition='')
    {
        $criteria=new CDbCriteria;
        $criteria->addCondition('page_id='.  intval($id).' '.$additional_condition);
        
        $count=$this->model->count($criteria);
        $row=array();
        if($count)
        {
            $row=$this->model->find($criteria);
        }
        
        return array('count'=>$count,'row'=>$row,);
        
    }
    
}

?>
