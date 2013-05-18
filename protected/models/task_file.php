<?php

/**
 * This is the model class for table "task_file".
 *
 * The followings are the available columns in table 'task_file':
 * @property integer $task_file_task_id
 * @property integer $task_file_file_id
 *
 * The followings are the available model relations:
 * @property File $taskFileFile
 * @property Task $taskFileTask
 */
class task_file extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return task_file the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'task_file';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('task_file_task_id, task_file_file_id', 'required'),
            array('task_file_task_id, task_file_file_id', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('task_file_task_id, task_file_file_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'taskFileFile' => array(self::BELONGS_TO, 'File', 'task_file_file_id'),
            'taskFileTask' => array(self::BELONGS_TO, 'Task', 'task_file_task_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'task_file_task_id' => 'Task File Task',
            'task_file_file_id' => 'Task File File',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('task_file_task_id', $this->task_file_task_id);
        $criteria->compare('task_file_file_id', $this->task_file_file_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    /**
     * fungsi buat ambil semua file yang berhubungan dengan task
     * @param Int $task_id
     */
    public function getFileByTaskId($task_id) {
        $data_file = Yii::app()->db->createCommand()->from('task_file')->rightJoin('file', 'task_file_file_id = file_id')->
                                where('task_file_task_id=:task_id', array(':task_id' => $task_id))->queryAll();
        return $data_file;
    }
}