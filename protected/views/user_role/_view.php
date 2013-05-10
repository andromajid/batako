<?php
/* @var $this User_roleController */
/* @var $data user_role */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_role_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->user_role_id), array('view', 'id'=>$data->user_role_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_role_name')); ?>:</b>
	<?php echo CHtml::encode($data->user_role_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_role_is_active')); ?>:</b>
	<?php echo CHtml::encode($data->user_role_is_active); ?>
	<br />


</div>