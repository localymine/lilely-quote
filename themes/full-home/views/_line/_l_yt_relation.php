<?php
$post_title = 'post_title_' . $this_lang;
$post_content = 'post_content_' . $this_lang;

$trans_post_title = 'post_title_' . $lang;
$trans_post_content = 'post_content_' . $lang;
?>

<div class="yt-popup-info">
<div class="col-md-12 col-xs-12 yt-1">
    <div class="col-md-6 col-xs-6">
        <a href="<?php echo Yii::app()->createUrl($model[0]->post_type . '/show', array('slug' => $model[0]->slug)) ?>" data-yt-id="<?php echo $model[0]->post_youtube ?>">
            <img alt="<?php echo $model[0]->post_title ?>" class="img-responsive" src="<?php echo Yii::app()->baseUrl ?>/images/<?php echo $model[0]->post_type ?>/<?php echo $model[0]->image ?>"/>
            <div class="title">
                <?php if ($model[0]->post_type == 'music'): ?>
                    <?php echo $model[0]->{$post_title} ?>
                <?php else: ?>
                    <?php echo $model[0]->{$post_content} ?>
                <?php endif; ?>
            </div>
        </a>
    </div>
    <div class="col-md-6 col-xs-6">
        <a href="<?php echo Yii::app()->createUrl($model[1]->post_type . '/show', array('slug' => $model[1]->slug)) ?>" data-yt-id="<?php echo $model[1]->post_youtube ?>">
            <img alt="<?php echo $model[1]->post_title ?>" class="img-responsive" src="<?php echo Yii::app()->baseUrl ?>/images/<?php echo $model[1]->post_type ?>/<?php echo $model[1]->image ?>"/>
            <div class="title">
                <?php if ($model[1]->post_type == 'music'): ?>
                    <?php echo $model[1]->{$post_title} ?>
                <?php else: ?>
                    <?php echo $model[1]->{$post_content} ?>
                <?php endif; ?>
            </div>
        </a>
    </div>
</div>
<div class="col-md-12 hidden-xs yt-1" style="margin-top: 10px;">
    <div class="col-md-6">
        <a href="<?php echo Yii::app()->createUrl($model[2]->post_type . '/show', array('slug' => $model[2]->slug)) ?>" data-yt-id="<?php echo $model[2]->post_youtube ?>">
            <img alt="<?php echo $model[2]->post_title ?>" class="img-responsive" src="<?php echo Yii::app()->baseUrl ?>/images/<?php echo $model[2]->post_type ?>/<?php echo $model[2]->image ?>"/>
            <div class="title">
                <?php if ($model[2]->post_type == 'music'): ?>
                    <?php echo $model[2]->{$post_title} ?>
                <?php else: ?>
                    <?php echo $model[2]->{$post_content} ?>
                <?php endif; ?>
            </div>
        </a>
    </div>
    <div class="col-md-6">
        <a href="<?php echo Yii::app()->createUrl($model[3]->post_type . '/show', array('slug' => $model[3]->slug)) ?>" data-yt-id="<?php echo $model[3]->post_youtube ?>">
            <img alt="<?php echo $model[3]->post_title ?>" class="img-responsive" src="<?php echo Yii::app()->baseUrl ?>/images/<?php echo $model[3]->post_type ?>/<?php echo $model[3]->image ?>"/>
            <div class="title">
                <?php if ($model[3]->post_type == 'music'): ?>
                    <?php echo $model[3]->{$post_title} ?>
                <?php else: ?>
                    <?php echo $model[3]->{$post_content} ?>
                <?php endif; ?>
            </div>
        </a>
    </div>
</div>
<div class="col-xs-12 visible-xs yt-3">
    <div class="col-xs-6">
        <a href="<?php echo Yii::app()->createUrl($model[2]->post_type . '/show', array('slug' => $model[2]->slug)) ?>" data-yt-id="<?php echo $model[2]->post_youtube ?>">
            <img alt="<?php echo $model[2]->post_title ?>" class="img-responsive" src="<?php echo Yii::app()->baseUrl ?>/images/<?php echo $model[2]->post_type ?>/<?php echo $model[2]->image ?>"/>
            <div class="title">
                <?php if ($model[2]->post_type == 'music'): ?>
                    <?php echo $model[2]->{$post_title} ?>
                <?php else: ?>
                    <?php echo $model[2]->{$post_content} ?>
                <?php endif; ?>
            </div>
        </a>
    </div>
    <div class="col-xs-6">
        <a href="<?php echo Yii::app()->createUrl($model[3]->post_type . '/show', array('slug' => $model[3]->slug)) ?>" data-yt-id="<?php echo $model[3]->post_youtube ?>">
            <img alt="<?php echo $model[3]->post_title ?>" class="img-responsive" src="<?php echo Yii::app()->baseUrl ?>/images/<?php echo $model[3]->post_type ?>/<?php echo $model[3]->image ?>"/>
            <div class="title">
                <?php if ($model[3]->post_type == 'music'): ?>
                    <?php echo $model[3]->{$post_title} ?>
                <?php else: ?>
                    <?php echo $model[3]->{$post_content} ?>
                <?php endif; ?>
            </div>
        </a>
    </div>
</div>
</div>

<div class="yt-popup-info hidden">
<div class="col-md-12 col-xs-12 yt-1">
    <div class="col-md-6 col-xs-6">
        <a href="<?php echo Yii::app()->createUrl($model[0]->post_type . '/show', array('slug' => $model[0]->slug)) ?>" data-yt-id="<?php echo $model[0]->post_youtube ?>">
            <img alt="<?php echo $model[0]->post_title ?>" class="img-responsive" src="<?php echo Yii::app()->baseUrl ?>/images/<?php echo $model[0]->post_type ?>/<?php echo $model[0]->image ?>"/>
            <div class="title">
                <?php if ($model[0]->post_type == 'music'): ?>
                    <?php echo $model[0]->{$trans_post_title} ?>
                <?php else: ?>
                    <?php echo $model[0]->{$trans_post_content} ?>
                <?php endif; ?>
            </div>
        </a>
    </div>
    <div class="col-md-6 col-xs-6">
        <a href="<?php echo Yii::app()->createUrl($model[1]->post_type . '/show', array('slug' => $model[1]->slug)) ?>" data-yt-id="<?php echo $model[1]->post_youtube ?>">
            <img alt="<?php echo $model[1]->post_title ?>" class="img-responsive" src="<?php echo Yii::app()->baseUrl ?>/images/<?php echo $model[1]->post_type ?>/<?php echo $model[1]->image ?>"/>
            <div class="title">
                <?php if ($model[1]->post_type == 'music'): ?>
                    <?php echo $model[1]->{$trans_post_title} ?>
                <?php else: ?>
                    <?php echo $model[1]->{$trans_post_content} ?>
                <?php endif; ?>
            </div>
        </a>
    </div>
</div>
<div class="col-md-12 hidden-xs yt-1" style="margin-top: 10px;">
    <div class="col-md-6">
        <a href="<?php echo Yii::app()->createUrl($model[2]->post_type . '/show', array('slug' => $model[2]->slug)) ?>" data-yt-id="<?php echo $model[2]->post_youtube ?>">
            <img alt="<?php echo $model[2]->post_title ?>" class="img-responsive" src="<?php echo Yii::app()->baseUrl ?>/images/<?php echo $model[2]->post_type ?>/<?php echo $model[2]->image ?>"/>
            <div class="title">
                <?php if ($model[2]->post_type == 'music'): ?>
                    <?php echo $model[2]->{$trans_post_title} ?>
                <?php else: ?>
                    <?php echo $model[2]->{$trans_post_content} ?>
                <?php endif; ?>
            </div>
        </a>
    </div>
    <div class="col-md-6">
        <a href="<?php echo Yii::app()->createUrl($model[3]->post_type . '/show', array('slug' => $model[3]->slug)) ?>" data-yt-id="<?php echo $model[3]->post_youtube ?>">
            <img alt="<?php echo $model[3]->post_title ?>" class="img-responsive" src="<?php echo Yii::app()->baseUrl ?>/images/<?php echo $model[3]->post_type ?>/<?php echo $model[3]->image ?>"/>
            <div class="title">
                <?php if ($model[3]->post_type == 'music'): ?>
                    <?php echo $model[3]->{$trans_post_title} ?>
                <?php else: ?>
                    <?php echo $model[3]->{$trans_post_content} ?>
                <?php endif; ?>
            </div>
        </a>
    </div>
</div>
<div class="col-xs-12 visible-xs yt-3">
    <div class="col-xs-6">
        <a href="<?php echo Yii::app()->createUrl($model[2]->post_type . '/show', array('slug' => $model[2]->slug)) ?>" data-yt-id="<?php echo $model[2]->post_youtube ?>">
            <img alt="<?php echo $model[2]->post_title ?>" class="img-responsive" src="<?php echo Yii::app()->baseUrl ?>/images/<?php echo $model[2]->post_type ?>/<?php echo $model[2]->image ?>"/>
            <div class="title">
                <?php if ($model[2]->post_type == 'music'): ?>
                    <?php echo $model[2]->{$trans_post_title} ?>
                <?php else: ?>
                    <?php echo $model[2]->{$trans_post_content} ?>
                <?php endif; ?>
            </div>
        </a>
    </div>
    <div class="col-xs-6">
        <a href="<?php echo Yii::app()->createUrl($model[3]->post_type . '/show', array('slug' => $model[3]->slug)) ?>" data-yt-id="<?php echo $model[3]->post_youtube ?>">
            <img alt="<?php echo $model[3]->post_title ?>" class="img-responsive" src="<?php echo Yii::app()->baseUrl ?>/images/<?php echo $model[3]->post_type ?>/<?php echo $model[3]->image ?>"/>
            <div class="title">
                <?php if ($model[3]->post_type == 'music'): ?>
                    <?php echo $model[3]->{$trans_post_title} ?>
                <?php else: ?>
                    <?php echo $model[3]->{$trans_post_content} ?>
                <?php endif; ?>`
            </div>
        </a>
    </div>
</div>
</div>