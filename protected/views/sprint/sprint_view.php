<?php
Yii::app()->getClientScript()->registerCss('td', '
.table-striped td {
min-width:100px;
}
');
Yii::app()->getClientScript()->registerScript('ajax-assign', '
jQuery(".action-user .btn-success, .action-user .btn-danger").bind("click", function() {
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
                    jQuery(this_btn).next().css({display : "block"});
                } else {
                    jQuery(this_btn).html("assign to me");
                    jQuery(this_btn).addClass("btn "+data.btn);
                    jQuery("#assign-"+task_id_var).html("");
                    jQuery(this_btn).next().css({display : "none"});
                }
            }
        }
    });
});
jQuery(".action-user .btn-primary").bind("click", function() {
    var task_id_var = jQuery(this).attr("data");
    var this_btn = this;
    jQuery.ajax({
        url : "' . $this->createUrl('/sprint/start_task') . '",
        data : {task_id : task_id_var},
        type : "post",
        dataType : "json",
        beforeSend : function() {
            jQuery(this_btn).html("wait a second");
        },
        success : function(data) {
            if(!data.error) {
                window.location = "'.$this->createUrl('/task/view/task_id').'/"+task_id_var;
            } else {
                alert("Error : ada kesalahan system silahkan ulangi lagi");
            }
        }
    })
});
');
$this->widget('zii.widgets.jui.CJuiSortable', array(
    // additional javascript options for the JUI Sortable plugin
    'options' => array(
    ),
));
$total_point = 0;
foreach($task_sprint as $row) {
    $total_point += $row['task_point'];
} 
?>
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
<h3>task dalam Sprint : </h3>
<?php
$task_project = $task_sprint;
$this->widget('application.widget.widget_task_list', array('task_list' => $task_project));
?>