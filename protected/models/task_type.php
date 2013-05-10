<?php

/**
 * This is the model class for table "task_type".
 *
 * The followings are the available columns in table 'task_type':
 * @property integer $task_type_id
 * @property string $task_type_name
 * @property string $task_type_color
 * @property string $task_type_icon
 *
 * The followings are the available model relations:
 * @property Task[] $tasks
 */
class task_type extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return task_type the static model class
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
		return 'task_type';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('task_type_name, task_type_color', 'required'),
			array('task_type_name, task_type_icon', 'length', 'max'=>45),
			array('task_type_color', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('task_type_id, task_type_name, task_type_color, task_type_icon', 'safe', 'on'=>'search'),
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
			'tasks' => array(self::HAS_MANY, 'Task', 'task_task_type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'task_type_id' => 'Task Type',
			'task_type_name' => 'Task Type Name',
			'task_type_color' => 'Task Type Color',
			'task_type_icon' => 'Task Type Icon',
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

		$criteria->compare('task_type_id',$this->task_type_id);
		$criteria->compare('task_type_name',$this->task_type_name,true);
		$criteria->compare('task_type_color',$this->task_type_color,true);
		$criteria->compare('task_type_icon',$this->task_type_icon,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}