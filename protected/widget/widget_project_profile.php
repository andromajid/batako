<?php

class widget_project_profile extends CWidget {
    public $project_id;
    public function run() {
        $data = $this->getProject();
        $this->render('widget_project_profile', array('data' => $data));
    }

    /**
     * fungsi buat mendapatkan semua data user
     * @param Mixed $username username atau id dari user
     */
    public function getProject() {
        $result = Yii::app()->db->createCommand()->from('project')->where('project_id=:id', array(':id' => $this->project_id))->queryRow();
        return $result;
    }

}

?>
