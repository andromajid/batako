<?php
/* @var $this UserController */
/* @var $data SiteAdministrator */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('admin_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->admin_id), array('view', 'id'=>$data->admin_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('admin_group_id')); ?>:</b>
	<?php echo CHtml::encode($data->admin_group_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('admin_username')); ?>:</b>
	<?php echo CHtml::encode($data->admin_username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('admin_password')); ?>:</b>
	<?php echo CHtml::encode($data->admin_password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('admin_last_login')); ?>:</b>
	<?php echo CHtml::encode($data->admin_last_login); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('admin_is_active')); ?>:</b>
	<?php echo CHtml::encode($data->admin_is_active); ?>
	<br />


</div>