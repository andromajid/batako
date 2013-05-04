<?php

class UserController extends adminController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new SiteAdministrator;
        $group_admin = SiteAdministratorGroup::model()->getAllGroupAdmin();
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['SiteAdministrator'])) {
            $model->attributes = $_POST['SiteAdministrator'];
            $model->admin_password = md5($model->admin_password);
            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'data admin berhasil ditambah');
                $this->redirect('index');
            }
        }

        $this->render('create', array(
            'model' => $model,
            'group_admin' => $group_admin,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $group_admin = SiteAdministratorGroup::model()->getAllGroupAdmin();
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['SiteAdministrator'])) {
            $model->attributes = $_POST['SiteAdministrator'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->admin_id));
        }

        $this->render('update', array(
            'model' => $model,
            'group_admin' => $group_admin,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Manages all models.
     */
    public function actionIndex() {
        $model = new SiteAdministrator('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['SiteAdministrator']))
            $model->attributes = $_GET['SiteAdministrator'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = SiteAdministrator::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionRight($id) {
        if (isset($_POST['update'])) {
            //pertama delete semua menu dari group ini 
            Yii::app()->db->createCommand()->delete('site_con_action_prev', 'con_action_prev_admin_group_id=:group_id', array(':group_id' => $id));
            if (is_array($_POST['user_right'])) {
                foreach ($_POST['user_right'] as $row_number => $menu_id) {
                    Yii::app()->db->createCommand()->insert('site_con_action_prev', array('con_action_prev_admin_group_id' => $id,
                        'con_action_prev_con_action_id' => $menu_id));
                }
                Yii::app()->user->setFlash('success', 'data berhasil di perbaharui');
            }
        }
        Yii::import('application.extensions.Metadata');
        $meta = new Metadata();
        $data = $meta->getAll();

//        if (isset($data['controllers'])) {
//            foreach ($data['controllers'] as $row_controller) {
//                //chek apakah sudah dimasukkan ke table
//                $cont_name = strtolower(str_replace('Controller', '', $row_controller['name']));
//                //grab_action-nya
//                foreach ($row_controller['actions'] as $row_action) {
//                    $con_action_name = strtolower($cont_name . '.' . $row_action);
//                    $cek = dbHelper::getOne('con_action_id', 'site_controller_action', 'con_action_data = \'' . $con_action_name . '\'');
//                    if ($cek == '')
//                        Yii::app()->db->createCommand()->insert('site_controller_action', array('con_action_data' => $con_action_name));
//                }
//            }
//        }
        //buat modulenya
        if (isset($data['modules'])) {
            foreach ($data['modules'] as $data_module) {
                $module_name = $data_module['name'];
                foreach ($data_module['controllers'] as $row_module_data) {
                    $cont_name = strtolower(str_replace('Controller', '', $row_module_data['name']));
                    //grab_action-nya
                    foreach ($row_module_data['actions'] as $row_action) {
                        $con_action_name = strtolower($module_name . '.' . $cont_name . '.' . $row_action);
                        $cek = dbHelper::getOne('con_action_id', 'site_controller_action', 'con_action_data = \'' . $con_action_name . '\'');
                        if ($cek == '')
                            Yii::app()->db->createCommand()->insert('site_controller_action', array('con_action_data' => $con_action_name));
                    }
                }
            }
        }
        $model = Yii::app()->db->createCommand()->select()->from('site_controller_action')->order('con_action_data ASC')->queryAll();
        $model_right = Yii::app()->db->createCommand()->select()->from('site_con_action_prev')->where('con_action_prev_admin_group_id=:con_id', array(':con_id' => $id))->queryAll();
        if (is_array($model_right)) {
            foreach ($model_right as $row_right) {
                $data_right[] = $row_right['con_action_prev_con_action_id'];
            }
        } else
            $data_right = array();
        $data_tree = array();
        if (isset($model)) {
            foreach ($model as $row_model) {
                $data_tree[] = array('title' => $row_model['con_action_data'],
                    'id' => $row_model['con_action_id'],
                    'select' => @in_array($row_model['con_action_id'], $data_right) ? TRUE : FALSE,);
            }
        }
        $this->render('right', array('model' => $data_tree));
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'site-administrator-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
