<?php
/* @var $this ProjectController */
/* @var $model project */

$this->breadcrumbs=array(
	'Projects'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List project', 'url'=>array('index')),
	array('label'=>'Manage project', 'url'=>array('admin')),
);
?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>