<?php

/**
 * This is the model class for table "project".
 *
 * The followings are the available columns in table 'project':
 * @property integer $project_id
 * @property string $project_name
 * @property string $project_url
 * @property string $project_description
 * @property string $project_budget
 * @property string $project_icon
 * @property string $project_is_active
 * @property integer $project_user_id
 *
 * The followings are the available model relations:
 * @property User $projectUser
 * @property Task[] $tasks
 */
class project extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return project the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'project';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('project_name', 'required'),
            array('project_icon', 'file', 'allowEmpty' => true, 'types' => 'jpg,jpeg,gif,png'),
            array('project_user_id', 'numerical', 'integerOnly' => true),
            array('project_name, project_url', 'length', 'max' => 255),
            array('project_budget', 'length', 'max' => 20),
            array('project_is_active', 'length', 'max' => 1),
            array('project_description', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('project_id, project_name, project_url, project_description, project_budget, project_icon, project_is_active, project_user_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'projectUser' => array(self::BELONGS_TO, 'user', 'project_user_id'),
            'tasks' => array(self::HAS_MANY, 'Task', 'task_project_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'project_id' => 'Project',
            'project_name' => 'Project Name',
            'project_url' => 'Project Url',
            'project_description' => 'Project Description',
            'project_budget' => 'Project Budget',
            'project_icon' => 'Project Icon',
            'project_is_active' => 'Project Is Active',
            'project_user_id' => 'Project User',
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

        $criteria->compare('project_id', $this->project_id);
        $criteria->compare('project_name', $this->project_name, true);
        $criteria->compare('project_url', $this->project_url, true);
        $criteria->compare('project_description', $this->project_description, true);
        $criteria->compare('project_budget', $this->project_budget, true);
        $criteria->compare('project_icon', $this->project_icon, true);
        $criteria->compare('project_is_active', $this->project_is_active, true);
        $criteria->compare('project_user_id', $this->project_user_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    public function getProjectById($project_id) {
        $data = Yii::app()->db->createCommand()->from('project')->where('project_id=:project_id', array(':project_id' => $project_id))->queryRow();
        return $data;
    }
    /**
     * function to get all project from userid
     * @param Int $user_id
     */
    public function getProjectByUserId($user_id) {
        $data = Yii::app()->db->createCommand()->from('project')->where('project_user_id=:user_id', array(':user_id' => $user_id))
                ->order('project_id ASC')->queryAll();
        return $data;
    }
}