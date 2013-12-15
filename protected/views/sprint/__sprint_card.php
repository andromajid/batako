<?php
$is_draggable = $row['task_assign_user_id'] == $this->admin_auth->user_id ? 'is_draggable ':'';
$task_color = dbHelper::getOne('task_type_color', 'task_type', 'task_type_id = ' . $row['task_task_type_id']);
$task_color_style = '';
if (isset($task_color)) {
    $task_color_style = html::generateGradien($task_color);
}
?>
<div class="block span3 draggable card-block" value="<?php echo $row['task_id']; ?>">
    <span class="card-hidden" style="display: none;"><?php echo $row['task_id']; ?></span>
    <span class="card-hidden-point" style="display: none;"><?php echo $row['task_point']; ?></span>
    <div class="<?php echo $is_draggable;?>navbar navbar-inner block-header card-header" style="background-color: #<?php echo $task_color; ?>;">
    </div>
    <div class="<?php echo $is_draggable;?>muted pull-left text-muted"><?php echo $row['task_title']; ?></div><b class="slide-card"></b>

    <div class="block-content collapse in">
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