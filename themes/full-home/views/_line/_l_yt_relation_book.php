<?php
$cover = 'cover_' . $this_lang;

$trans_cover = 'cover_' . $lang;
?>

<div class="yt-popup-info">
    <div class="col-md-12 col-xs-12 yt-1">
        <div class="col-md-3 col-xs-3">
            <a href="<?php echo Yii::app()->createUrl($model[0]->post_type . '/show', array('slug' => $model[0]->slug)) ?>" data-yt-id="<?php echo $model[0]->post_youtube ?>">
                <img alt="<?php echo $model[0]->post_title ?>" class="img-responsive" src="<?php echo Yii::app()->baseUrl ?>/images/<?php echo $model[0]->post_type ?>/<?php echo $model[0]->{$cover} ?>"/>
            </a>
        </div>
        <div class="col-md-3 col-xs-3">
            <a href="<?php echo Yii::app()->createUrl($model[1]->post_type . '/show', array('slug' => $model[1]->slug)) ?>" data-yt-id="<?php echo $model[1]->post_youtube ?>">
                <img alt="<?php echo $model[1]->post_title ?>" class="img-responsive" src="<?php echo Yii::app()->baseUrl ?>/images/<?php echo $model[1]->post_type ?>/<?php echo $model[1]->{$cover} ?>"/>
            </a>
        </div>
        <div class="col-md-3 col-xs-3">
            <a href="<?php echo Yii::app()->createUrl($model[2]->post_type . '/show', array('slug' => $model[2]->slug)) ?>" data-yt-id="<?php echo $model[2]->post_youtube ?>">
                <img alt="<?php echo $model[2]->post_title ?>" class="img-responsive" src="<?php echo Yii::app()->baseUrl ?>/images/<?php echo $model[2]->post_type ?>/<?php echo $model[2]->{$cover} ?>"/>
            </a>
        </div>
        <div class="col-md-3 col-xs-3">
            <a href="<?php echo Yii::app()->createUrl($model[3]->post_type . '/show', array('slug' => $model[3]->slug)) ?>" data-yt-id="<?php echo $model[3]->post_youtube ?>">
                <img alt="<?php echo $model[3]->post_title ?>" class="img-responsive" src="<?php echo Yii::app()->baseUrl ?>/images/<?php echo $model[3]->post_type ?>/<?php echo $model[3]->{$cover} ?>"/>
            </a>
        </div>
    </div>
    <div class="col-md-12 col-xs-12 yt-1" style="margin-top: 10px;">
        <div class="col-md-3 col-xs-3">
            <a href="<?php echo Yii::app()->createUrl($model[4]->post_type . '/show', array('slug' => $model[4]->slug)) ?>" data-yt-id="<?php echo $model[4]->post_youtube ?>">
                <img alt="<?php echo $model[4]->post_title ?>" class="img-responsive" src="<?php echo Yii::app()->baseUrl ?>/images/<?php echo $model[4]->post_type ?>/<?php echo $model[4]->{$cover} ?>"/>
            </a>
        </div>
        <div class="col-md-3 col-xs-3">
            <a href="<?php echo Yii::app()->createUrl($model[5]->post_type . '/show', array('slug' => $model[5]->slug)) ?>" data-yt-id="<?php echo $model[5]->post_youtube ?>">
                <img alt="<?php echo $model[5]->post_title ?>" class="img-responsive" src="<?php echo Yii::app()->baseUrl ?>/images/<?php echo $model[5]->post_type ?>/<?php echo $model[5]->{$cover} ?>"/>
            </a>
        </div>
        <div class="col-md-3 col-xs-3">
            <a href="<?php echo Yii::app()->createUrl($model[6]->post_type . '/show', array('slug' => $model[6]->slug)) ?>" data-yt-id="<?php echo $model[6]->post_youtube ?>">
                <img alt="<?php echo $model[6]->post_title ?>" class="img-responsive" src="<?php echo Yii::app()->baseUrl ?>/images/<?php echo $model[6]->post_type ?>/<?php echo $model[6]->{$cover} ?>"/>
            </a>
        </div>
        <div class="col-md-3 col-xs-3">
            <a href="<?php echo Yii::app()->createUrl($model[7]->post_type . '/show', array('slug' => $model[7]->slug)) ?>" data-yt-id="<?php echo $model[7]->post_youtube ?>">
                <img alt="<?php echo $model[7]->post_title ?>" class="img-responsive" src="<?php echo Yii::app()->baseUrl ?>/images/<?php echo $model[7]->post_type ?>/<?php echo $model[7]->{$cover} ?>"/>
            </a>
        </div>
    </div>
</div>

<div class="yt-popup-info hidden">
    <div class="col-md-12 col-xs-12 yt-1">
        <div class="col-md-3 col-xs-3">
            <a href="<?php echo Yii::app()->createUrl($model[0]->post_type . '/show', array('slug' => $model[0]->slug)) ?>" data-yt-id="<?php echo $model[0]->post_youtube ?>">
                <img alt="<?php echo $model[0]->post_title ?>" class="img-responsive" src="<?php echo Yii::app()->baseUrl ?>/images/<?php echo $model[0]->post_type ?>/<?php echo $model[0]->{$trans_cover} ?>"/>
            </a>
        </div>
        <div class="col-md-3 col-xs-3">
            <a href="<?php echo Yii::app()->createUrl($model[1]->post_type . '/show', array('slug' => $model[1]->slug)) ?>" data-yt-id="<?php echo $model[1]->post_youtube ?>">
                <img alt="<?php echo $model[1]->post_title ?>" class="img-responsive" src="<?php echo Yii::app()->baseUrl ?>/images/<?php echo $model[1]->post_type ?>/<?php echo $model[1]->{$trans_cover} ?>"/>
            </a>
        </div>
        <div class="col-md-3 col-xs-3">
            <a href="<?php echo Yii::app()->createUrl($model[2]->post_type . '/show', array('slug' => $model[2]->slug)) ?>" data-yt-id="<?php echo $model[2]->post_youtube ?>">
                <img alt="<?php echo $model[2]->post_title ?>" class="img-responsive" src="<?php echo Yii::app()->baseUrl ?>/images/<?php echo $model[2]->post_type ?>/<?php echo $model[2]->{$trans_cover} ?>"/>
            </a>
        </div>
        <div class="col-md-3 col-xs-3">
            <a href="<?php echo Yii::app()->createUrl($model[3]->post_type . '/show', array('slug' => $model[3]->slug)) ?>" data-yt-id="<?php echo $model[3]->post_youtube ?>">
                <img alt="<?php echo $model[3]->post_title ?>" class="img-responsive" src="<?php echo Yii::app()->baseUrl ?>/images/<?php echo $model[3]->post_type ?>/<?php echo $model[3]->{$trans_cover} ?>"/>
            </a>
        </div>
    </div>
    <div class="col-md-12 col-xs-12 yt-1" style="margin-top: 10px;">
        <div class="col-md-3 col-xs-3">
            <a href="<?php echo Yii::app()->createUrl($model[4]->post_type . '/show', array('slug' => $model[4]->slug)) ?>" data-yt-id="<?php echo $model[4]->post_youtube ?>">
                <img alt="<?php echo $model[4]->post_title ?>" class="img-responsive" src="<?php echo Yii::app()->baseUrl ?>/images/<?php echo $model[4]->post_type ?>/<?php echo $model[4]->{$trans_cover} ?>"/>
            </a>
        </div>
        <div class="col-md-3 col-xs-3">
            <a href="<?php echo Yii::app()->createUrl($model[5]->post_type . '/show', array('slug' => $model[5]->slug)) ?>" data-yt-id="<?php echo $model[5]->post_youtube ?>">
                <img alt="<?php echo $model[5]->post_title ?>" class="img-responsive" src="<?php echo Yii::app()->baseUrl ?>/images/<?php echo $model[5]->post_type ?>/<?php echo $model[5]->{$trans_cover} ?>"/>
            </a>
        </div>
        <div class="col-md-3 col-xs-3">
            <a href="<?php echo Yii::app()->createUrl($model[6]->post_type . '/show', array('slug' => $model[6]->slug)) ?>" data-yt-id="<?php echo $model[6]->post_youtube ?>">
                <img alt="<?php echo $model[6]->post_title ?>" class="img-responsive" src="<?php echo Yii::app()->baseUrl ?>/images/<?php echo $model[6]->post_type ?>/<?php echo $model[6]->{$trans_cover} ?>"/>
            </a>
        </div>
        <div class="col-md-3 col-xs-3">
            <a href="<?php echo Yii::app()->createUrl($model[7]->post_type . '/show', array('slug' => $model[7]->slug)) ?>" data-yt-id="<?php echo $model[7]->post_youtube ?>">
                <img alt="<?php echo $model[7]->post_title ?>" class="img-responsive" src="<?php echo Yii::app()->baseUrl ?>/images/<?php echo $model[7]->post_type ?>/<?php echo $model[7]->{$trans_cover} ?>"/>
            </a>
        </div>
    </div>
</div>