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
    <?php if (!$model->isNewRecord): ?>
        <?php echo CHtml::hiddenField('old_password', $model->user_password); ?>
    <?php endif; ?>
    <?php
    unset($model->user_password);
    ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'user_password'); ?>
        <?php echo $form->passwordField($model, 'user_password', array('size' => 60, 'maxlength' => 255)); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'user_is_administrator'); ?>
        <?php echo $form->checkBox($model, 'user_is_administrator') ?>
    </div>

    <div class="row">
        <?php
        if (!$model->isNewRecord &&
                is_file(Yii::getPathOfAlias('webroot') . '/files/images/user/' . $model->user_avatar)) {
            $link = '<div style="margin-left:173px;margin-top:-9px;"/>' . CHtml::link('avatar', Yii::app()->baseUrl . '/files/images/user/' . $model->user_avatar, array('target' => '_blank')) . "</div>";
        }
        else
            $link = '';
        ?>
        <?php echo $form->labelEx($model, 'user_avatar'); ?>
        <?php echo $form->fileField($model, 'user_avatar'); ?>
<?php echo $link; ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'user_role_user_role_id'); ?>
<?php echo $form->dropDownList($model, 'user_role_user_role_id', CHtml::listData(user_role::model()->findAll('user_role_is_active=\'1\''), 'user_role_id', 'user_role_name'), array('empty' => 'select Type')); ?>
    </div>

    <div class="row buttons">
<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Update', array('class' => 'btn btn-primary')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->