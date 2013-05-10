<?php
/* @var $this UserController */
/* @var $model user */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->user_id,
);

$this->menu=array(
	array('label'=>'List user', 'url'=>array('index')),
	array('label'=>'Create user', 'url'=>array('create')),
	array('label'=>'Update user', 'url'=>array('update', 'id'=>$model->user_id)),
	array('label'=>'Delete user', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->user_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage user', 'url'=>array('admin')),
);
?>

<h1>View user #<?php echo $model->user_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'user_id',
		'username',
		'user_realname',
		'user_email',
		'user_password',
		'user_is_active',
		'user_is_administrator',
		'user_avatar',
		'user_role_user_role_id',
	),
)); ?>
