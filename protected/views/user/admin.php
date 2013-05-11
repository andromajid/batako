<?php
/* @var $this UserController */
/* @var $model user */

$this->breadcrumbs = array(
    'Users' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'Create user', 'url' => array('create')),
);
?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'user-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array(
            'header' => 'No.',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)."."',
            'htmlOptions' => array('style' => 'text-align:center;'),
        ),
        'username',
        'user_realname',
        'user_email',
        array(
            'name' => 'user_is_active',
            'type' => 'raw',
            'value' => '($data->user_is_active == 1 ? CHtml::tag("span", array("class" => "badge badge-success"), "√") :CHtml::tag("span", array("class" => "badge badge-important"), "x"))',
            'filter' => CHtml::activeDropDownList($model, 'user_is_active', array('' => '', '1' => 'Active', '0' => 'InActive')),
            'htmlOptions' => array('style' => 'text-align:center;'),
        ),
        array(
            'name' => 'user_role_user_role_id',
            'value' => 'dbHelper::getOne("user_role_name", "user_role", "user_role_id=".$data->user_role_user_role_id)',
            'filter' => CHtml::activeDropDownList($model, 'user_role_user_role_id', CHtml::listData(user_role::model()->findAll('user_role_is_active=\'1\''), 'user_role_id', 'user_role_name'), array('empty'=>'')),
            ),
        /*
          'user_is_administrator',
          'user_avatar',
          'user_role_user_role_id',
         */
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
