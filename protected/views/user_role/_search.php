<?php
/* @var $this User_roleController */
/* @var $model user_role */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'user_role_id'); ?>
		<?php echo $form->textField($model,'user_role_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_role_name'); ?>
		<?php echo $form->textField($model,'user_role_name',array('size'=>60,'maxlength'=>127)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_role_is_active'); ?>
		<?php echo $form->textField($model,'user_role_is_active',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->