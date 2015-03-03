<?php
$this->pageTitle = 'Terms' . ' | ' . Yii::app()->name;

?>

<div class="gallery min-height">
    <div class="row">
        <?php if(isset($model->post_content)): ?>
            <?php echo $model->post_content ?>
        <?php endif; ?>
    </div>
</div>