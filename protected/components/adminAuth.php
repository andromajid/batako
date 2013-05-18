<?php

/**
 * Class buat menghandle authentifikasi admin
 */
class adminAuth {

    public $auth_name = 'admin';

    public function __construct() {
        if (!session_id()) {
            session_start();
        }
    }

    /**
     * setter buatmagic function dari php __set
     */
    public function __set($name, $value) {
        $_SESSION[$this->auth_name][$name] = value;
    }

    /**
     * method buat ambil data magic function getter
     */
    public function __get($name) {
        if (isset($_SESSION[$this->auth_name][$name]))
            return $_SESSION[$this->auth_name][$name];
        else
            return false;
    }

    /**
     * fungsi buat mengecek authentifikasi dari user admin tersebut
     */
    public function authAdmin() {
        if (isset($_SESSION[$this->auth_name])) {
            return TRUE;
        } else {
             return array('error' => TRUE,
                'message' => 'Sesi telah habis');
        }
        //throw new CHttpException(500, 'Admin Tidak ada');
    }

    /**
     * public function check_password
     */
    public function checkPassword() {
        if (isset($_SESSION[$this->auth_name]['admin_id'])) {
            $data_model = Yii::app()->db->createCommand()->from('site_administrator')->where('admin_id=:admin_id', array(':admin_id' => $_SESSION[$this->auth_name]['admin_id']))
                    ->queryRow();
            if (isset($data_model)) {
                //check password
                if ($_SESSION[$this->auth_name]['admin_password'] == $data_model['admin_password'] && $data_model['admin_is_active'] == '1') {
                    return array('error' => FALSE);
                } else {
                    //CController::redirect('/site/login');//  throw new CHttpException(500, 'Admin Tidak aktiv');
                    return array('error' => TRUE,
                        'message' => 'Admin Tidak aktiv');
                }
            } else {
//                CController::redirect('/site/login');// throw new CHttpException(500, 'Admin Tidak ada');
                return array('error' => TRUE,
                    'message' => 'Admin Tidak ada');
            }
        } else {
            //CController::redirect('/site/login');
            //sthrow new CHttpException(500, 'Admin Tidak ada');
            return array('error' => TRUE,
                'message' => 'Admin Tidak ada');
        }
    }

    /**
     * fungsi buat wrapper authentifikasi
     */
    public function authenthicate() {
        $data_auth_check_password = $this->checkPassword();
        if ($this->authAdmin() && $this->checkPassword()) {
            return TRUE;
        } else
            return false;
    }

    public function login($username, $password) {
        $data_model = Yii::app()->db->createCommand()->from('site_administrator')->where('admin_username=:admin_id', array(':admin_id' => $username))
                ->queryRow();
        if (isset($data_model)) {
            if ($data_model['admin_is_active'] == '0') {
                return array('error' => true, 'message' => 'username : ' . $username . ' tidak aktiv');
            } elseif (md5($password) != $data_model['admin_password']) {
                return array('error' => true, 'message' => 'password salah');
            } else {
                //update last loginnya
                Yii::app()->db->createCommand()->update('site_administrator', array('admin_last_login' => date('Y-m-d H:i:s')), 'admin_id=:admin_id', array(':admin_id' => $data_model['admin_id']));
                $data_arr = array('admin_id' => $data_model['admin_id'],
                    'admin_username' => $data_model['admin_username'],
                    'admin_password' => $data_model['admin_password'],
                    'admin_group_id' => $data_model['admin_group_id'],
                    'admin_group_title' => dbHelper::getOne('admin_group_title', 'site_administrator_group', 'admin_group_id=\'' . $data_model['admin_group_id'] . '\''));
                $_SESSION[$this->auth_name] = $data_arr;
                return array('error' => false, 'message success');
            }
        } else
            return array('error' => true, 'message' => 'username ' . $username . ' tidak ada dalam database');
    }

    public function logout() {
        unset($_SESSION[$this->auth_name]);
    }

    /**
     * fungsi buat ambil data controller dan actionnya kemudian di samakan denga di dabase
     */
    public function auth_action_cont(CController $action) {
        $data_return = array();
        $action_name = $action->module->getName().'.'.$action->id.'.'.$action->action->id;
        //ambil con_action_id
        $con_action_id = dbHelper::getOne('con_action_id', 'site_controller_action', 'con_action_data = \''.$action_name.'\'');
        if($con_action_id) {
            $cek = dbHelper::getOne('con_action_prev_admin_group_id', 'site_con_action_prev', 
                                    'con_action_prev_admin_group_id = '.$this->admin_group_id.' AND con_action_prev_con_action_id = '.$con_action_id);
            if(!$cek) {
                return array('error' => true, 'message' => $action_name.' tidak berhak akses');
            } else return array('error' => false);
        } else {
            return array('error' => true, 'message' => $action_name.' tidak terdapat di database');
        }
    }
}

?>
