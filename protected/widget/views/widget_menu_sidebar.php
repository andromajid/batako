<div class="span3" id="sidebar">
    <?php
    $this->widget('zii.widgets.CMenu', array(
            'items' => $this->menu,
            'htmlOptions' => array('class' => 'nav-list bs-docs-sidenav nav-collapse collapse'),
            'itemCssClass' => 'btn btn-inverse'
        ));
    ?>
<!--    <ul class="nav-list bs-docs-sidenav nav-collapse collapse">
        <?php foreach ($this->menu as $row): ?>
            <li>
                <a class="btn btn-inverse" href="<?php //echo Yii::app()->getController()->createUrl($row['url']);?>"><?php echo $row['label'];?></a>
            </li>
        <?php endforeach; ?>
    </ul>-->
</div>   