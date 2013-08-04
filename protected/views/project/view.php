<?php
/* @var $this ProjectController */
/* @var $model project */

$this->breadcrumbs=array(
	'Projects'=>array('index'),
	$model->project_id,
);

$this->menu=array(
	array('label'=>'List project', 'url'=>array('index')),
	array('label'=>'Create project', 'url'=>array('create')),
	array('label'=>'Update project', 'url'=>array('update', 'id'=>$model->project_id)),
	array('label'=>'Delete project', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->project_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage project', 'url'=>array('admin')),
);
$this->widget('application.widget.widget_project_profile',array('project_id' => $_GET['id']));
?>
<span class="clearfix"></span>
<h3>Task Dalam Project <?php echo $model->project_name?> : </h3>
<?php $this->widget('application.widget.widget_task_list', array('task_list' => $task_list));
