<?php

class UsergroupController extends adminController {

    public $layout = '//layouts/column2';

    public function actionIndex() {
//        echo $this->admin_auth->admin_password;
//        die();
        if (isset($_POST['disable'])) {
            if (is_array($_POST['aktiv'])) {
                foreach ($_POST['aktiv'] as $data => $id) {
                    Yii::app()->db->createCommand()->update('site_administrator_group', array('admin_group_is_active' => '0')
                            , 'admin_group_id=' . $id);
                }
            }
        }
        if (isset($_POST['enable'])) {
            if (is_array($_POST['aktiv'])) {
                foreach ($_POST['aktiv'] as $data => $id) {
                    Yii::app()->db->createCommand()->update('site_administrator_group', array('admin_group_is_active' => '1')
                            , 'admin_group_id=' . $id);
                }
            }
        }
        
        $model2 =  new SiteAdministratorGroup;
        if(isset($_POST['insert'])) {
            $model2->admin_group_title = $_POST['admin_group_title'];
            if($model2->save()) {
                Yii::app()->user->setFlash('success', 'Penambahan group admin : '.$model2->admin_group_title." berhasil");
            }
        }
        $model = new SiteAdministratorGroup('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['SiteAdministratorGroup']))
            $model->attributes = $_GET['SiteAdministratorGroup'];
        $this->render('index', array(
            'model' => $model,
            'model2' => $model2,
        ));
    }

    public function actionUpdate($id) {
        $url = new CUrlManager;
        $data = $url->getBaseUrl();
        if (isset($_POST['update'])) {
            //pertama delete semua menu dari group ini 
            Yii::app()->db->createCommand()->delete('site_menu_privilege', 'privilege_admin_group_id=:group_id', array(':group_id' => $id));
            if (is_array($_POST['usergroup'])) {
                foreach ($_POST['usergroup'] as $row_number => $menu_id) {
                    Yii::app()->db->createCommand()->insert('site_menu_privilege', array('privilege_admin_group_id' => $id,
                        'privilege_menu_id' => $menu_id));
                }
                //update title-nya
                $feedback = SiteAdministratorGroup::model()->updateGroupUser($id, array('admin_group_title' => $_POST['admin_group_title']));
                Yii::app()->user->setFlash('success', 'data berhasil di perbaharui');
            }
        }
        $data_format_previlage = array();
        //echo '<pre>';
        $data_previlage = SiteMenuPrivilege::model()->getUserMenuPrivilage($id);
        //difilter dolo data array-nya
        if (is_array($data_previlage)) {
            foreach ($data_previlage as $row_data_previlage) {
                $data_format_previlage[] = $row_data_previlage['privilege_menu_id'];
            }
        }
        $data = SiteMenu::model()->getMenuRecursive(0, $data_format_previlage);
        $data_group_user = SiteAdministratorGroup::model()->getUserGroupById($id);

        $this->render('update', array('data' => $data, 'model' => $data_group_user));
    }

    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }
    
    public function actionCreate() {
        $model =  new SiteAdministratorGroup;
        $this->render('create', array('model'));
    }
    
    public function loadModel($id) {
        $model = SiteAdministratorGroup::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

}