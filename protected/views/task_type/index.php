<?php
/* @var $this Task_typeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Task Types',
);

$this->menu=array(
	array('label'=>'Create task_type', 'url'=>array('create')),
	array('label'=>'Manage task_type', 'url'=>array('admin')),
);
?>

<h1>Task Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
