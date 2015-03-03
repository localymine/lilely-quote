<?php if ($model != NULL): ?>
    <?php if ($model->disp_type == 1): ?> <!-- image -->
    <!--<div class="row" style="margin: 10px 0;">-->
    <div class="container" style="position: absolute">
        <div class="col-md-12 banner center-block">
            <img src="<?php echo Yii::app()->baseUrl . '/images/slide/' . $model->image ?>" class="img-responsive center-block" />
        </div>
    </div>
    <?php else: ?> <!-- canvas -->
    <div class="container canvas-holder" style="position: absolute">
        <div class="col-md-12 banner center-block">
            <?php // if ($model->css) { echo CHtml::css($model->css); }?>

            <?php if ($model->html): ?>
            <?php echo $model->html; ?>
            <?php endif; ?>

            <?php if ($model->script): ?>
            <?php
            Common::register_js(Yii::app()->baseUrl . '/js/cavasengine/canvasengine-1.3.2.all.min.js', CClientScript::POS_HEAD);
            ?>
            <?php echo CHtml::script($model->script) ?>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
<?php endif; ?>