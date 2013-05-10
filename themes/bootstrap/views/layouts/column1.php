<?php $this->beginContent('//layouts/main'); ?>
<div class="span12" id="content">
    <div class="row-fluid">
        <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left"><?php echo isset($this->title) ? $this->title : 'BATAKO'; ?></div>

            </div>
            <div class="block-content collapse in">
                <?php echo $content; ?>
            </div>
        </div>
    </div>
</div>
<?php $this->endContent(); ?>