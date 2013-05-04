<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Site Administrators',
);

$this->menu=array(
	array('label'=>'Create SiteAdministrator', 'url'=>array('create')),
	array('label'=>'Manage SiteAdministrator', 'url'=>array('admin')),
);
?>

<h1>Site Administrators</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
