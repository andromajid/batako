<?php

class widget_menu_sidebar extends CWidget {
    public $menu;
    public function run() {
        $this->render('widget_menu_sidebar',array(
            'menu'=>$this->menu,
        ));
    }
    

}

?>
