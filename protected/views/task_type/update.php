<?php
/* @var $this Task_typeController */
/* @var $model task_type */

$this->breadcrumbs=array(
	'Task Types'=>array('index'),
	$model->task_type_id=>array('view','id'=>$model->task_type_id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create task_type', 'url'=>array('create')),
	array('label'=>'Manage task_type', 'url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>