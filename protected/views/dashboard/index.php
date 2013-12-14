<?php
echo '<h4>Daftar Task</h4>';
$this->widget('application.widget.task_user.widgetTaskUser', array('id' => $this->admin_auth->user_id));
echo '<h4>Jadwal Kerjaan</h4>';
$this->widget('application.widget.widget_calendar');

?>
