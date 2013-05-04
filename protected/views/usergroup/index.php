<?php

/* @var $this UserGroupController */

$this->breadcrumbs = array(
    'User Group'
);
//$this->menu=array(
//	array('label'=>'create group admin', 'url'=>array('usergroup/create')),
//);
?>
<?php echo CHtml::form('', 'post', array('id' => 'form')); ?>
<?php $this->beginWidget('zii.widgets.CPortlet', array('title' => 'create group admin ', 'hideOnEmpty' => TRUE)); ?> 
<?php echo CHtml::activeLabel($model2, 'admin_group_title'); ?>
<?php echo CHtml::textField('admin_group_title', $model2->admin_group_title, array('size' => 60, 'maxlength' => 255, 'class' => 'span5')); ?>
<?php echo CHtml::error($model2, 'admin_group_title'); 
$this->widget('zii.widgets.jui.CJuiButton', array(
    'name' => 'insert',
    'caption' => 'insert',
    'htmlOptions' => array('class' => 'btn-primary', 'style' => 'margin-left:10px;margin-bottom:3px;')));?>

<?php $this->endWidget(); ?>
<?php $this->beginWidget('zii.widgets.CPortlet', array('title' => 'Update Menu ' . $model['admin_group_title'], 'hideOnEmpty' => TRUE)); ?> 


<?php

$this->widget('zii.widgets.jui.CJuiButton', array(
    'name' => 'disable',
    'caption' => 'disable',
    'htmlOptions' => array('class' => 'btn-primary', 'style' => 'margin:5px 0px 5px 50px')));
$this->widget('zii.widgets.jui.CJuiButton', array(
    'name' => 'enable',
    'caption' => 'enable',
    'htmlOptions' => array('class' => 'btn-success', 'style' => 'margin:5px 0px 5x 5px')));
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'site-administrator-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array('header' => CHtml::checkBox('check_all', false, array('onclick' => '')), 'type' => 'raw', 'sortable' => false,
            'value' => 'CHtml::checkBox(\'aktiv[]\', false, array(\'value\' => $data->admin_group_id))'),
        'admin_group_title',
//        array('name' => 'admin_group_is_active','header' => 'Status','type' => 'raw', 'value' => '$data->admin_group_is_active == \'1\'?<span class=\'badge badge-success\'>√</span>:<span class=\'badge badge-important\'>x</span>',
//              ),
        array('name' => 'admin_group_is_active', 'header' => 'Status', 'type' => 'raw', 'value' => '$data->admin_group_is_active == \'1\'?Chtml::tag(\'span\', array(\'class\' => \'badge badge-success\'), \'√\'):Chtml::tag(\'span\', array(\'class\' => \'badge badge-important\'), \'x\')',
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{delete}{update}{user_right}',
            'buttons' => array('user_right' => array('label' => 'update user right',
                                                     'url' => "Yii::app()->getController()->createUrl('/admin/user/right', array('id' => \$data->admin_group_id))",
                                                     'imageUrl' => Yii::app()->theme->baseUrl.'/img/admin_user.png'),),
        ),
    ),
));
?>

<?php $this->endWidget(); ?>
<?php echo CHtml::endForm(); ?>

