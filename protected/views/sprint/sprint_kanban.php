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
                    var parent = jQuery(this_btn).parentsUntil("div.draggable");
                    parent.find(".muted").addClass("is_draggable");
                    parent.find(".card-header").addClass("is_draggable");
                    console.log(parent.find(".card-header"));
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
    handle: '.is_draggable',  
    cursor: 'move',  
    placeholder: 'placeholder',  
    forcePlaceholderSize: true,  
    opacity: 0.4,  
    stop: function(event, ui){ 
        var card_task_id = ui.item.attr('value');
        var card_status = ui.item.parent().attr('value');
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
        //update ke ajax-nya
        jQuery.ajax({
            url : '" . $this->createUrl('/sprint/update_kanban_progress') ." ',
            data : {status : card_status, task_id : card_task_id},
            type : \"post\",
            dataType : \"json\",
            success : function(data) {
            if(data.error) {
                alert(data.message);
            } else {
            }
            }
        });
    }  
})  
.disableSelection();  
");
$link = CHtml::link('Update Sprint : ' . $sprint['sprint_name'], $this->createUrl('update', array('id' => $sprint['sprint_id'])), array('class' => 'btn btn-primary span3 submit-sprint'));

$this->widget('zii.widgets.jui.CJuiSortable', array(
    // additional javascript options for the JUI Sortable plugin
    'options' => array(
    ),
));
$total_point = 0;
foreach ($task_sprint as $row) {
    $total_point += $row['task_point'];
}
?>
<div class="span12" id="content">
    <div class="row-fluid">
        <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left"><?php echo isset($this->title) ? $this->title : 'BATAKO'; ?></div>

            </div>
            <div class="block-content collapse in">
                <?php echo($link); ?><span class="clearfix"></span><br />
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
                    <tr>
                        <td>total Point Sprint</td>
                        <td><?php echo $total_point; ?></td>
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
            <div class="block-content collapse in card-place card-place-task" value="start">
                <?php if (is_array($task_project)): ?>
                    <?php foreach ($task_project as $row): ?>
                        <?php if ($row['task_is_start'] == '0' && $row['task_is_end'] == '0'): ?>
                            <?php $this->renderPartial('__sprint_card', array('row' => $row)) ?>
                        <?php endif; ?>
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
            <div class="block-content collapse in card-place card-place-task" value="on progress">
                <?php if (is_array($task_project)): ?>
                    <?php foreach ($task_project as $row): ?>
                        <?php if ($row['task_is_start'] == '1' && $row['task_is_end'] == '0'): ?>
                            <?php $this->renderPartial('__sprint_card', array('row' => $row)) ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
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
            <div class="block-content collapse in card-place card-place-task" value="end"> 
                <?php if (is_array($task_project)): ?>
                    <?php foreach ($task_project as $row): ?>
                        <?php if ($row['task_is_start'] == '1' && $row['task_is_end'] == '1'): ?>
                            <?php $this->renderPartial('__sprint_card', array('row' => $row)) ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <!-- /block -->
    </div>
</div>