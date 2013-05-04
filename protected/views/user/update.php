<?php
/* @var $this UserController */
/* @var $model SiteAdministrator */

$this->breadcrumbs=array(
	'Site Administrators'=>array('index'),
	$model->admin_id=>array('view','id'=>$model->admin_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SiteAdministrator', 'url'=>array('index')),
	array('label'=>'Create SiteAdministrator', 'url'=>array('create')),
	array('label'=>'View SiteAdministrator', 'url'=>array('view', 'id'=>$model->admin_id)),
	array('label'=>'Manage SiteAdministrator', 'url'=>array('admin')),
);
?>
<?php $this->beginWidget('zii.widgets.CPortlet', array('title' => 'Update SiteAdministrator '.$model->admin_username, 'hideOnEmpty' => TRUE)); ?> 
<?php echo $this->renderPartial('_form', array('model'=>$model, 'group_admin' => $group_admin)); ?>
<?php $this->endWidget();?>