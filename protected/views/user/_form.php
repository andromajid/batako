<?php
/* @var $this UserController */
/* @var $model user */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'user-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php
    if ($model->hasErrors()) {
        echo '<div class="alert alert-danger">'.$form->errorSummary($model).'</div>';
    }
    ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'username'); ?>
        <?php echo $form->textField($model, 'username', array('size' => 60, 'maxlength' => 127)); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'user_realname'); ?>
        <?php echo $form->textField($model, 'user_realname', array('size' => 45, 'maxlength' => 45)); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'user_email'); ?>
        <?php echo $form->textField($model, 'user_email', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'user_password'); ?>
        <?php echo $form->textField($model, 'user_password', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'user_is_administrator'); ?>
        <?php echo $form->textField($model, 'user_is_administrator', array('size' => 1, 'maxlength' => 1)); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'user_avatar'); ?>
        <?php echo $form->textField($model, 'user_avatar', array('size' => 60, 'maxlength' => 127)); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'user_role_user_role_id'); ?>
        <?php echo $form->textField($model, 'user_role_user_role_id'); ?>
    </div>

    <div class="row buttons">
<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->