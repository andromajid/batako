<?php
/* @var $this Task_typeController */
/* @var $model task_type */

$this->breadcrumbs=array(
	'Task Types'=>array('index'),
	$model->task_type_id=>array('view','id'=>$model->task_type_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List task_type', 'url'=>array('index')),
	array('label'=>'Create task_type', 'url'=>array('create')),
	array('label'=>'View task_type', 'url'=>array('view', 'id'=>$model->task_type_id)),
	array('label'=>'Manage task_type', 'url'=>array('admin')),
);
?>

<h1>Update task_type <?php echo $model->task_type_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>