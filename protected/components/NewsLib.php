<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NewsLib
 *
 * @author tejomurti
 * Library untuk class lib
 */
class NewsLib {
    //put your code here
    
    public $model_news;
    public $model_news_category;
    
    public function __construct() {
        $this->model_news=new site_news;
        $this->model_news_category=new site_news_category;
    }
    
    /**
     * fungsi searching data news
     * @param string $query
     */
    public function search($query='',$fields=array('news_title','news_content'),$limit=10, $offset=0)
    {
        $purify=new CHtmlPurifier;
        $keywords=$purify->purify($query);
        $sql='SELECT * FROM site_news WHERE ';

		$explode_keywords=explode('_',$keywords);
		if(isset($explode_keywords) AND is_array($explode_keywords))
		{
			$field_no=1;
			foreach($fields AS $field)
			{
				$no=1;
				foreach($explode_keywords AS $val)
				{
					$op_or=($field_no<count($fields) AND $no==count($explode_keywords))?' OR ':'';
					$sep_1=($no==1)?'( ':'';
					$sep_2=($no==count($explode_keywords))?' )':'';
					$op_and=($no<count($explode_keywords))?'AND':'';
					
					$sql.=$sep_1.$field.' LIKE "%'.$val.'%" '.$op_and.' '.$sep_2.$op_or;
					
					$no++;
				}
				
				$field_no++;
			}
				
		}
		$sql.='  GROUP BY news_id ORDER BY news_id DESC LIMIT '.$offset.','.$limit.'';
                
             $criteria=new CDbCriteria;
             $criteria->limit=$limit;
             $criteria->offset=$offset;
             $pagination = new CPagination($count);
             $pagination->pageSize = Yii::app()->params['newsPerPage'];
             $pagination->applyLimit($criteria);   
             
             $results=Yii::app()->db->createCommand($sql)->queryAll();   
             if(empty($results))
             {
                 $results=array();
             }
             
             $count=count($results);
             return array('count'=>$count,'results'=>$results,'pagination'=>$pagination);
    }
    
    function highlightWords_search($string,$words,$ajax=false)
 	{
 	
 		$words=explode(' ',$words);
 		
 		for($i=0;$i<sizeOf($words);$i++) {
 		
 			if($ajax==true)
 			{
 				$string=str_ireplace($words[$i], '<strong class=\"highlight\">'.$words[$i].'<\/strong>', $string);
 			} else {
 				$string=str_ireplace($words[$i], '<strong class="highlight">'.$words[$i].'</strong>', $string);
 			}
  			
  		}
  		
 		return $string;
	}
	
	function cleanHTML_search($input, $ending='...') 
	{
 
    	$output = strip_tags($input);
 
    	$output = substr($output, 0, 100);
    	$output .= $ending;
    
    
    	return $output;
	}
    
    /**
     * menampilkan list kategori berita
     * @param string $condition
     * @return array
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
        $count=$this->model_news_category->count($criteria);
        if($count)
        {
            $results=$this->model_news_category->findAll($criteria);
        }
        
        return $results;
    }
    
    /**
     * untuk menghitung jumlah artikel dalam 1 kategori
     * @param int $news_category_id
     */
    public function count_news_on_category($news_category_id,$condition='')
    {
        $criteria=new CDbCriteria;
        $criteria->addCondition('news_news_category_id='.  intval($news_category_id).' '.$condition);
        
        $count=$this->model_news->count($criteria);
        
        return $count;
    }
    
    /**
     * menampilkan berita by category
     * @param int $news_category_id
     * @param string $additional_condition
     * @param bool $paging false;
     * @return array(
     *      'count'=>'jumlah data',
     *      'results'=>'object',
     * );
     */
    public function list_news_by_category($news_category_id=null,$additional_condition='',$paging=false,$limit='unlimited',$order='news_id DESC')
    {
        $criteria=new CDbCriteria;
        if(isset($news_category_id) AND is_numeric($news_category_id))
        {
            $criteria->addCondition('news_news_category_id='.  intval($news_category_id));
        }
        $criteria->addCondition('news_category_is_active="1" '.$additional_condition);
        $criteria->with=array('rel_news_to_news_category');
        $criteria->order=$order;
        $criteria->together=true;
        
        if(is_numeric($limit))
        {
            $criteria->limit=$limit;
        }
        
        $results=array();
        $count=$this->model_news->count($criteria);
        $pagination=array();
        if($paging==true)
        {
            $pagination = new CPagination($count);
            $pagination->pageSize = Yii::app()->params['newsPerPage'];
            $pagination->applyLimit($criteria);
        }
        if($count)
        {
            $results=$this->model_news->findAll($criteria);
        }
        
       
        
        return array('count'=>$count,'results'=>$results,'pagination'=>$pagination,);
    }
    
    /**
     * list article
     * 
     * @param int $limit
     * @param string $additional_condition
     * @param string $order
     * 
     */
    public function list_news($limit=5, $additional_condition='AND news_category_type="news"',$order='news_id DESC')
    {
        $criteria=new CDbCriteria;
        $criteria->addCondition('news_is_active="1" AND news_is_criteria="general" '.$additional_condition);
        $criteria->order=$order;
        $criteria->limit=$limit;
        $criteria->with=array('rel_news_to_news_category');
        $criteria->together=true;
        $results=array();
        $count=$this->model_news->count($criteria);
        
        
        if($count)
        {
            $results=$this->model_news->findAll($criteria);
        }
        
        return array('count'=>$count,'results'=>$results);
    }
    
}

?>
