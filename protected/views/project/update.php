<?php
/* @var $this ProjectController */
/* @var $model project */

$this->breadcrumbs=array(
	'Projects'=>array('index'),
	$model->project_id=>array('view','id'=>$model->project_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List project', 'url'=>array('index')),
	array('label'=>'Create project', 'url'=>array('create')),
	array('label'=>'View project', 'url'=>array('view', 'id'=>$model->project_id)),
	array('label'=>'Manage project', 'url'=>array('admin')),
);
?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>