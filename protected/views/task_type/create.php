<?php
/* @var $this Task_typeController */
/* @var $model task_type */

$this->breadcrumbs=array(
	'Task Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List task_type', 'url'=>array('index')),
	array('label'=>'Manage task_type', 'url'=>array('admin')),
);
?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>