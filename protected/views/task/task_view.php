<?php
if ($model->hasErrors()) {
    echo '<div class="alert alert-danger">' . $form->errorSummary($model) . '</div>';
}
?>
<div class="tabbable"> <!-- Only required for left/right tabs -->
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab1" data-toggle="tab">Task Detail</a></li>
        <li><a href="#tab2" data-toggle="tab">Task Comment</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab1">
            <table class="table table-bordered card-detail">
                <tr>
                    <td>Nama Task</td>
                    <td><?php echo $task['task_title']; ?></td>
                </tr>
                <tr>
                    <td>Deskripsi Task</td>
                    <td><?php echo $task['task_description']; ?></td>
                </tr>
                <tr>
                    <td>File Attachment</td>
                    <td>
                        <?php if (isset($file) && is_array($file)): ?>
                            <ul>
                                <?php foreach ($file as $row_file): ?>
                                    <?php
                                    $file_path = Yii::getPathOfAlias('webroot') . '/files/' . $row_file['file_name'];
                                    if (function_lib::checkImage($file_path)) {
                                        $content_file = CHtml::image(Yii::app()->baseUrl . '/files/' . $row_file['file_name'], $row_file['file_name'], array('width' => 200));
                                    }
                                    else
                                        $content_file = CHtml::link($row_file['file_name'], Yii::app()->baseUrl . '/files/' . $row_file['file_name'], array('target' => '_blank'));
                                    ?>
                                    <li><?php echo $content_file; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td>Jenis Task</td>
                    <td><?php echo isset($task['task_task_type_id']) ? dbHelper::getOne('task_type_name', 'task_type', 'task_type_id = ' . $task['task_task_type_id']) : ''; ?></td>
                </tr>
                <tr>
                    <td>Point Task</td>
                    <td><?php echo $task['task_point']; ?></td>
                </tr>
                <tr>
                    <td>Pembuat task</td>
                    <td><?php echo isset($task['task_creator_user_id']) ? dbHelper::getOne('username', 'user', 'user_id = ' . $task['task_creator_user_id']) : ''; ?></td>
                </tr>
                <tr>
                    <td>Tanggal Pembuatan</td>
                    <td><?php echo isset($task['task_create_datetime']) ? function_lib::convert_datetime($task['task_create_datetime'], 'char', '-') : ''; ?></td>
                </tr>
                <tr>
                    <td>Task Assignee</td>
                    <td><?php echo isset($task['task_assign_user_id']) ? dbHelper::getOne('username', 'user', 'user_id=' . $task['task_assign_user_id']) : ''; ?></td>
                </tr>
                <tr>
                    <td>Estimasi Pengerjaan</td>
                    <td><?php echo $task['task_estimate_hour']; ?></td>
                </tr>
                <tr>
                    <td>Status Task</td>
                    <td><?php echo $task['task_is_end'] == '1' ? 'Closed' : 'Open'; ?></td>
                </tr>
                <tr>
                    <td>Progress Task</td>
                    <td><input type="text" name="progress_task" value="<?php echo $task['task_progress']; ?>" readonly="readonly" style="width: 30px;float:left;"/> 
                        <?php
                        $this->widget('zii.widgets.jui.CJuiSlider', array(
                            'value' => $task['task_progress'],
                            // additional javascript options for the slider plugin
                            'options' => array(
                                'min' => 0,
                                'max' => 100,
                                'slide' => 'js:function(event, ui) {
                    jQuery("input[name=progress_task]").val(ui.value);
                }'
                            ),
                            'htmlOptions' => array(
                                'style' => 'width:200px;float:left;margin-top:9px;margin-left:10px;',
                            ),
                        ));
                        echo CHtml::ajaxButton('Update Progress', $this->createUrl('/task/update_progress'), array('data' => "js:{progress_task:jQuery('input[name=progress_task]').val(),task_id:" . $_GET['task_id'] . "}",
                            'type' => 'post'), array('class' => 'btn  btn-danger', 'style' => 'margin-left:10px;'));
                        ?>
                    </td>
                </tr>
            </table>
            <div class="button-list">
                <?php
                echo CHtml::ajaxButton('Done Task', $this->createUrl('/task/done_task'), array('data' => "js:{task_id:" . $_GET['task_id'] . "}",
                    'type' => 'post'), array('class' => 'btn  btn-primary'));
                ?>
            </div>
        </div>
        <div class="tab-pane" id="tab2">
            <?php $this->renderPartial('task_form', array('model' => $model))?>
        </div>
    </div>
</div>
