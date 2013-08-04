<?php

/**
 * This is the model class for table "user_notification".
 *
 * The followings are the available columns in table 'user_notification':
 * @property integer $user_notification_id
 * @property integer $user_notification_user_id
 * @property string $user_notification_description
 * @property integer $user_notification_project_id
 * @property string $user_notification_datetitme
 *
 * The followings are the available model relations:
 * @property Project $userNotificationProject
 * @property User $userNotificationUser
 */
class user_notification extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return user_notification the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'user_notification';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_notification_user_id, user_notification_project_id', 'required'),
            array('user_notification_user_id, user_notification_project_id', 'numerical', 'integerOnly' => true),
            array('user_notification_description', 'length', 'max' => 255),
            array('user_notification_datetitme', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('user_notification_id, user_notification_user_id, user_notification_description, user_notification_project_id, user_notification_datetitme', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'userNotificationProject' => array(self::BELONGS_TO, 'Project', 'user_notification_project_id'),
            'userNotificationUser' => array(self::BELONGS_TO, 'User', 'user_notification_user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'user_notification_id' => 'User Notification',
            'user_notification_user_id' => 'User Notification User',
            'user_notification_description' => 'User Notification Description',
            'user_notification_project_id' => 'User Notification Project',
            'user_notification_datetitme' => 'User Notification Datetitme',
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

        $criteria->compare('user_notification_id', $this->user_notification_id);
        $criteria->compare('user_notification_user_id', $this->user_notification_user_id);
        $criteria->compare('user_notification_description', $this->user_notification_description, true);
        $criteria->compare('user_notification_project_id', $this->user_notification_project_id);
        $criteria->compare('user_notification_datetitme', $this->user_notification_datetitme, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    /**
     * funcrion to get all usernotification from project_id
     * @param Array $project_id colection array of user_id
     */
    public function getAllUserNotificationFromProjectId($project_id) {
        $data = Yii::app()->db->createCommand()->from('user_notification')->rightJoin('user', 'user_notification_user_id = user_id')
                ->where('user_notification_project_id=:project_id', array(':project_id' => $project_id))->queryAll();
        return $data;
    }
}