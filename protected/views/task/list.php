<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'user-grid',
    'dataProvider' => $task->search(),
    'filter' => $task,
    'columns' => array(
        array(
            'header' => 'No.',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)."."',
            'htmlOptions' => array('style' => 'text-align:center;'),
        ),
        'task_title',
        array('name' => 'task_project_id',
              'type' => 'html',
              'value' => '$data->task_project_id != null?$data->taskProject->project_name:""',
              'filter' => CHtml::activeDropDownList($task, 'task_project_id', CHtml::listData(project::model()->findAll(), 'project_id', 'project_name'), array('empty' => '')),
            ),
        array('name' => 'task_assign_user_id',
              'type' => 'html',
              'value' => '$data->task_assign_user_id != null?$data->taskAssignUser->username:""',
              'filter' => CHtml::activeDropDownList($task, 'task_assign_user_id', CHtml::listData(user::model()->findAll(), 'user_id', 'username'), array('empty' => ''))),
         array('name' => 'task_creator_user_id',
              'type' => 'html',
              'value' => '$data->task_creator_user_id != null?$data->taskCreatorUser->username:""',
              'filter' => CHtml::activeDropDownList($task, 'task_creator_user_id', CHtml::listData(user::model()->findAll(), 'user_id', 'username'), array('empty' => ''))
             ),
        array(
            'name' => 'task_is_end',
            'type' => 'raw',
            'value' => '($data->task_is_end == "1" ? CHtml::tag("span", array("class" => "badge badge-success"), "√") :CHtml::tag("span", array("class" => "badge badge-important"), "x"))',
            'filter' => CHtml::activeDropDownList($task, 'task_is_end', array('' => '', '1' => 'Done', '0' => 'In Progress')),
            'htmlOptions' => array('style' => 'text-align:center;'),
        ),
        'task_end_datetime',
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