<?php

/**
 * This is the model class for table "task_comment_file".
 *
 * The followings are the available columns in table 'task_comment_file':
 * @property integer $task_comment_file_task_comment_id
 * @property integer $task_comment_file_file_id
 *
 * The followings are the available model relations:
 * @property File $taskCommentFileFile
 * @property TaskComment $taskCommentFileTaskComment
 */
class task_comment_file extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return task_comment_file the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'task_comment_file';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('task_comment_file_task_comment_id, task_comment_file_file_id', 'required'),
            array('task_comment_file_task_comment_id, task_comment_file_file_id', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('task_comment_file_task_comment_id, task_comment_file_file_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'taskCommentFileFile' => array(self::BELONGS_TO, 'File', 'task_comment_file_file_id'),
            'taskCommentFiles' => array(self::BELONGS_TO, 'task_comment', 'task_comment_file_task_comment_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'task_comment_file_task_comment_id' => 'Task Comment File Task Comment',
            'task_comment_file_file_id' => 'Task Comment File File',
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

        $criteria->compare('task_comment_file_task_comment_id', $this->task_comment_file_task_comment_id);
        $criteria->compare('task_comment_file_file_id', $this->task_comment_file_file_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Fungsi buat ngambil data file berdasar comment_id
     * @param Int $comment_id 
     */
    public function getTaskFileByCommentId($comment_id) {
        $data = Yii::app()->db->createCommand()->from('task_comment_file')->rightJoin('file', 'file_id=task_comment_file_file_id')
                          ->where('task_comment_file_task_comment_id=:comment_id', array(':comment_id' => $comment_id))->queryAll();
        return $data;
    }
}