<?php
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/timepicker/timepicker.js', CClientScript::POS_END);
Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/js/timepicker/timepicker.css');
Yii::app()->getClientScript()->registerScript('timepicker', '
    jQuery(".' . CHtml::activeId($sprint, 'sprint_start_date') . ', .' . CHtml::activeId($sprint, 'sprint_end_date') . '").datetimepicker({pickTime:false,format:"yyyy-MM-dd"});
'."$('.card-place').sortable({  
    connectWith: '.card-place',  
    handle: '.card-header,.muted',  
    cursor: 'move',  
    placeholder: 'placeholder',  
    forcePlaceholderSize: true,  
    opacity: 0.4,  
    stop: function(event, ui){  
        $(ui.item).find('.card-header').click();  
    }  
})  
.disableSelection();  " , CClientScript::POS_READY);
$this->widget('zii.widgets.jui.CJuiSortable', array(
    // additional javascript options for the JUI Sortable plugin
    'options' => array(
    ),
));
?>
<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'task-comment-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>
    <div class="row">
        <?php echo $form->labelEx($sprint, 'sprint_name'); ?>
        <?php echo $form->textField($sprint, 'sprint_name', array('size' => 60, 'maxlength' => 255)); ?>
    </div>
    <div class="row">
        <?php echo CHtml::label('Rentang Sprint', 'sorint_start_date'); ?>
        <div class="input-append<?php echo " " . CHtml::activeId($sprint, 'sprint_start_date'); ?>">
            <?php echo $form->textField($sprint, 'sprint_start_date', array('readonly' => 'readonly', 'size' => 60, 'maxlength' => 255)); ?>
            <span class="add-on">
                <i data-time-icon="icon-time" class="icon-calendar" data-date-icon="icon-calendar">
                </i>
            </span>
        </div>
        <span style="margin: 0px 6px;"> To </span>
        <div class="input-append<?php echo " " . CHtml::activeId($sprint, 'sprint_end_date'); ?>">
            <?php echo $form->textField($sprint, 'sprint_end_date', array('readonly' => 'readonly', 'size' => 60, 'maxlength' => 255)); ?>
            <span class="add-on">
                <i data-time-icon="icon-time" class="icon-calendar" data-date-icon="icon-calendar">
                </i>
            </span>
        </div>
    </div>
    <h3>Sprint Task : </h3>
    <div class="span5">
        <!-- block -->
        <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left">Clients</div>
                <div class="pull-right"><span class="badge badge-info">17</span>

                </div>
            </div>
            <div class="block-content collapse in card-place">
                <?php $this->renderPartial('//task/task_project', array('task_project' => $task_project)) ?>

            </div>
        </div>
        <!-- /block -->
    </div>
    <div class="span5">
        <!-- block -->
        <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left">Sprint Task</div>
            </div>
            <div class="block-content collapse in card-place">

            </div>
        </div>
        <!-- /block -->
    </div>
</div>
<?php $this->endWidget(); ?>
</div>