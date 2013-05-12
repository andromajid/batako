<?php
/* @var $this Task_typeController */
/* @var $model task_type */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'task_type_id'); ?>
		<?php echo $form->textField($model,'task_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'task_type_name'); ?>
		<?php echo $form->textField($model,'task_type_name',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'task_type_color'); ?>
		<?php echo $form->textField($model,'task_type_color',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'task_type_icon'); ?>
		<?php echo $form->textField($model,'task_type_icon',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->