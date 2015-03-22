<?php
Yii::app()->clientScript->registerMetaTag(Yii::app()->name, 'fb-site', null, array('property' => 'og:site_name'));
Yii::app()->clientScript->registerMetaTag($title, 'fb-title', null, array('property' => 'og:title'));
Yii::app()->clientScript->registerMetaTag($description, 'fb-description', null, array('property' => 'og:description'));
Yii::app()->clientScript->registerMetaTag($image_url, 'fb-image', null, array('property' => 'og:image'));
Yii::app()->clientScript->registerMetaTag($share_url, 'fb-url', null, array('property' => 'og:url'));
Yii::app()->clientScript->registerMetaTag('movie', 'fb-type', null, array('property' => 'og:type'));
Yii::app()->clientScript->registerMetaTag($share_url, 'fb-movie', null, array('property' => 'og:video'));
?>

<a class="top-fb-share" target="_blank" href="http://www.facebook.com/sharer/sharer.php?s=100&p[url]=<?php echo $share_url ?>&p[sumary]=<?php echo $description?>&p[images][0]=<?php echo $image_url ?>&p[title]=<?php echo $title ?>"><img class="img-responsive" src="<?php echo Yii::app()->theme->baseUrl ?>/img/fb-share-b.png"/></a>