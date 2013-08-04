<?php
/**
 * Widget to view task list
 * @author andro
 */
class widget_task_list extends CWidget {
    public $task_list;
    //put your code here
    public function run() {
        $this->__boot_script();
        $this->render('widget_task_list');
    }
    
    private function __boot_script() {
        Yii::app()->getClientScript()->registerScript('ajax-assign', '
        jQuery(".action-user .btn-success, .action-user .btn-danger").bind("click", function() {
            var task_id_var = jQuery(this).attr("data");
            var this_btn = this;
            var this_btn_txt = jQuery(this).text();
            jQuery.ajax({
                url : "' . Yii::app()->getController()->createUrl('/sprint/assign_task') . '",
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
                url : "' . Yii::app()->getController()->createUrl('/sprint/start_task') . '",
                data : {task_id : task_id_var},
                type : "post",
                dataType : "json",
                beforeSend : function() {
                    jQuery(this_btn).html("wait a second");
                },
                success : function(data) {
                    if(!data.error) {
                        window.location = "'.Yii::app()->getController()->createUrl('/task/view/task_id').'/"+task_id_var;
                    } else {
                        alert("Error : ada kesalahan system silahkan ulangi lagi");
                    }
                }
            })
        });
        ');
    }
}

?>
