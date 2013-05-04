
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
        
        <!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>        
    </head>

    <body>
<?php Yii::app()->getClientScript()->registerCoreScript('jquery'); ?>
        <div class="container" id="page">

            <div id="header">
                <div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
            </div><!-- header -->

            <?php
            $currentUrl = '/' . Yii::app()->controller->uniqueid;            
            $currentUrlArr = explode('/', $currentUrl);

            $currentStaticUrl = '/' . Yii::app()->controller->uniqueid. '/' . Yii::app()->controller->action->Id;;

            $menuitems[] = array('label' => 'Home', 'url' => array('/admin/home/system/index'),
                'active' => ( $currentStaticUrl == '/admin/home/system/index' ? true : false));
            if (!Yii::app()->user->isGuest) {
                $items = SysMenuAdminPrivilege::model()->with('adminPrivilegeMenuAdmin')->findAll("admin_privilege_admin_group_id=" . Yii::app()->user->admin_group_id . " AND menu_admin_par_id='0' AND menu_admin_is_active='1'");

                foreach ($items as $item) {
                    $sql = "SELECT*FROM sys_menu_admin_privilege a, sys_menu_admin b
                    WHERE a.admin_privilege_menu_admin_id=b.menu_admin_id AND
                    b.menu_admin_par_id=" . $item->adminPrivilegeMenuAdmin->menu_admin_id . "
                        AND b.menu_admin_is_active='1' AND a.admin_privilege_admin_group_id=".Yii::app()->user->admin_group_id;

                    $menuChildItems = null;
                    $childItems = Yii::app()->db->createCommand($sql)->queryAll();
                    foreach ($childItems as $child) {
                        $menuChildItems[$item->adminPrivilegeMenuAdmin->menu_admin_id][] = array('label' => $child['menu_admin_title'], 'url' => array($child['menu_admin_link']));
                    }
                    
                    $controllerUrl = $item->adminPrivilegeMenuAdmin->menu_admin_link;
                    $controllerUrlArr = explode('/', $controllerUrl);

                    $action = explode('/', $item->adminPrivilegeMenuAdmin->menu_admin_link);
                    $menuitems[] = array('label' => $item->adminPrivilegeMenuAdmin->menu_admin_title, 'url' => array($item->adminPrivilegeMenuAdmin->menu_admin_link),
                        'active' => ( $currentUrlArr[2] == $controllerUrlArr[2] ? true : false),
                        'items' => $menuChildItems[$item->adminPrivilegeMenuAdmin->menu_admin_id]);
                }
                $menuitems[] = array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/admin/home/system/logout'), 'visible' => !Yii::app()->user->isGuest);
            } else {
                $menuitems[] = array('label' => 'Login', 'url' => array('/admin/home/system/login'),
                'visible' => Yii::app()->user->isGuest,
                'active' => ( $currentStaticUrl == '/admin/home/system/login' ? true : false));
            }
            
            $this->widget('application.extensions.mbmenu.MbMenu', array(
                'items' => $menuitems
            ));
            ?>
            <?php if (isset($this->breadcrumbs)): ?>
            <?php
                $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                    'homeLink' => false,
                )); ?><!-- breadcrumbs -->
            <?php endif ?>

            <?php echo $content; ?>

                <div id="footer">
                <?php
                if (!Yii::app()->user->isGuest) {
                    echo 'Terakhir Login: ' . Yii::app()->getDateFormatter()->formatDateTime(Yii::app()->user->last_login, 'long', 'short')."<br/>";
                    echo 'Admin Group ID: ' . Yii::app()->user->admin_group_id;
                }
                ?> <br/>
                    		Copyright &copy; <?php echo date('Y'); ?> Asli Group.<br/>
                    		All Rights Reserved.<br/>
                <?php echo 'Powered by <a href="http://esoftdream.net">Esoftdream</a>. '; ?>
            </div><!-- footer -->

        </div><!-- page -->

    </body>
</html>
