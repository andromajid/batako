<?php

/**
 * This is the model class for table "task_comment".
 *
 * The followings are the available columns in table 'task_comment':
 * @property integer $task_comment_id
 * @property integer $task_comment_user_id
 * @property integer $task_comment_task_id
 * @property string $task_comment_text
 * @property string $task_comment_datetime
 *
 * The followings are the available model relations:
 * @property Task $taskCommentTask
 * @property User $taskCommentUser
 * @property TaskCommentFile[] $taskCommentFiles
 */
class task_comment extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return task_comment the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'task_comment';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('task_comment_user_id, task_comment_task_id', 'numerical', 'integerOnly' => true),
            array('task_comment_text, task_comment_datetime', 'safe'),
            array('task_comment_text', 'required'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('task_comment_id, task_comment_user_id, task_comment_task_id, task_comment_text, task_comment_datetime', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'taskCommentTask' => array(self::BELONGS_TO, 'Task', 'task_comment_task_id'),
            'taskCommentUser' => array(self::BELONGS_TO, 'User', 'task_comment_user_id'),
            'taskCommentFiles' => array(self::HAS_MANY, 'TaskCommentFile', 'task_comment_file_task_comment_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'task_comment_id' => 'Task Comment',
            'task_comment_user_id' => 'Task Comment User',
            'task_comment_task_id' => 'Task Comment Task',
            'task_comment_text' => 'Task Comment Text',
            'task_comment_datetime' => 'Task Comment Datetime',
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

        $criteria->compare('task_comment_id', $this->task_comment_id);
        $criteria->compare('task_comment_user_id', $this->task_comment_user_id);
        $criteria->compare('task_comment_task_id', $this->task_comment_task_id);
        $criteria->compare('task_comment_text', $this->task_comment_text, true);
        $criteria->compare('task_comment_datetime', $this->task_comment_datetime, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    /**
     * fungsi buat ngambbil semua comment
     * @param Int $task_id nama task
     */
    public function getCommentByTaskId($task_id) {
        $data = Yii::app()->db->createCommand()->from('task_comment')->rightJoin('user', 'user_id=task_comment_user_id')->where('task_comment_task_id=:task_id', array(':task_id' => $task_id))
                          ->order('task_comment_datetime DESC')->queryAll();
        return $data;
    }
}