<?php
if(is_file(Yii::getPathOfAlias('webroot') . '/files/images/user/' . $data['user_avatar'])) {
    $image = CHtml::image(Yii::app()->baseUrl.'/files/images/user/'.$data['user_avatar'], $data['user_avatar'], array('class' => 'img-polaroid'));
} else 
    $image = '';
?>
<div class="user_profile">
    <div class="avatar">
        <?php echo $image;?>
    </div>
    <div class="table">
<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $data,
    'attributes' => array(
        array('label' => 'username',
            'type' => 'raw',
            'value' => $data['username']),
        array('label' => 'Name',
            'type' => 'raw',
            'value' => $data['user_realname']),
        array('label' => 'Email',
            'type' => 'raw',
            'value' => $data['user_email']),
        array('label' => 'User is Active',
            'type' => 'html',
            'value' => ($data['user_is_active'] == 1 ? CHtml::tag("span", array("class" => "badge badge-success"), "√") :CHtml::tag("span", array("class" => "badge badge-important"), "x"))),
        array('label' => 'user is administrator?',
            'type' => 'raw',
            'value' => ($data['user_is_administrator'] == 1 ? CHtml::tag("span", array("class" => "badge badge-success"), "√") :CHtml::tag("span", array("class" => "badge badge-important"), "x"))
            ),
        array('label' => 'user Role',
            'type' => 'raw',
            'value' => dbHelper::getOne('user_role_name', 'user_role', 'user_role_id = '.$data['user_role_user_role_id'])),
    ),
));
?>
        </div>
</div>

