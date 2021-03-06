<?php

/**
 * This is the model class for table "task".
 *
 * The followings are the available columns in table 'task':
 * @property integer $task_id
 * @property string $task_title
 * @property string $task_description
 * @property integer $task_point
 * @property integer $task_creator_user_id
 * @property integer $task_assign_user_id
 * @property string $task_create_datetime
 * @property string $task_start_datetime
 * @property string $task_end_datetime
 * @property integer $task_estimate_hour
 * @property integer $task_project_id
 * @property integer $task_task_type_id
 * @property string $task_is_end
 * @property integer $task_progress
 *
 * The followings are the available model relations:
 * @property TaskType $taskTaskType
 * @property User $taskCreatorUser
 * @property User $taskAssignUser
 * @property Project $taskProject
 * @property TaskSprint[] $taskSprints
 */
class task extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return task the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'task';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('task_title', 'required'),
            array('task_point, task_creator_user_id, task_assign_user_id, task_estimate_hour, task_project_id, task_task_type_id, task_progress', 'numerical', 'integerOnly' => true),
            array('task_title', 'length', 'max' => 127),
            array('task_is_end', 'length', 'max' => 45),
            array('task_description, task_create_datetime, task_start_datetime, task_end_datetime', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('task_id, task_title, task_description, task_point, task_creator_user_id, task_assign_user_id, task_create_datetime, task_start_datetime, task_end_datetime, task_estimate_hour, task_project_id, task_task_type_id, task_is_end, task_progress', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'taskTaskType' => array(self::BELONGS_TO, 'TaskType', 'task_task_type_id'),
            'taskCreatorUser' => array(self::BELONGS_TO, 'user', 'task_creator_user_id'),
            'taskAssignUser' => array(self::BELONGS_TO, 'user', 'task_assign_user_id'),
            'taskProject' => array(self::BELONGS_TO, 'project', 'task_project_id'),
            'taskSprints' => array(self::HAS_MANY, 'TaskSprint', 'task_task_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'task_id' => 'Task',
            'task_title' => 'Task Title',
            'task_description' => 'Task Description',
            'task_point' => 'Task Point',
            'task_creator_user_id' => 'Task Creator User',
            'task_assign_user_id' => 'Task Assign User',
            'task_create_datetime' => 'Task Create Datetime',
            'task_start_datetime' => 'Task Start Datetime',
            'task_end_datetime' => 'Task End Datetime',
            'task_estimate_hour' => 'Task Estimate Hour',
            'task_project_id' => 'Task Project',
            'task_task_type_id' => 'Task Task Type',
            'task_is_end' => 'Task Is End',
            'task_progress' => 'Task Progress',
        );
    }

    public function search($id = null) {

        $criteria = new CDbCriteria;
        $user_id = $id !== null ? $id : $this->task_assign_user_id;
        $criteria->order = 'task_is_end DESC, task_create_datetime ASC';
        $criteria->compare('task_id', $this->task_id);
        $criteria->compare('task_title', $this->task_title, true);
        $criteria->compare('task_description', $this->task_description, true);
        $criteria->compare('task_point', $this->task_point);
        $criteria->compare('task_creator_user_id', $this->task_creator_user_id);
        $criteria->compare('task_assign_user_id', $user_id);
        $criteria->compare('task_create_datetime', $this->task_create_datetime, true);
        $criteria->compare('task_start_datetime', $this->task_start_datetime, true);
        $criteria->compare('task_end_datetime', $this->task_end_datetime, true);
        $criteria->compare('task_estimate_hour', $this->task_estimate_hour);
        $criteria->compare('task_project_id', $this->task_project_id);
        $criteria->compare('task_task_type_id', $this->task_task_type_id);
        $criteria->compare('task_is_end', $this->task_is_end, true);
        $criteria->compare('task_progress', $this->task_progress);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * fungsi buat ambil semua task dari prject
     * @param Int  $project_id
     */
    public function getAllTaskFromProject($project_id) {
        $data = Yii::app()->db->createCommand()->from('task')->where('task_project_id=:project_id', array(':project_id' => $project_id))->queryAll();
        return $data;
    }

    /**
     * buat semua task
     */
    public function getAllTask() {
        $data = Yii::app()->db->createCommand()->from('task')->where('task_is_end = \'0\'')->queryAll();
        return $data;
    }

    /**
     * fungsi buat ngambil data task berdasar task_id
     * @param Int $task_id
     */
    public function getTaskById($task_id) {
        $feedback = Yii::app()->db->createCommand()->from('task')->where('task_id=:task_id', array(':task_id' => $task_id))->queryRow();
        return $feedback;
    }

    /**
     * Buat ngambil data semua task di sprint
     * @param Int $sprint_id
     */
    public function getAllTaskBySprintId($sprint_id) {
        $feedback = Yii::app()->db->createCommand()->from('task')->leftJoin('task_sprint', 'task_task_id = task_id')->where('sprint_sprint_id=:sprint_id', array(':sprint_id' => $sprint_id))->queryAll();
        return $feedback;
    }

    /**
     * function to get all task by project
     * @param Int $project_id 
     */
    public function getAllTaskByProjectId($project_id) {
        $feedback = Yii::app()->db->createCommand()->from('task')->where('task_project_id = :project_id', array(':project_id' => $project_id))->queryAll();
        return $feedback;
    }

    /**
     * method buat nyari semua task yang tidak terdapat di sprint itu
     * @param Int $sprint_id 
     */
    public function getAllTaskNotInSprint($sprint_id) {
        $feedback = Yii::app()->db->createCommand()->from('task')->leftJoin('task_sprint', 'task_task_id = task_id')->where('sprint_sprint_id!=:sprint_id', array(':sprint_id' => $sprint_id))->queryAll();
        return $feedback;
    }

    /**
     * fungsi buat ngambil data buat calanedar dashboar
     * @param Array $arr_date array('start_date' => date('Y-m', $_GET['start']),
      'end_date' => ate('Y-m', $_GET['end']));
     */
    public function getTaskCalendarDate($arr_date) {
        $sql_select = $sql_between = $sql_or = '';
        $x = 1;
        foreach ($arr_date as $string_val => $date) {
            if (isset($date)) {
                $or = $x == 1 ? '' : 'OR';
                $sql_select .= ",DATE_FORMAT(STR_TO_DATE('" . $date . "', '%Y-%m'), '%Y-%m') AS tanggal_" . $string_val;
                //$sql_between .= $or.' tanggal_'.$string_val.' BETWEEN DATE_FORMAT(task_start_datetime, \'%Y-%m\') AND DATE_FORMAT(task_end_datetime, \'%Y-%m\') ';
                $sql_or .= $or . ' (DATE_FORMAT(task_' . $string_val . 'time, \'%Y-%m\') >= tanggal_start_date' .
                        ' AND DATE_FORMAT(task_' . $string_val . 'time, \'%Y-%m\') <= tanggal_end_date)';
                $x++;
            }
        }

        $sql = "SELECT *" . $sql_select . " FROM task";
        $sql .= " HAVING " . $sql_between . $sql_or;
        $data = Yii::app()->db->createCommand($sql)->queryAll();
        $data_json = array();
        if ($data) {
            foreach ($data as $row) {
                $project_name = dbHelper::getOne('project_name', 'project', 'project_id = ' . $row['task_project_id']);
                $data_json[] = array('title' => 'Task : ' . $row['task_title'] . ' (Project : ' . $project_name . ')',
                    'start' => $row['task_start_datetime'],
                    'end' => $row['task_end_datetime'],
                    'url' => Yii::app()->getController()->createUrl('/task/view/', array('task_id' => $row['task_id'])),
                    'color' => 'blue');
            }
        }
        return $data_json;
    }

}
