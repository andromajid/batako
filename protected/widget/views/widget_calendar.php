<?php

$this->widget('ext.efullcalendar.EFullCalendar', array(
    'themeCssFile' => 'cupertino/theme.css',
    'options' => array(
        'header' => array(
            'left' => 'prev,next',
            'center' => 'title',
            'right' => 'today'
        ),
        'events' => Yii::app()->getController()->createUrl('/dashboard/calendar')
    ),
    'htmlOptions' => array('style' => 'width:60%'),
));
?>
<div class="calendar-legend">
    <div></div>
</div>