<?php
Yii::app()->clientScript->registerMetaTag(Yii::app()->name, 'fb-site', null, array('property' => 'og:site_name'));
Yii::app()->clientScript->registerMetaTag($title, 'fb-title', null, array('property' => 'og:title'));
Yii::app()->clientScript->registerMetaTag($description, 'fb-description', null, array('property' => 'og:description'));
Yii::app()->clientScript->registerMetaTag($image_url, 'fb-image', null, array('property' => 'og:image'));
Yii::app()->clientScript->registerMetaTag($share_url, 'fb-url', null, array('property' => 'og:url'));
Yii::app()->clientScript->registerMetaTag('movie', 'fb-type', null, array('property' => 'og:type'));
Yii::app()->clientScript->registerMetaTag($share_url, 'fb-movie', null, array('property' => 'og:video'));
?>

<div class="fb-like-share">
    <div class="fb-like" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
</div>