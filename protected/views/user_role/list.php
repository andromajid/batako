<?php
/* @var $this User_roleController */
/* @var $model user_role */

$this->breadcrumbs = array(
    'User Roles' => array('list'),
);

$this->menu = array(
    array('label' => 'List user_role', 'url' => array('list')),
    array('label' => 'Create user_role', 'url' => array('create')),
);
?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'user-role-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array(
            'header' => 'No.',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)."."',
            'htmlOptions' => array('style' => 'text-align:center;'),
        ),
        'user_role_name',
        array(
            'name' => 'user_role_is_active',
            'type' => 'raw',
            'value' => '($data->user_role_is_active == 1 ? CHtml::tag("span", array("class" => "badge badge-success"), "√") :CHtml::tag("span", array("class" => "badge badge-important"), "x"))',
            'filter' => CHtml::activeDropDownList($model, 'user_role_is_active', array('' => '', '1' => 'Active', '0' => 'InActive')),
            'htmlOptions' => array('style' => 'text-align:center;'),
        ),
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
