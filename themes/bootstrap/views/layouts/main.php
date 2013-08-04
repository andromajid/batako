<!DOCTYPE html>
<html class="no-js">

    <head>
        <title>Admin Home Page</title>
        <!-- Bootstrap -->
        <?php
        $baseUrl = Yii::app()->theme->baseUrl;

        $cs = Yii::app()->getClientScript();
        Yii::app()->clientScript->registerCoreScript('jquery');
        ?>
        <link href="<?php echo $baseUrl; ?>/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo $baseUrl; ?>/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo $baseUrl; ?>/assets/template.css" rel="stylesheet" media="screen">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="<?php echo $baseUrl; ?>/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>

    <body>
        <div class="loading">Loading...</div>
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="<?php echo $this->createUrl('/dashboard');?>">BATAKO</a>
                    <div class="nav-collapse collapse">
                        <?php
                        if (isset($this->admin_auth))
                            $this->renderPartial('//layouts/__dropdown_user');
                        ?>
                        <ul class="nav">
                            <li>
                                <a href="<?php echo $this->createUrl('/dashboard');?>">Dashboard</a>
                            </li>
                            <?php
                            if (isset($this->admin_auth))
                                $this->widget('application.widget.widget_user_menu', array('admin_auth' => $this->admin_auth));
                            ?>
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <?php
            if (Yii::app()->user->hasFlash('error')) {
                echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button>' . Yii::app()->user->getFlash('error') . '</div>';
            }
            if (Yii::app()->user->hasFlash('success')) {
                echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . Yii::app()->user->getFlash('success') . '</div>';
            }
            ?>
            <div class="row-fluid">
<?php echo $content; ?>
            </div>
            <hr>
            <footer>
                <p>&copy; Andro Majid 2013</p>
            </footer>
        </div>
        <!--/.fluid-container-->
        <script src="<?php echo $baseUrl; ?>/js/bootstrap.min.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/bootbox.js"></script>
        <script src="<?php echo $baseUrl; ?>/assets/scripts.js"></script>
    </body>

</html>