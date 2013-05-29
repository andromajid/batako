<?php echo CHtml::form('', 'post', array('id' => 'form')); ?>
<?php
$this->widget('zii.widgets.jui.CJuiButton', array(
    'name' => 'update',
    'caption' => 'update',
    'htmlOptions' => array('class' => 'btn btn-primary', 'style' => 'margin:5px 0px 10px 10px')));
$this->widget('ext.dynatree.DynaTree', array(
    'data' => $model,
    'form' => '#form',
    'attribute' => 'user_right',
));
echo CHtml::endForm();