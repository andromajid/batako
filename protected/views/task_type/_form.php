<?php
/* @var $this Task_typeController */
/* @var $model task_type */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'task-type-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php
    if ($model->hasErrors()) {
        echo '<div class="alert alert-danger">' . $form->errorSummary($model) . '</div>';
    }
    ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'task_type_name'); ?>
        <?php echo $form->textField($model, 'task_type_name', array('size' => 45, 'maxlength' => 45)); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'task_type_color'); ?>
        <?php
        $this->widget('application.widget.colorpicker.EColorPicker', array(
            'name' => 'cp',
            'mode' => 'textfield',
            'fade' => false,
            'slide' => false,
            'curtain' => true,
        ));
        ?>
<?php echo $form->textField($model, 'task_type_color', array('size' => 10, 'maxlength' => 10)); ?>
    </div>

    <div class="row">
        <?php
        if (!$model->isNewRecord &&
                is_file(Yii::getPathOfAlias('webroot') . '/files/images/' . $model->task_type_icon)) {
            $link = '<div style="margin-left:173px;margin-top:-9px;"/>' . CHtml::link('avatar', Yii::app()->baseUrl . '/files/images/user/' . $model->task_type_icon, array('target' => '_blank')) . "</div>";
        }
        else
            $link = '';
        ?>
        <?php echo $form->labelEx($model, 'task_type_icon'); ?>
<?php echo $form->fileField($model, 'task_type_icon');
echo $link;
?>
    </div>

    <div class="row buttons">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->