<?php

/**
 * This is the model class for table "sprint".
 *
 * The followings are the available columns in table 'sprint':
 * @property integer $sprint_id
 * @property string $sprint_name
 * @property string $sprint_start_date
 * @property string $sprint_end_date
 *
 * The followings are the available model relations:
 * @property TaskSprint[] $taskSprints
 */
class sprint extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return sprint the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'sprint';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('sprint_name,sprint_start_date,sprint_end_date', 'required'),
            array('sprint_name', 'length', 'max' => 127),
            array('sprint_start_date, sprint_end_date', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('sprint_id, sprint_name, sprint_start_date, sprint_end_date', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'taskSprints' => array(self::HAS_MANY, 'task_sprint', 'sprint_sprint_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'sprint_id' => 'Sprint',
            'sprint_name' => 'Sprint Name',
            'sprint_start_date' => 'Sprint Start Date',
            'sprint_end_date' => 'Sprint End Date',
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

        $criteria->compare('sprint_id', $this->sprint_id);
        $criteria->compare('sprint_name', $this->sprint_name, true);
        $criteria->compare('sprint_start_date', $this->sprint_start_date, true);
        $criteria->compare('sprint_end_date', $this->sprint_end_date, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * method buat nyari data sprint berdasar sprint_id
     * @param Int $sprint_id
     */
    public function getSprintBySprintId($sprint_id) {
        $data = Yii::app()->db->createCommand()->from('sprint')->where('sprint_id = :sprint_id', array(':sprint_id' => $sprint_id))->queryRow();
        return $data;
    }

    /**
     * function buat mendapatkan data calendar 
     * @param Array $arr_date array('start_date' => date('Y-m', $_GET['start']),
      'end_date' => ate('Y-m', $_GET['end']));
     */
    public function getSprintCalendarDate($arr_date) {
        $sql_select = $sql_between = $sql_or = '';
        $x = 1;
        foreach ($arr_date as $string_val => $date) {
            if (isset($date)) {
                $or = $x == 1 ? '' : 'OR';
                $sql_select .= ",DATE_FORMAT(STR_TO_DATE('" . $date . "', '%Y-%m'), '%Y-%m') AS tanggal_" . $string_val;
                //$sql_between .= $or.' tanggal_'.$string_val.' BETWEEN DATE_FORMAT(task_start_datetime, \'%Y-%m\') AND DATE_FORMAT(task_end_datetime, \'%Y-%m\') ';
                $sql_or .= $or . ' (DATE_FORMAT(sprint_' . $string_val . ', \'%Y-%m\') >= tanggal_start_date' .
                        ' AND DATE_FORMAT(sprint_' . $string_val . ', \'%Y-%m\') <= tanggal_end_date)';
                $x++;
            }
        }
        $sql = "SELECT *" . $sql_select . " FROM sprint";
        $sql .= " HAVING " . $sql_between . $sql_or;
        $data = Yii::app()->db->createCommand($sql)->queryAll();
        $data_json = array();
        if ($data) {
            foreach ($data as $row) {
                $data_json[] = array('title' => 'Sprint : ' . $row['sprint_name'],
                    'start' => $row['sprint_start_date'],
                    'end' => $row['sprint_end_date'],
                    'color' => 'green');
            }
        }
        return $data_json;
    }

}