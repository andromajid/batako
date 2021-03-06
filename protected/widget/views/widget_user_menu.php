<?php if (isset($data['project'])): ?>
    <li class="dropdown">
        <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Project <i class="caret"></i>

        </a>
        <ul class="dropdown-menu">
            <?php foreach ($data['project'] as $row_project): ?>
                <li>
                    <a tabindex="-1" href="<?php echo Yii::app()->getController()->createUrl('/project/view', array('id' => $row_project['project_id'])); ?>">
                        <?php echo $row_project['project_name']; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </li>
    <?php
endif;
if (isset($data['sprint'])):
    ?>
    <li class="dropdown">
        <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Sprint <i class="caret"></i>

        </a>
        <ul class="dropdown-menu">
            <li>
                <a tabindex="-1" href="<?php echo Yii::app()->createUrl('/sprint/create'); ?>">create sprint</a>
            </li>
            <li class="dropdown-submenu">
                <a tabindex="-1" href="#">Daftar sprint</a>
                <ul class="dropdown-menu">
                    <?php foreach ($data['sprint'] as $row_project): ?>
                        <li>
                            <a tabindex="-1" href="<?php echo Yii::app()->getController()->createUrl('/sprint/kanban', array('id' => $row_project['sprint_id'])); ?>">
                                <?php echo $row_project['sprint_name']; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </li>
        </ul>
    </li>
<?php endif; ?>
<li>
    <a href="<?php echo Yii::app()->getController()->createUrl('/task/user', array('id' => $this->admin_auth->user_id)); ?>">Task List</a>
</li>