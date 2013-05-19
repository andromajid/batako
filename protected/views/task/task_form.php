<?php
echo CHtml::button('create comment', array('class' => 'btn btn-success',
    'style' => 'margin-left:24px;',
    'onClick' => 'js:$(".form-comment").slideToggle(100)'));
?>
<br />
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
        <?php echo CHtml::label('file', 'file_name'); ?>
        <?php echo CHtml::fileField('file_name[]', '', array('multiple' => 'multiple')); ?>
    </div> 
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Update', array('class' => 'btn btn-primary', 'name' => 'submit_comment')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
<?php if (is_array($comment)): ?>
    <?php foreach ($comment as $row_comment): ?>
        <?php
        //buat edit diri sendiri maupun administrator
        if($row_comment['task_comment_user_id'] == $this->admin_auth->user_id || $this->admin_auth->user_is_administrator == '1') {
            $edit_icon = '<div class="pull-right">
                                <a data-toggle="tooltip" title="Update This Comment" href="'.$this->createUrl('/task/update_comment', array('comment_id' => $row_comment['task_comment_id'])).'"><i class="icon-pencil"></i></a>
                                <i class="icon-remove-sign"></i>
                                    </div>';
        } else 
            $edit_icon = '';
        ?>
        <div class="block span11 comment-box">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left"><?php echo $row_comment['username']; ?> 
                    (<?php echo function_lib::convert_datetime($row_comment['task_comment_datetime'], 'char', "-") ?>)</div>
                <?php echo $edit_icon;?>
            </div>
            <div class="block-content collapse in">
                <div class="img-comment">
                    <?php
                     $image = CHtml::image(Yii::app()->getBaseUrl().'/files/images/user/_default.jpg', 'ngga ada gambar', array('class' => 'img-circle', 'width' => 75));
                     if(is_readable(Yii::getPathOfAlias('webroot').'/files/images/user/'.$row_comment['user_avatar'])) {
                         $image = CHtml::image(Yii::app()->getBaseUrl().'/files/images/user/'.$row_comment['user_avatar'], 'ngga ada gambar', array('class' => 'img-circle', 'width' => 75));
                     }
                     echo $image;
                    ?>
                </div>
                <div class="comment-content">
                    <?php echo $row_comment['task_comment_text'];?>
                </div>
                <?php
                $file = task_comment_file::model()->getTaskFileByCommentId($row_comment['task_comment_id']);
                if(isset($file) && is_array($file) && count($file) > 0):
                ?>
                <br class="clearfix"/>
                <div style="float: left;">
                <h4>Attachment:</h4>
                <ol>
                    <?php foreach($file as $row_file):?>
                        <li><?php echo CHtml::link($row_file['file_name'],Yii::app()->baseUrl.'/files/'.$row_file['file_name']);?></li>
                    <?php endforeach;?>
                </ol>
                </div>
                <?php endif;?>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>