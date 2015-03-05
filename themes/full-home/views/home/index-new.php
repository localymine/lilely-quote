<?php
$this->pageTitle = 'Home' . ' | ' . Yii::app()->name;
?>

<?php
//$this->widget('SocialNetwork', array(
//    'type' => 'social-top-facebook-like-mainpage',
//));
?>

<div class="home-video">
    <video autoplay loop poster="" id="bgvid">
        <source src="<?php echo Yii::app()->params['set_media_home_path'] ?>trailer.webm" type="video/webm">
        <source src="<?php echo Yii::app()->params['set_media_home_path'] ?>trailer.mp4" type="video/mp4">
    </video>
</div>