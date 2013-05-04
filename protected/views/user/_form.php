<?php
/* @var $this UserController */
/* @var $model SiteAdministrator */
/* @var $form CActiveForm */
$group_arr = CHtml::listData($group_admin, 'admin_group_id', 'admin_group_title');
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'site-administrator-form',
        'enableAjaxValidation' => false,
            ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'admin_group_id'); ?>
        <?php echo $form->dropDownList($model, 'admin_group_id', $group_arr); ?>
        <?php echo $form->error($model, 'admin_group_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'admin_username'); ?>
        <?php echo $form->textField($model, 'admin_username', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'admin_username'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'admin_password'); ?>
        <?php echo $form->passwordField($model, 'admin_password', array('size' => 60, 'maxlength' => 255, 'value' => '')); ?>
        <?php echo $form->error($model, 'admin_password'); ?>
    </div>
    <?php if ($model->isNewRecord): ?>
        <div class="row">
            <?php echo $form->labelEx($model, 'admin_is_active'); ?>
            <?php echo $form->dropDownList($model, 'admin_is_active', array('1' => 'active', '0' => 'inactive')); ?>
            <?php echo $form->error($model, 'admin_is_active'); ?>
        </div>
    <?php endif; ?>
    <div class="row buttons">
        <?php
        $this->widget('zii.widgets.jui.CJuiButton', array(
            'name' => 'active',
            'caption' => $model->isNewRecord ? 'Create' : 'Save',
            'htmlOptions' => array('class' => 'btn-primary')));
        ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->