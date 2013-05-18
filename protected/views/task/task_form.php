<?php
echo CHtml::button('create comment', array('class' => 'btn btn-success', 
                                           'onClick' => 'js:$(".form-comment").slideToggle(100)'));
?>
<div class="form form-comment">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'task-comment-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'task_comment_text'); ?>
        <?php
        $this->widget('ext.redactor.ImperaviRedactorWidget', array(
            // you can either use it for model attribute
            'model' => $model,
            'attribute' => 'task_comment_text',
        ));
        ?>
    </div>
    <div class="row"> 
        <?php echo CHtml::label('file','file_name'); ?>
        <?php echo CHtml::fileField('file_name[]', '', array('multiple' => 'multiple')); ?>
    </div> 
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Update', array('class' => 'btn btn-primary', 'name' => 'submit_comment')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->