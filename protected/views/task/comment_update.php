<div class="form">
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
        <?php echo CHtml::label('file', 'file_name'); ?>
        <?php echo CHtml::fileField('file_name[]', '', array('multiple' => 'multiple')); ?>
        <?php if(count($file) > 0) :?>
            <h4>File Attachment:</h4>
            <?php foreach($file as $row_file):?>
            <div class="update_file_comment"><?php echo CHtml::link($row_file['file_name'], Yii::app()->getBaseUrl().'/files/'.$row_file['file_name']);?>
                <div class="pull-right"><?php echo CHtml::ajaxButton('Delete', $this->createUrl('/task/file_delete'), array('data' => "js:{file_id:".$row_file['file_id']."}",
                            'type' => 'post', 'success' => '$(this).parent().parent().remove()'), array('class' => 'btn btn-danger'))?></div></div>
            <?php endforeach;?>
        <?php endif;?>
    </div> 
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Update', array('class' => 'btn btn-primary', 'name' => 'submit_comment')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->