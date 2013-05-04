<?php
/* @var $this UserController */
/* @var $model SiteAdministrator */

$this->breadcrumbs=array(
	'Site Administrators'=>array('index'),
	$model->admin_id,
);

$this->menu=array(
	array('label'=>'List SiteAdministrator', 'url'=>array('index')),
	array('label'=>'Create SiteAdministrator', 'url'=>array('create')),
	array('label'=>'Update SiteAdministrator', 'url'=>array('update', 'id'=>$model->admin_id)),
	array('label'=>'Delete SiteAdministrator', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->admin_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SiteAdministrator', 'url'=>array('admin')),
);
?>

<h1>View SiteAdministrator #<?php echo $model->admin_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'admin_id',
		'admin_group_id',
		'admin_username',
		'admin_password',
		'admin_last_login',
		'admin_is_active',
	),
)); ?>
