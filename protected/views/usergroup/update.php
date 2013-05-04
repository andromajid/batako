<?php

$this->breadcrumbs = array(
    'User Group' => array('usergroup/index'),
    'update group ' . $model['admin_group_title']
);
?>
<?php echo CHtml::form('', 'post', array('id' => 'form')); ?>
<?php $this->beginWidget('zii.widgets.CPortlet', array('title' => 'Update Menu ' . $model['admin_group_title'], 'hideOnEmpty' => TRUE)); ?> 

<?php

echo CHtml::textField('admin_group_title', $model['admin_group_title']);
$this->widget('zii.widgets.jui.CJuiButton', array(
    'name' => 'update',
    'caption' => 'update',
    'htmlOptions' => array('class' => 'btn-primary', 'style' => 'margin:5px 0px 10px 10px')));
$this->widget('ext.dynatree.DynaTree', array(
    'data' => $data,
    'form' => '#form',
    'attribute' => 'usergroup',
));
?>

<?php $this->endWidget(); ?>
<?php echo CHtml::endForm(); ?>