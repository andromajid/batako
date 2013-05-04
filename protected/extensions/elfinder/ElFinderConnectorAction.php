<?php

class ElFinderConnectorAction extends CAction
{
    /**
     * @var array
     */
    public $settings = array();

    public function run()
    {
//        require_once(dirname(__FILE__) . '/php/elFinderConnector.class.php');
//        require_once(dirname(__FILE__) . '/php/elFinder.class.php');
//        require_once(dirname(__FILE__) . '/php/elFinderVolumeDriver.class.php');
//        require_once(dirname(__FILE__) . '/php/elFinderVolumeLocalFileSystem.class.php');
        Yii::import('ext.elfinder.php.elFinderConnector');
        Yii::import('ext.elfinder.php.elFinder');
        Yii::import('ext.elfinder.php.elFinderVolumeDriver');
        Yii::import('ext.elfinder.php.elFinderVolumeLocalFileSystem');
        //$fm = new elFinder($this->settings);
        $fm = new elFinderConnector(new elFinder($this->settings));
        $fm->run();

    }
}
