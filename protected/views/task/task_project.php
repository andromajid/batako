<?php if (is_array($task_project)): ?>
    <?php foreach ($task_project as $row): ?>
        <?php
            $task_color = dbHelper::getOne('task_type_color', 'task_type', 'task_type_id = '.$row['task_task_type_id']);
            $task_color_style = '';
            if(isset($task_color)) {
                $task_color_style = html::generateGradien($task_color);
            } 
        ?>
        <div class="block span3 draggable">
            <div class="navbar navbar-inner block-header"<?php echo ' '.$task_color_style;?>>
                <div class="muted pull-left"><?php echo $row['task_title']; ?></div>
            </div>
            <div class="block-content collapse in">
                <?php echo strip_tags($row['task_description']); ?>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>