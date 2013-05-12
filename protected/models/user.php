<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $user_id
 * @property string $username
 * @property string $user_realname
 * @property string $user_email
 * @property string $user_password
 * @property string $user_is_active
 * @property string $user_is_administrator
 * @property string $user_avatar
 * @property integer $user_role_user_role_id
 *
 * The followings are the available model relations:
 * @property Project[] $projects
 * @property Task[] $tasks
 * @property Task[] $tasks1
 * @property UserRole $userRoleUserRole
 */
class user extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return user the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username, user_email,user_role_user_role_id', 'required'),
            array('user_email', 'email'),
            array('username', 'checkUsernameAvail'),
            array('user_role_user_role_id', 'numerical', 'integerOnly' => true),
            array('username', 'length', 'max' => 127),
            array('user_realname', 'length', 'max' => 45),
            array('user_email, user_password', 'length', 'max' => 255),
            array('user_is_active, user_is_administrator', 'length', 'max' => 1),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('user_id, username, user_realname, user_email, user_password, user_is_active, user_is_administrator, user_avatar, user_role_user_role_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'projects' => array(self::HAS_MANY, 'Project', 'project_user_id'),
            'tasks' => array(self::HAS_MANY, 'Task', 'task_creator_user_id'),
            'tasks1' => array(self::HAS_MANY, 'Task', 'task_assign_user_id'),
            'userRoleUserRole' => array(self::BELONGS_TO, 'user_role', 'user_role_user_role_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'user_id' => 'User',
            'username' => 'Username',
            'user_realname' => 'User Realname',
            'user_email' => 'User Email',
            'user_password' => 'Password',
            'user_is_active' => 'User Is Active',
            'user_is_administrator' => 'User Is Administrator',
            'user_avatar' => 'User Avatar',
            'user_role_user_role_id' => 'User Role',
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

        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('user_realname', $this->user_realname, true);
        $criteria->compare('user_email', $this->user_email, true);
        $criteria->compare('user_password', $this->user_password, true);
        $criteria->compare('user_is_active', $this->user_is_active, true);
        $criteria->compare('user_is_administrator', $this->user_is_administrator, true);
        $criteria->compare('user_avatar', $this->user_avatar, true);
        $criteria->compare('user_role_user_role_id', $this->user_role_user_role_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function checkUsernameAvail($attribute, $params) {
        $member_nickname = strtolower($this->username);
        $cek = dbHelper::getOne('username', 'user', 'username = \'' . $member_nickname . '\'');
        preg_match('/^[a-zA-Z0-9_-]*$/', $member_nickname, $match);
        if (empty($match)) {
            $message = Yii::t('yii', 'Member Mengandung Kata Ilegal');
            $this->addError($attribute, $message);
        }
        if ($cek != "") {
            $message = Yii::t('yii', 'Member ' . $member_nickname . " sudah digunakan");
            $this->addError($attribute, $message);
        }
    }

}