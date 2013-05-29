<?php

class User_roleController extends adminController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $this->title = 'Create User Role';
        $model = new user_role;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['user_role'])) {
            $model->attributes = $_POST['user_role'];
            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'add user role succeed');
                $this->redirect(array('list'));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $this->title = 'Create User Role (' . $model->user_role_name . ')';
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['user_role'])) {
            $model->attributes = $_POST['user_role'];
            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'add user role succeed');
                $this->redirect(array('list'));
            }
        }

        $this->render('update', array(
            'model' => $model,
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
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('user_role');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionRight($id) {
        if (isset($_POST['update'])) {
            //pertama delete semua menu dari group ini 
            Yii::app()->db->createCommand()->delete('con_action_user_role', 'con_action_user_role_user_role_id=:group_id', array(':group_id' => $id));
            if (is_array($_POST['user_right'])) {
                foreach ($_POST['user_right'] as $row_number => $menu_id) {
                    Yii::app()->db->createCommand()->insert('con_action_user_role', array('con_action_user_role_user_role_id' => $id,
                        'con_action_user_role_con_action_id' => $menu_id));
                }
                Yii::app()->user->setFlash('success', 'data berhasil di perbaharui');
            }
        }
        Yii::import('application.extensions.Metadata');
        $meta = new Metadata();
        $data = $meta->getAll();

        if (isset($data['controllers'])) {
            foreach ($data['controllers'] as $row_controller) {
                //chek apakah sudah dimasukkan ke table
                $cont_name = strtolower(str_replace('Controller', '', $row_controller['name']));
                //grab_action-nya
                foreach ($row_controller['actions'] as $row_action) {
                    $con_action_name = strtolower($cont_name . '.' . $row_action);
                    $cek = dbHelper::getOne('con_action_id', 'con_action', 'con_action_data = \'' . $con_action_name . '\'');
                    if ($cek == '')
                        Yii::app()->db->createCommand()->insert('con_action', array('con_action_data' => $con_action_name));
                }
            }
        }
        $model = Yii::app()->db->createCommand()->select()->from('con_action')->order('con_action_data ASC')->queryAll();
        $model_right = Yii::app()->db->createCommand()->select()->from('con_action_user_role')->where('con_action_user_role_user_role_id=:con_id', array(':con_id' => $id))->queryAll();
        if (is_array($model_right)) {
            foreach ($model_right as $row_right) {
                $data_right[] = $row_right['con_action_user_role_con_action_id'];
            }
        }
        else
            $data_right = array();
        $data_tree = array();
        if (isset($model)) {
            foreach ($model as $row_model) {
                $data_tree[] = array('title' => '/'.str_replace('.', '/', $row_model['con_action_data']),
                    'id' => $row_model['con_action_id'],
                    'select' => @in_array($row_model['con_action_id'], $data_right) ? TRUE : FALSE,);
            }
        }
        $role = dbHelper::getOne('user_role_name', 'user_role', 'user_role_id = '.$id);
        $this->title = "Update User Role ".$role;
        $this->render('right', array('model' => $data_tree));
    }

    /**
     * Manages all models.
     */
    public function actionList() {
        $this->title = 'Manage User Role';
        $model = new user_role('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['user_role']))
            $model->attributes = $_GET['user_role'];

        $this->render('list', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = user_role::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-role-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
