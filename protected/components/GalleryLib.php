<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of galleryLib
 *
 * @author tejomurti
 * Library untuk class lib
 */
class GalleryLib {
    //put your code here
    
    public $model_gallery;
    public $model_gallery_category;
    
    public function __construct() {
        $this->model_gallery=new SiteGallery;
        $this->model_gallery_category=new SiteGalleryCategory;
    }
    /**
     * menampilkan list kategori berita
     * @param string $condition
     * @param int $limit
     * @return object
     */
    public function list_category($condition='',$limit='unlimited')
    {
        $criteria=new CDbCriteria;
        if(trim($condition)!='')
        {
            $criteria->addCondition($condition);
        }
        if(is_numeric($limit))
        {
            $criteria->limit=$limit;
        }
        $criteria->with=array();
        
        $results=array();
        $count=$this->model_gallery_category->count($criteria);
        if($count)
        {
            $results=$this->model_gallery_category->findAll($criteria);
        }
        
        return $results;
    }
    
    /**
     * untuk menghitung jumlah artikel dalam 1 kategori
     * @param int $gallery_category_id
     */
    public function count_gallery_on_category($gallery_category_id,$condition='')
    {
        $criteria=new CDbCriteria;
        $criteria->addCondition('gallery_gallery_category_id='.  intval($gallery_category_id).' '.$condition);
        
        $count=$this->model_gallery->count($criteria);
        
        return $count;
    }
    
    /**
     * menampilkan berita by category
     * @param int $gallery_category_id
     * @param string $additional_condition
     * @return array(
     *      'count'=>'jumlah data',
     *      'results'=>'object',
     * );
     */
    public function list_gallery_by_category($gallery_category_id,$additional_condition='',$limit=10)
    {
        $criteria=new CDbCriteria;
        $criteria->addCondition('gallery_gallery_category_id='.  intval($gallery_category_id).' AND gallery_category_is_active="1" '.$additional_condition);
        $criteria->with=array('rel_gallery_to_category');
        $criteria->together=true;
        $results=array();
        $count=$this->model_gallery->count($criteria);
        if(is_numeric($limit))
        {
            $criteria->limit=$limit;
        }
        if($count)
        {
            $results=$this->model_gallery->findAll($criteria);
        }
        
       
        
        return array('count'=>$count,'results'=>$results,);
    }
    
    /**
     * list article
     * 
     * @param int $limit
     * @param string $additional_condition
     * @param string $order
     * 
     */
    public function list_gallery($limit=5, $additional_condition='',$order='gallery_id DESC')
    {
        $criteria=new CDbCriteria;
        $criteria->addCondition('gallery_is_active="1" '.$additional_condition);
        $criteria->order=$order;
        $criteria->limit=$limit;
        $criteria->with=array('rel_gallery_to_category');
        $criteria->together=true;
        $results=array();
        $count=$this->model_gallery->count($criteria);
        
        
        if($count)
        {
            $results=$this->model_gallery->findAll($criteria);
        }
        
        return array('count'=>$count,'results'=>$results);
    }
    
}

?>
