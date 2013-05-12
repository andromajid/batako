<?php

/* @var $this ProjectController */
/* @var $model project */

$this->breadcrumbs = array(
    'Projects' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List project', 'url' => array('index')),
    array('label' => 'Create project', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('project-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'project-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array(
            'header' => 'No.',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)."."',
            'htmlOptions' => array('style' => 'text-align:center;'),
        ),
        'project_name',
        array(
            'name' => 'project_url',
            'type' => 'html',
            //'value' => 'isset($data->project_url)?Chtml::link($data->project_name, $data->project_url, array("target" => "_BLANK"):""'
            'value' => function($data) {
                return isset($data->project_url) ? CHtml::link($data->project_name, $data->project_url, array("target" => "_BLANK")) : "";
            }
        ),
        array(
            'name' => 'project_budget',
            'value' => function($data) {
                return number_format($data->project_budget);
            }
        ),
        array(
            'header' => 'Product Owner',
            'value' => function($data) {
                return isset($data->project_user_id)?$data->projectUser->username:'';
            }
        ),
        array(
            'name' => 'project_icon',
            'type' => 'html',
            'filter' => false,
            'htmlOptions' => array('style' => 'text-align:center;'),
            'value' => function($data) {
                if(is_file(Yii::getPathOfAlias('webroot') . '/files/images/project/' . $data->project_icon)) {
                    return CHtml::image(Yii::app()->baseUrl.'/files/images/project/'.$data->project_icon, $data->project_icon, array('class' => 'img-circle', 'width' => '25px'));
                } else {
                    return '';
                }
            }
        ),
        /*
          'project_is_active',
          'project_user_id',
         */
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
