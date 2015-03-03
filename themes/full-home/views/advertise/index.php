<?php
$this->pageTitle = Yii::app()->name;
?>

<div class="min-height">
    <div class="row">
        <div class="block advertise">
            <?php $this->renderPartial('_form', array('model' => $model, 'model_ads_relate' => $model_ads_relate)) ?>
        </div>
    </div>
</div>