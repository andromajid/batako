<?php
Yii::app()->getClientScript()->registerCss('td', '
.table-striped td {
min-width:100px;
}
');
Yii::app()->getClientScript()->registerScript('ajax-assign', '
jQuery(".action-user button").bind("click", function() {
    var task_id_var = jQuery(this).attr("data");
    var this_btn = this;
    var this_btn_txt = jQuery(this).text();
    jQuery.ajax({
        url : "' . $this->createUrl('/sprint/assign_task') . '",
        data : {task_id : task_id_var},
        type : "post",
        dataType : "json",
        beforeSend : function() {
            jQuery(this_btn).html("wait a second");
        },
        success : function(data) {
            if(data.error) {
                alert(data.message);
                jQuery(this_btn).html(this_btn_txt);
            } else {
                jQuery(this_btn).html(this_btn_txt);
                jQuery(this_btn).removeClass();
                if(data.btn == "btn-danger") {
                    jQuery(this_btn).addClass("btn "+data.btn);
                    jQuery(this_btn).html("unassign from me");
                    jQuery("#assign-"+task_id_var).html(data.username);
                } else {
                    jQuery(this_btn).html("assign to me");
                    jQuery(this_btn).addClass("btn "+data.btn);
                    jQuery("#assign-"+task_id_var).html("");
                }
            }
        }
    });
});    
' . "
    jQuery('.card-place').sortable({  
    connectWith: '.card-place',  
    handle: '.card-header,.muted',  
    cursor: 'move',  
    placeholder: 'placeholder',  
    forcePlaceholderSize: true,  
    opacity: 0.4,  
    stop: function(event, ui){  
        var total = 0;
        $(ui.item).find('.card-header').click();  
        //hitung poin
        var point_arr = jQuery('.card-place-task .card-hidden-point');
        point_arr.each(function(id) {
            var point = parseInt(jQuery(point_arr[id]).text());
            total += point;
        });
        //update ke containernya
        jQuery('.pull-right .badge-info').html(total);
    }  
})  
.disableSelection();  
");
$link = CHtml::link('Update Sprint : ' . $sprint['sprint_title'], $this->createUrl('update', array('sprint_id' => $sprint['sprint_id'])), 
                    array('class' => 'btn btn-primary span3 submit-sprint'));

$this->widget('zii.widgets.jui.CJuiSortable', array(
    // additional javascript options for the JUI Sortable plugin
    'options' => array(
    ),
));
?>
?>
<div class="span12" id="content">
    <div class="row-fluid">
        <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left"><?php echo isset($this->title) ? $this->title : 'BATAKO'; ?></div>

            </div>
            <div class="block-content collapse in">
                
                <table class="table table-bordered table-striped" style="width: 35%;">
                    <tr>
                        <td>Nama Sprint</td>
                        <td><?php echo $sprint['sprint_name']; ?></td>
                    </tr>
                    <tr>
                        <td>tanggal Mulai</td>
                        <td><?php echo empty($sprint['sprint_start_date']) || $sprint['sprint_start_date'] == '0000-00-00' ? 'Belum di definisikan' : function_lib::convert_date($sprint['sprint_start_date'], 'char'); ?></td>
                    </tr>
                    <tr>
                        <td>tanggal Berakhir</td>
                        <td><?php echo empty($sprint['sprint_end_date']) || $sprint['sprint_end_date'] == '0000-00-00' ? 'Belum di definisikan' : function_lib::convert_date($sprint['sprint_end_date'], 'char'); ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<h3>task dalam Sprint : </h3>
<?php
$task_project = $task_sprint;
?>
<!--task list-->
<div class="scrum_view">
    <div class="span4">
        <!-- block -->
        <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left">Sprint Task</div>
                <div class="pull-right"><span class="badge badge-info">0</span>

                </div>
            </div>
            <div class="block-content collapse in card-place card-place-task">
                <?php if (is_array($task_project)): ?>
                    <?php foreach ($task_project as $row): ?>
                        <?php
                        $task_color = dbHelper::getOne('task_type_color', 'task_type', 'task_type_id = ' . $row['task_task_type_id']);
                        $task_color_style = '';
                        if (isset($task_color)) {
                            $task_color_style = html::generateGradien($task_color);
                        }
                        ?>
                        <div class="block span3 draggable card-block">
                            <span class="card-hidden" style="display: none;"><?php echo $row['task_id']; ?></span>
                            <span class="card-hidden-point" style="display: none;"><?php echo $row['task_point']; ?></span>
                            <div class="navbar navbar-inner block-header card-header" style="background-color: #<?php echo $task_color; ?>;">
                            </div>
                            <div class="muted pull-left text-muted"><?php echo $row['task_title']; ?></div><b class="slide-card"></b>

                            <div class="block-content collapse in">
                                <?php //echo function_lib::wordPendekin($row['task_description'], 30); ?><br />
                                <table class="card-table">
                                    <tr>
                                        <td>Status</td>
                                        <td><?php echo $row['task_is_end'] == '0' ? 'Open' : 'Closed'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Assignee</td>
                                        <td id='assign-<?php echo $row['task_id']; ?>'><?php echo $row['task_assign_user_id'] == null ? '' : dbHelper::getOne('username', 'user', 'user_id=' . $row['task_assign_user_id']); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Creator</td>
                                        <td><?php echo $row['task_creator_user_id'] == null ? '' : dbHelper::getOne('username', 'user', 'user_id=' . $row['task_creator_user_id']); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Project</td>
                                        <td><?php echo $row['task_project_id'] == null ? '' : dbHelper::getOne('project_name', 'project', 'project_id=' . $row['task_project_id']); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Point</td>
                                        <td><?php echo $row['task_point']; ?></td>
                                    </tr>
                                </table>
                                <?php
                                $button_arr = array();
                                if (isset($row['task_assign_user_id'])) {
                                    $button_arr = array('btn-danger', 'unassign from me');
                                } else {
                                    $button_arr = array('btn-success', 'assign to me');
                                }
                                ?>
                                <div class="action-user">
                                    <button data="<?php echo $row['task_id']; ?>" style="margin: 2px auto 0px;display:block;" class="btn <?php echo $button_arr[0] ?>"><?php echo $button_arr[1] ?></button>
                                </div>
                            </div>
                            <div class="image-tool">
                                <a href="<?php echo $this->createUrl('/task/update', array('task_id' => $row['task_id'])) ?>"><i class="icon-pencil"></i></a>
                                <a href="<?php echo $this->createUrl('/task/view', array('task_id' => $row['task_id'])); ?>"><i class="icon-search"></i></a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <!-- /block -->
    </div>
    <!--task-list-->
    <!-- -->
    <div class="span4">
        <!-- block -->
        <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left">On Progress</div>
                <div class="pull-right"><span class="badge badge-info">0</span>

                </div>
            </div>
            <div class="block-content collapse in card-place card-place-task">

            </div>
        </div>
        <!-- /block -->
    </div>
    <div class="span4">
        <!-- block -->
        <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left">Done</div>
                <div class="pull-right"><span class="badge badge-info">0</span>

                </div>
            </div>
            <div class="block-content collapse in card-place card-place-task">

            </div>
        </div>
        <!-- /block -->
    </div>
</div>