<?php
/* @var $this UserController */
/* @var $model SiteAdministrator */

$this->breadcrumbs=array(
	'Site Administrators'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List SiteAdministrator', 'url'=>array('index')),
	array('label'=>'Create SiteAdministrator', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('site-administrator-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Site Administrators</h1>

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
	'id'=>'site-administrator-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array('name' => 'admin_group_id',
                      'header' => 'Group Administrator',
                      'value' => 'dbHelper::getOne(\'admin_group_title\',\'site_administrator_group\', \'admin_group_id =\'.$data->admin_group_id)'),
		'admin_username',
		'admin_password',
		'admin_last_login',
		'admin_is_active',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
