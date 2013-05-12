<?php
/* @var $this Task_typeController */
/* @var $model task_type */

$this->breadcrumbs=array(
	'Task Types'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List task_type', 'url'=>array('index')),
	array('label'=>'Create task_type', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('task-type-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Task Types</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'task-type-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'task_type_id',
		'task_type_name',
		'task_type_color',
		'task_type_icon',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
