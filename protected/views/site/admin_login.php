<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        $baseUrl = Yii::app()->theme->baseUrl;
        $cs = Yii::app()->getClientScript();
        Yii::app()->clientScript->registerCoreScript('jquery');
        ?>
        <meta charset="utf-8">
        <title><?php echo Yii::app()->name; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- The styles -->
        <?php
        $cs->registerCssFile($baseUrl . '/css/bootstrap.min.css');
        $cs->registerCssFile($baseUrl . '/css/bootstrap-responsive.min.css');
        //$cs->registerCssFile($baseUrl.'/css/style-blue.css');
        $cs->registerScriptFile($baseUrl . '/js/bootstrap.min.js');
        ?>

        <style type="text/css">
            body {
                padding-bottom: 40px;
            }
            .sidebar-nav {
                padding: 9px 0;
            }
            div.center,p.center,img.center{
                margin-left: auto !important;
                margin-right: auto !important;
                float:none !important;
                display: block;
                text-align:center;
            }
        </style>

    </head>

    <body>
        <div class="container-fluid">
            <div class="row-fluid">

                <div class="row-fluid">
                    <div class="span12 center login-header">
                        <h2>Welcome to <?php echo Yii::app()->name; ?></h2>
                    </div><!--/span-->
                </div><!--/row-->

                <div class="row-fluid">
                    <div class="well span5 center login-box">

                        <div class="alert alert-info">
                            Please login with your Username and Password.
                        </div><?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'login-form',
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
                ));
        ?> <?php if ($model->hasErrors()): ?>
                            <div class="alert alert-error">
                                <?php echo $form->errorSummary($model); ?>
                            </div>
                        <?php endif; ?>
                        <fieldset>
                            <div class="input-prepend" title="Username" data-rel="tooltip">
                                <span class="add-on"><i class="icon-user"></i></span><?php echo $form->textField($model, 'username', array('autofocus' => 'autofocus', 'placeholder' => 'Admin Username', 'class' => 'input-large span10')); ?>
                            </div>
                            <div class="clearfix"></div>

                            <div class="input-prepend" title="Password" data-rel="tooltip">
                                <span class="add-on"><i class="icon-lock"></i></span><?php echo $form->passwordField($model, 'password', array('class' => 'input-large span10', 'placeholder' => 'Admin Password')); ?>
                            </div>
                            <div>
                                 <div class="input-prepend" title="captcha" data-rel="tooltip">
                                <?php  echo CHtml::image($this->createUrl('/site/captcha', array('session_name' => 'site_captcha'))).'';?><span class="add-on"><i class="icon-picture"></i></span><?php echo $form->textField($model, 'captcha', array('class' => 'span7', 'placeholder' => 'Kode Unik')); ?>
                            </div>
                            </div>
                            <div class="clearfix"></div>

                            <p class="center span5">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </p>
                        </fieldset>
                        <?php $this->endWidget(); ?>
                    </div><!--/span-->
                </div><!--/row-->
            </div><!--/fluid-row-->

        </div><!--/.fluid-container-->



    </body>
</html>
