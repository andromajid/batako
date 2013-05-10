<?php
/* @var $this UserController */
/* @var $data user */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->user_id), array('view', 'id'=>$data->user_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_realname')); ?>:</b>
	<?php echo CHtml::encode($data->user_realname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_email')); ?>:</b>
	<?php echo CHtml::encode($data->user_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_password')); ?>:</b>
	<?php echo CHtml::encode($data->user_password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_is_active')); ?>:</b>
	<?php echo CHtml::encode($data->user_is_active); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_is_administrator')); ?>:</b>
	<?php echo CHtml::encode($data->user_is_administrator); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('user_avatar')); ?>:</b>
	<?php echo CHtml::encode($data->user_avatar); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_role_user_role_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_role_user_role_id); ?>
	<br />

	*/ ?>

</div>