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
            <span class="card-hidden" style="display: none;"><?php echo $row['task_id'];?></span>
            <span class="card-hidden-point" style="display: none;"><?php echo $row['task_point'];?></span>
            <div class="navbar navbar-inner block-header card-header" style="background-color: #<?php echo $task_color;?>;">
            </div>
            <div class="muted pull-left text-muted"><?php echo $row['task_title']; ?></div><b class="slide-card"></b>

            <div class="block-content collapse in">
                <?php //echo function_lib::wordPendekin($row['task_description'], 30); ?><br />
                <table class="card-table">
                    <tr>
                        <td>Status</td>
                        <td><?php echo $row['task_is_end'] == '0'?'Open':'Closed';?></td>
                    </tr>
                    <tr>
                        <td>Assignee</td>
                        <td><?php echo $row['task_assign_user_id'] == null?'':dbHelper::getOne('username', 'user', 'user_id='.$row['task_assign_user_id']);?></td>
                    </tr>
                    <tr>
                        <td>Project</td>
                        <td><?php echo $row['task_project_id'] == null?'':dbHelper::getOne('project_name', 'project', 'project_id='.$row['task_project_id']);?></td>
                    </tr>
                    <tr>
                        <td>Point</td>
                        <td><?php echo $row['task_point'];?></td>
                    </tr>
                </table>
            </div>
            <div class="image-tool">
                <a href="<?php echo $this->createUrl('/task/update', array('task_id' => $row['task_id']))?>"><i class="icon-pencil"></i></a>
                <a href="<?php echo $this->createUrl('/task/view', array('task_id' => $row['task_id']));?>"><i class="icon-search"></i></a>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>