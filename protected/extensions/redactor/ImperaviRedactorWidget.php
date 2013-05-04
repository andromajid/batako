<?php

/**
 * ImperaviRedactorWidget class file.
 *
 * @property string $assetsPath
 * @property string $assetsUrl
 * @property array $plugins
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @author Alexander Makarov <sam@rmcreative.ru>
 *
 * @version 1.1
 *
 * @link https://github.com/yiiext/imperavi-redactor-widget
 * @link http://imperavi.com/redactor
 * @license https://github.com/yiiext/imperavi-redactor-widget/blob/master/license.md
 */
class ImperaviRedactorWidget extends CInputWidget {
    /**
     * Assets package ID.
     */
    const PACKAGE_ID = 'imperavi-redactor';

    /**
     * @var array {@link http://imperavi.com/redactor/docs/ redactor options}.
     */
    public $options = array();

    /**
     * @var string|null Selector pointing to textarea to initialize redactor for.
     * Defaults to null meaning that textarea does not exist yet and will be
     * rendered by this widget.
     */
    public $selector;
    public $elfinder = false;

    /**
     * @var array
     */
    public $package = array();

    /**
     * @var array
     */
    private $_plugins = array();

    /**
     * Init widget.
     */
    public function init() {
        parent::init();

        if ($this->selector === null) {
            list($this->name, $this->id) = $this->resolveNameId();
            $this->selector = '#' . $this->id;

            if ($this->hasModel()) {
                echo CHtml::activeTextArea($this->model, $this->attribute, $this->htmlOptions);
            } else {
                $this->htmlOptions['id'] = $this->id;
                echo CHtml::textArea($this->name, $this->value, $this->htmlOptions);
            }
        }

        // Default scripts package.
        $this->package = array(
            'baseUrl' => $this->assetsUrl,
            'js' => array(
                'redactor' . (YII_DEBUG ? '' : '.min') . '.js',
            ),
            'css' => array(
                'redactor.css',
            ),
            'depends' => array(
                'jquery',
            ),
        );

        // Prepend language file to scripts package.
        if (isset($this->options['lang'])) {
            array_unshift($this->package['js'], '/langs/' . $this->options['lang'] . '.js');
        }

        $this->registerClientScript();
    }

    /**
     * Register CSS and Script.
     */
    protected function registerClientScript() {
        $this->elfinder();
        $option = array_merge($this->options, array('callback' => "js:function(obj){
            obj.addBtnBefore('image', 'button1', 'Button Before', function() { 
                var dialog;
                var el = this;
                if (!dialog) {
            dialog = $('<div />').dialogelfinder({
                url: '" . Yii::app()->getController()->createUrl('/admin/file/connector') . "',
                commandsOptions: {
                    getfile: {
                        oncomplete : 'close' // close/hide elFinder
                    }
                },
                getFileCallback: function(file) {
                    console.log($.redactor);
                    image = '<img src=\"'+file+'\">';
                   // RedactorPlugins.insertHtml(image);
                  obj.insertHtml('<img src=\"'+file+'\">');
                  // console.log(dialog.url);
                } // pass callback to file manager
            });
//             console.log(RedactorPlugins.elfinder);
            //this.insertHtml(RedactorPlugins.elfinder);
        } else {
            // reopen elFinder
            dialog.dialogelfinder('open')
        }
            });
            obj.addBtnSeparatorAfter('button1');}"));
        Yii::app()->clientScript
                ->addPackage(self::PACKAGE_ID, $this->package)
                ->registerPackage(self::PACKAGE_ID)
                ->registerScript(
                        $this->id, 'jQuery(' . CJavaScript::encode($this->selector) . ').redactor(' . CJavaScript::encode($option) . ');', CClientScript::POS_READY
        );
        Yii::app()->clientScript
                ->addPackage(self::PACKAGE_ID, $this->package)
                ->registerPackage(self::PACKAGE_ID)
                ->registerCSS('redactor','body .redactor_toolbar li a.redactor_btn_button1 {
    background-position: 5px -144px;
background-image: url("'.Yii::app()->theme->baseUrl.'/img/glyphicons-halflings.png");
}');
        foreach ($this->plugins as $id => $plugin) {
            Yii::app()->clientScript
                    ->addPackage(self::PACKAGE_ID . '-' . $id, $plugin)
                    ->registerPackage(self::PACKAGE_ID . '-' . $id);
        }
    }

    /**
     * Get the assets path.
     * @return string
     */
    public function getAssetsPath() {
      //  return __DIR__ . '/assets';
        return dirname(__FILE__). '/assets';
    }

    /**
     * Publish assets and return url.
     * @return string
     */
    public function getAssetsUrl() {
        return Yii::app()->assetManager->publish($this->assetsPath);
    }

    /**
     * @param array $plugins
     */
    public function setPlugins(array $plugins) {
        if (count($plugins) > 0 && !isset($this->options['plugins'])) {
            $this->options['plugins'] = array();
        }

        foreach ($plugins as $id => $plugin) {
            if (!isset($plugin['baseUrl']) && !isset($plugin['basePath'])) {
                $plugin['baseUrl'] = $this->assetsUrl . '/plugins/' . $id;
            }
            $this->_plugins[$id] = $plugin;
            $this->options['plugins'][] = $id;
        }
    }

    /**
     * @return array
     */
    public function getPlugins() {
        return $this->_plugins;
    }

    /**
     * buat upload elfinder
     */
    public function elfinder() {
        $dir = Yii::app()->basePath . '/extensions/elfinder/assets';
        $assetsDir = Yii::app()->assetManager->publish($dir);
        $cs = Yii::app()->getClientScript();

        // jQuery and jQuery UI
        $cs->registerCssFile($cs->getCoreScriptUrl() . '/jui/css/base/jquery-ui.css');
//        $cs->registerCssFile($this->assetsDir . '/smoothness/jquery-ui-1.8.21.custom.css');
        $cs->registerCssFile('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/smoothness/jquery-ui.css');
        $cs->registerCoreScript('jquery');
        $cs->registerCoreScript('jquery.ui');
//        $cs->registerScriptFile('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/jquery-ui.min.js');
        // elFinder CSS
        $cs->registerCssFile($assetsDir . '/css/elfinder.min.css');

        $cs->registerCssFile($assetsDir . '/css/theme.css');

        // elFinder JS
        $cs->registerScriptFile($assetsDir . '/js/elfinder.min.js');
    }

}
