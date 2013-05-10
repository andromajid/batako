<?php
/* @var $this User_roleController */
/* @var $model user_role */

$this->breadcrumbs=array(
	'User Roles'=>array('list'),
	$model->user_role_id,
);

$this->menu=array(
	array('label'=>'List user_role', 'url'=>array('index')),
	array('label'=>'Create user_role', 'url'=>array('create')),
	array('label'=>'Update user_role', 'url'=>array('update', 'id'=>$model->user_role_id)),
	array('label'=>'Delete user_role', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->user_role_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage user_role', 'url'=>array('admin')),
);
?>

<h1>View user_role #<?php echo $model->user_role_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'user_role_id',
		'user_role_name',
		'user_role_is_active',
	),
)); ?>
