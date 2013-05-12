<?php
/* @var $this Task_typeController */
/* @var $data task_type */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('task_type_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->task_type_id), array('view', 'id'=>$data->task_type_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('task_type_name')); ?>:</b>
	<?php echo CHtml::encode($data->task_type_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('task_type_color')); ?>:</b>
	<?php echo CHtml::encode($data->task_type_color); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('task_type_icon')); ?>:</b>
	<?php echo CHtml::encode($data->task_type_icon); ?>
	<br />


</div>