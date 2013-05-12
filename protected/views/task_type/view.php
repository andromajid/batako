<?php
/* @var $this Task_typeController */
/* @var $model task_type */

$this->breadcrumbs=array(
	'Task Types'=>array('index'),
	$model->task_type_id,
);

$this->menu=array(
	array('label'=>'List task_type', 'url'=>array('index')),
	array('label'=>'Create task_type', 'url'=>array('create')),
	array('label'=>'Update task_type', 'url'=>array('update', 'id'=>$model->task_type_id)),
	array('label'=>'Delete task_type', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->task_type_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage task_type', 'url'=>array('admin')),
);
?>

<h1>View task_type #<?php echo $model->task_type_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'task_type_id',
		'task_type_name',
		'task_type_color',
		'task_type_icon',
	),
)); ?>
