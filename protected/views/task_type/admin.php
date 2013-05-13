<?php

/* @var $this Task_typeController */
/* @var $model task_type */

$this->breadcrumbs = array(
    'Task Types' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'Create task_type', 'url' => array('create')),
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
<?php

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'task-type-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array(
            'header' => 'No.',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)."."',
            'htmlOptions' => array('style' => 'text-align:center;'),
        ),
        'task_type_name',
        array('header' => 'Task Type Color',
            'name' => 'task_type_color',
            'type' => 'html',
            'filter' => false,
            'htmlOptions' => array('align' => 'center'),
            'value' => function($data) {
                return CHtml::tag('div', array('style' => 'width:32px;height:32px;background-color:#' . $data->task_type_color . ';', 'class' => 'img-circle'), '', '</div>');
            }
        ),
        array('header' => 'task icon',
            'name' => 'task_type_icon',
            'type' => 'html',
            'filter' => false,
            'htmlOptions' => array('style' => 'text-align:center;'),
            'value' => function($data) {
                if (is_file(Yii::getPathOfAlias('webroot') . '/files/images/task/' . $data->task_type_icon)) {
                    return CHtml::image(Yii::app()->baseUrl . '/files/images/task/' . $data->task_type_icon, $data->task_type_icon, array('class' => 'img-circle', 'width' => '25px'));
                } else {
                    return '';
                }
            },
        ),
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
