<?php
/* @var $this ProjectController */
/* @var $model project */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'project-form',
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
        <?php echo $form->labelEx($model, 'project_name'); ?>
        <?php echo $form->textField($model, 'project_name', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'project_url'); ?>
        <?php echo $form->textField($model, 'project_url', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'project_description'); ?>
        <?php echo $form->textArea($model, 'project_description', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'project_description'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'project_budget'); ?>
        <?php echo $form->textField($model, 'project_budget', array('size' => 20, 'maxlength' => 20)); ?>
    </div>

    <div class="row">
        <?php
        if (!$model->isNewRecord &&
                is_file(Yii::getPathOfAlias('webroot') . '/files/images/project/' . $model->project_icon)) {
            $link = '<div style="margin-left:173px;margin-top:-9px;"/>' . CHtml::link('avatar', Yii::app()->baseUrl . '/files/images/project/' . $model->project_icon, array('target' => '_blank')) . "</div>";
        }
        else
            $link = '';
        ?>
        <?php echo $form->labelEx($model, 'project_icon'); ?>
<?php echo $form->fileField($model, 'project_icon'); ?>
        <?php echo $link;?>
    </div>

    <div class="row buttons">
<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Update', array('class' => 'btn btn-primary')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->