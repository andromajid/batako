<?php
/* @var $this User_roleController */
/* @var $model user_role */

$this->breadcrumbs=array(
	'User Roles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List User Role', 'url'=>array('list')),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>