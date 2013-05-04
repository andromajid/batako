<?php

$this->breadcrumbs = array(
    'Group Admin' => array('usergroup/index'),
    'Create',
);

$this->menu = array(
    array('label' => 'Group Admin', 'url' => array('usergroup')),
);
?>
<?php $this->beginWidget('zii.widgets.CPortlet', array('title' => 'Create Group Admin', 'hideOnEmpty' => TRUE)); ?>     
<?php $this->endWidget(); ?>