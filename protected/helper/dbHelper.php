<?php

class dbHelper {

    /**
     * buat ngambil data enum yang ada di siatu field database
     * @param String $table Nama Table
     * @param String $field Nama fieldnya
     */
    public static function getEnumValue($table, $field) {
        $sql = "SHOW COLUMNS FROM " . $table . " LIKE '" . $field . "'";
        $result = Yii::app()->db->createCommand($sql)->queryRow();
        if (is_array($result)) {
            preg_match_all("/'([^']+)'/", $result['Type'], $matches, PREG_PATTERN_ORDER);
            return $matches[1];
        } else {
            return array();
        }
    }

    public static function getOne($field_name, $table_name, $where) {
        $result = Yii::app()->db->createCommand("SELECT " . $field_name . " FROM " . $table_name . " WHERE " . $where . ' LIMIT 1')->queryRow();
        if ($result) {
            return $result[$field_name];
        } else {
            return false;
        }
    }

    /**
     * method buat ngedapetin data dari table site_config
     * @param String $config_name nama dari config
     * @return String data serialisasi dari config
     */
    public static function getConfig($config_name) {
        $data = self::getOne('config_data', 'site_config', 'config_name=\'' . $config_name . '\'');
        if ($data !== false) {
            return unserialize($data);
        } else
            return false;
    }

    /**
     * Method buat set data site config
     * @param String $config_name nama confignya
     * @param Mixed $config_data data di site config
     */
    public static function setConfig($config_name, $config_data) {
        $data = self::getConfig($config_name);
        if($data !== false) {
            Yii::app()->db->createCommand()->update('site_config', array('config_data' => serialize($config_data)), 
                                            'config_name=:config_name', array(':config_name' => $config_name));
        } else {
            Yii::app()->db->createCommand()->insert('site_config', array('config_data' => serialize($config_data), 'config_name' => $config_name));
        }
    }

}

?>
