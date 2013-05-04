<?php
/* @var $this UserController */
/* @var $model SiteAdministrator */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'admin_id'); ?>
		<?php echo $form->textField($model,'admin_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'admin_group_id'); ?>
		<?php echo $form->textField($model,'admin_group_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'admin_username'); ?>
		<?php echo $form->textField($model,'admin_username',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'admin_last_login'); ?>
		<?php echo $form->textField($model,'admin_last_login'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'admin_is_active'); ?>
		<?php echo $form->textField($model,'admin_is_active',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->