<?php
/* @var $this UserController */
/* @var $model SiteAdministrator */

$this->breadcrumbs=array(
	'Site Administrators'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SiteAdministrator', 'url'=>array('index')),
	array('label'=>'Manage SiteAdministrator', 'url'=>array('admin')),
);
?>
<?php $this->beginWidget('zii.widgets.CPortlet', array('title' => 'Create SiteAdministrator', 'hideOnEmpty' => TRUE)); ?> 

<?php echo $this->renderPartial('_form', array('model'=>$model, 'group_admin' => $group_admin)); ?>
<?php $this->endWidget();?>