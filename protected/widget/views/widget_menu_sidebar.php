<div class="span3" id="sidebar">
    <ul class="nav-list bs-docs-sidenav nav-collapse collapse">
        <?php foreach ($this->menu as $row): ?>
            <li>
                <a class="btn btn-inverse" href="<?php echo Yii::app()->getController()->createUrl($row['url'][0]);?>"><?php echo $row['label'];?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>   