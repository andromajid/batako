<?php

/**
 * This is the model class for table "site_administrator".
 *
 * The followings are the available columns in table 'site_administrator':
 * @property integer $admin_id
 * @property integer $admin_group_id
 * @property string $admin_username
 * @property string $admin_password
 * @property string $admin_last_login
 * @property string $admin_is_active
 */
class SiteAdministrator extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SiteAdministrator the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'site_administrator';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('admin_group_id', 'numerical', 'integerOnly'=>true),
			array('admin_username, admin_password', 'length', 'max'=>255),
			array('admin_is_active', 'length', 'max'=>1),
			array('admin_last_login', 'safe'),
                        array('admin_username,admin_password', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('admin_id, admin_group_id, admin_username, admin_password, admin_last_login, admin_is_active', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'admin_id' => 'Admin',
			'admin_group_id' => 'Admin Group',
			'admin_username' => 'Admin Username',
			'admin_password' => 'Admin Password',
			'admin_last_login' => 'Admin Last Login',
			'admin_is_active' => 'Admin Is Active',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('admin_id',$this->admin_id);
		$criteria->compare('admin_group_id',$this->admin_group_id);
		$criteria->compare('admin_username',$this->admin_username,true);
		$criteria->compare('admin_password',$this->admin_password,true);
		$criteria->compare('admin_last_login',$this->admin_last_login,true);
		$criteria->compare('admin_is_active',$this->admin_is_active,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        public function getUserById($admin_id) {
            return Yii::app()->db->createCommand()->from('site_administrator')->where('admin_id=:admin_id', array(':admin_id' => $admin_id))
                   ->queryRow();
        }
}