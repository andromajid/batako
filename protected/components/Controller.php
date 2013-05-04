<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController {

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/main';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();

    /**
     * for SEO
     */
    public $content_title;
    public $content_description;
    public $content_keywords;
    public $content_footer;
    var $langNow;
    
    public function __construct($id, $module = null) {
        parent::__construct($id, $module);
        
     //   $site_config=function_lib::site_config();
       
//        $this->content_title=$site_config['configuration_title'];
//        $this->content_description=$site_config['configuration_meta_description'];
//        $this->content_keywords=$site_config['configuration_meta_keyword'];
//        $this->content_footer=$site_config['configuration_footer'];
        
    }
    
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
                'testLimit' => 1,
                'backColor' => 0xFFFFFF,
                'width' => 155,
                'padding' => 1,
            ),
        );
    }
    
}