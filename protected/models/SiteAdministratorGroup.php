<?php

/**
 * This is the model class for table "site_administrator_group".
 *
 * The followings are the available columns in table 'site_administrator_group':
 * @property integer $admin_group_id
 * @property string $admin_group_title
 * @property string $admin_group_is_active
 */
class SiteAdministratorGroup extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return SiteAdministratorGroup the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'site_administrator_group';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('admin_group_title', 'required'),
            array('admin_group_title', 'length', 'max' => 255),
            array('admin_group_is_active', 'length', 'max' => 1),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('admin_group_id, admin_group_title, admin_group_is_active', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'admin_group_id' => 'Admin Group',
            'admin_group_title' => 'Admin Group Title',
            'admin_group_is_active' => 'Admin Group Is Active',
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

        $criteria->compare('admin_group_id', $this->admin_group_id);
        $criteria->compare('admin_group_title', $this->admin_group_title, true);
        $criteria->compare('admin_group_is_active', $this->admin_group_is_active, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    /**
     * fungsi buat ambil data smua group admin
     */
    public function getAllGroupAdmin($group_is_active = '0') {
        $result = Yii::app()->db->createCommand()->select()->from('site_administrator_group');
        if ($group_is_active == '0') {
            $result = $result->where('admin_group_is_active = :group_is_active', array(':group_is_active' => '1'));
        }
        return $result->queryAll();
    }

    public function getUserGroupById($admin_group_id) {
        return Yii::app()->db->createCommand()->from('site_administrator_group')->where('admin_group_id=:admin_id', array(':admin_id' => $admin_group_id))
                        ->queryRow();
    }
    /**
     * update group_user
     */
    public function updateGroupUser($group_id, $data) {
        return Yii::app()->db->createCommand()->update('site_administrator_group', $data, 'admin_group_id=:admin_group_id', array(':admin_group_id' => $group_id));
    }
}