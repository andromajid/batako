<?php
$image = CHtml::image(Yii::app()->getBaseUrl() . '/files/images/user/_default.jpg', 'ngga ada gambar');
if (is_readable(Yii::getPathOfAlias('webroot') . '/files/images/user/' . $this->admin_auth->user_avatar)) {
    $image = CHtml::image(Yii::app()->getBaseUrl() . '/files/images/user/' . $this->admin_auth->user_avatar, $this->admin_auth->user_avatar);
}
?>
<ul class="nav pull-right">
    <li class="dropdown">
        <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <span class="user-image"><?php echo $image; ?></span><?php echo $this->admin_auth->username; ?> <i class="caret"></i>

        </a>
        <ul class="dropdown-menu">
            <li>
                <a tabindex="-1" href="<?php echo $this->createUrl('/user/view', array('id' => $this->admin_auth->user_id)); ?>">Profile</a>
            </li>
            <li class="dropdown-submenu">
                <a tabindex="-1" href="#">Config</a>
                <ul class="dropdown-menu">
                    <li>
                         <a tabindex="-1" href="<?php echo $this->createUrl('/user/admin'); ?>">User</a>
                    </li>
                     <li>
                         <a tabindex="-1" href="<?php echo $this->createUrl('/project/admin'); ?>">Project</a>
                    </li>
                     <li>
                         <a tabindex="-1" href="<?php echo $this->createUrl('/task/admin'); ?>">Task</a>
                    </li>
                </ul>
            </li>
            <li>
                <a tabindex="-1" href="<?php echo $this->createUrl('/site/logout'); ?>">Logout</a>
            </li>
        </ul>
    </li>
</ul>