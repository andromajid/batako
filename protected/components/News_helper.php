<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class News_helper{
    
    
    public static function category_name($id)
    {
        $sql='SELECT news_category_title FROM site_news_category WHERE news_category_id='.  intval($id);
        
        return Yii::app()->db->createCommand($sql)->queryScalar();
    }
    
}

?>
