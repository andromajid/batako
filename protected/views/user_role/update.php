<?php
/* @var $this User_roleController */
/* @var $model user_role */

$this->breadcrumbs=array(
	'User Roles'=>array('index'),
	$model->user_role_id=>array('view','id'=>$model->user_role_id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create user_role', 'url'=>array('create')),
	array('label'=>'List User Role', 'url'=>array('list')),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>