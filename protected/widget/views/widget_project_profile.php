<?php
if(is_file(Yii::getPathOfAlias('webroot') . '/files/images/project/' . $data['project_icon'])) {
    $image = CHtml::image(Yii::app()->baseUrl.'/files/images/project/'.$data['project_icon'], $data['project_icon'], array('class' => 'img-polaroid'));
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
        array('label' => 'Nama Project',
            'type' => 'raw',
            'value' => $data['project_name']),
        array('label' => 'URL Project',
            'type' => 'html',
            'value' => (isset($data['project_url']))?CHtml::link($data['project_name'], $data['project_url']):''),
        array('label' => 'Project Description',
            'type' => 'raw',
            'value' => $data['project_description']),
        array('label' => 'Project is Active',
            'type' => 'html',
            'value' => ($data['project_is_active'] == 1 ? CHtml::tag("span", array("class" => "badge badge-success"), "√") :CHtml::tag("span", array("class" => "badge badge-important"), "x"))),
        array('label' => 'Project Budget',
            'type' => 'raw',
            'value' => number_format($data['project_budget']),
            ),
        array('label' => 'Product Owner',
            'type' => 'raw',
            'value' => isset($data['project_user_id'])?dbHelper::getOne('username', 'user', 'user_id = '.$data['project_user_id']):''),
    ),
));
?>
        </div>
</div>

