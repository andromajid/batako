<div class="span3" id="sidebar">
    <?php
//    $this->widget('zii.widgets.CMenu', array(
//            'items' => $this->menu,
//            'htmlOptions' => array('class' => 'nav-list bs-docs-sidenav nav-collapse collapse'),
//            'itemCssClass' => 'btn btn-inverse'
//        ));
    ?>
<!--    <ul class="nav-list bs-docs-sidenav nav-collapse collapse">
        <?php foreach ($this->menu as $row): ?>
            <li>
                <a class="btn btn-inverse" href="<?php //echo Yii::app()->getController()->createUrl($row['url']);?>"><?php echo $row['label'];?></a>
            </li>
        <?php endforeach; ?>
    </ul>-->
   <ul class="nav-list bs-docs-sidenav nav-collapse collapse">
        <?php foreach ($this->menu as $row): ?>
       <?php
       if(isset($row['url'][1])) {
           $url = Yii::app()->getController()->createUrl($row['url'][0], $row['url'][1]);
       } else {
           $url = Yii::app()->getController()->createUrl($row['url'][0]);
       }
       ?>
            <li>
                <a class="btn btn-inverse" href="<?php echo $url;?>"><?php echo $row['label'];?></a>
            </li>
        <?php endforeach; ?>
    </ul>

</div>   