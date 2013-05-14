<?php
/* @var $this ProjectController */
/* @var $model project */
/* @var $form CActiveForm */
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/timepicker/timepicker.js', CClientScript::POS_END);
Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/js/timepicker/timepicker.css');
Yii::app()->getClientScript()->registerScript('timepicker', '
    jQuery(".' . CHtml::activeId($model, 'task_start_datetime') . '").datetimepicker();
', CClientScript::POS_READY);
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
        <?php echo $form->labelEx($model, 'task_title'); ?>
        <?php echo $form->textField($model, 'task_title', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'task_description'); ?>
        <?php
        $this->widget('ext.redactor.ImperaviRedactorWidget', array(
            // you can either use it for model attribute
            'model' => $model,
            'attribute' => 'task_description',
        ));
        ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'task_assign_user_id'); ?>
        <?php echo $form->dropDownList($model, 'task_assign_user_id', CHtml::listData(user::model()->findAll('user_is_active=\'1\''), 'user_id', 'username'), array('empty' => 'select User')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'task_start_datetime'); ?>
        <div class="input-append<?php echo " " . CHtml::activeId($model, 'task_start_datetime'); ?>">
            <?php echo $form->textField($model, 'task_start_datetime', array('readonly' => 'readonly', 'size' => 60, 'maxlength' => 255)); ?>
            <span class="add-on">
                <i data-time-icon="icon-time" class="icon-calendar" data-date-icon="icon-calendar">
                </i>
            </span>
        </div>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'task_task_type_id'); ?>
        <?php echo $form->dropDownList($model, 'task_task_type_id', CHtml::listData(task_type::model()->findAll(), 'task_type_id', 'task_type_name'), array('empty' => 'select task type')); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'task_progress'); ?>
        <?php echo $form->textField($model, 'task_progress', array('readonly' => 'readonly','size' => 2, 'maxlength' => 3,'style' => 'width:25px;float:left;margin-right:4px;')); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiSlider', array(
            'value' => 0,
            // additional javascript options for the slider plugin
            'options' => array(
                'min' => 0,
                'max' => 100,
                'slide' => 'js:function(event, ui) {
                    jQuery("#'.CHtml::activeId($model, 'task_progress').'").val(ui.value);
                }'
            ),
            'htmlOptions' => array(
                'style' => 'width:200px;float:left;margin-top:9px;',
            ),
        ));
        ?>
    </div>
    <div class="row buttons">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Update', array('class' => 'btn btn-primary')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->