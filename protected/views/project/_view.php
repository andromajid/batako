<?php
/* @var $this ProjectController */
/* @var $data project */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('project_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->project_id), array('view', 'id'=>$data->project_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('project_name')); ?>:</b>
	<?php echo CHtml::encode($data->project_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('project_url')); ?>:</b>
	<?php echo CHtml::encode($data->project_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('project_description')); ?>:</b>
	<?php echo CHtml::encode($data->project_description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('project_budget')); ?>:</b>
	<?php echo CHtml::encode($data->project_budget); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('project_icon')); ?>:</b>
	<?php echo CHtml::encode($data->project_icon); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('project_is_active')); ?>:</b>
	<?php echo CHtml::encode($data->project_is_active); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('project_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->project_user_id); ?>
	<br />

	*/ ?>

</div>