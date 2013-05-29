<?php $this->beginContent('//layouts/main'); ?>
<?php
?>                 
<div class="span12" id="content">
    <div class="row-fluid">
        <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left"><?php echo isset($this->title) ? $this->title : 'BATAKO'; ?></div>

            </div>
            <div class="block-content collapse in">
                 <?php if(count($this->menu) > 0)$this->widget('application.widget.widget_menu_sidebar', array('menu' => $this->menu));?>
                <div class="clearfix clear"></div>
                <?php echo $content; ?>
            </div>
        </div>
    </div>
</div>
<?php $this->endContent(); ?>