<?php
/* @var $this UserController */
/* @var $model user */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->user_id,
);

$this->menu=array(
	array('label'=>'Create user', 'url'=>array('create')),
	array('label'=>'Update user', 'url'=>array($this->createUrl('/user/update', array('id' => $model->user_id)))),
	array('label'=>'Delete user', 'url'=>'#', 'linkOptions'=>array('submit'=>array($this->createUrl('/user/delete', array('id' => $model->user_id))),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage user', 'url'=>array('admin')),
);
?>
<?php
$this->widget('application.widget.widget_user_profile',array('username' => $_GET['id']));
