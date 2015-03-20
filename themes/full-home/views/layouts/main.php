<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="language" content="en" >
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="quote, book, music">
        <meta name="keywords" content="quote, book, music">
        <meta name="author" content="Lilely">
        <link rel="shortcut icon" href="<?php echo Yii::app()->theme->baseUrl ?>/img/favicon.ico">

        <!-- Bootstrap core CSS -->
        <link href="<?php echo Yii::app()->theme->baseUrl ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- font awesome CSS -->
        <link href="<?php echo Yii::app()->theme->baseUrl ?>/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- fancybox CSS -->
        <link href="<?php echo Yii::app()->theme->baseUrl ?>/fancybox/jquery.fancybox.css" rel="stylesheet">
        <!-- slim scroll CSS -->
        <link href="<?php echo Yii::app()->theme->baseUrl ?>/js-slimScroll/style.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <!--<link href="<?php // echo Yii::app()->theme->baseUrl ?>/css/style.css" rel="stylesheet">-->
        <link href="<?php echo Yii::app()->baseUrl ?>/html/css/style.css" rel="stylesheet">

        <script>
        <?php echo Yii::app()->setting->getValue('FACEBOOK_SCRIPT') ?>
        <?php echo Yii::app()->setting->getValue('TWITTER_SCRIPT') ?>
        <?php echo Yii::app()->setting->getValue('GOOGLE_ANALYTICS') ?>
        </script>

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>
    <body>
        <div id="fb-root"></div>
        <!-- menu -->
        <?php $this->widget('MenuHome') ?>
        <!-- /.menu -->

        <div id="wrapper" class="container wrap">

            <!-- Page Content -->
            <div id="page-content-wrapper">
                <div id="content-wrapper">
                    <?php echo $content ?>
                </div>
            </div>
            <!-- /#page-content-wrapper -->
        </div>

        <!--<div class="container clearfix hidden-xs footer-holder">-->
            <!-- Footer -->
            <?php // $this->widget('Footer') ?>
            <!-- // Footer -->
        <!--</div>-->

        <!--<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/js/jquery-1.11.0.min.js"></script>-->
        <!--<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/bootstrap/js/bootstrap.min.js"></script>-->
        <!--<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/bootstrap/js/bootstrap-hover-dropdown.min.js"></script>-->
        <!--<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/jQuery.jPlayer.2.7.0/jquery.jplayer.min.js"></script>-->
        <!--<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/bootbox/bootbox.js"></script>-->
        <!--<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/fancybox/jquery.fancybox.pack.js"></script>-->
        <!--<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/js-slimScroll/jquery.slimscroll.min.js"></script>-->
        <!--<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/js-swipe/jquery.touchSwipe.min.js"></script>-->
        <!--<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/js-validate/jquery.validate.min.js"></script>-->
        <!--<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/js-validate/jquery.validate.bootstrap.popover.min.js"></script>-->
        <!--<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/js/common.js"></script>-->
        
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/js/all.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/js/common.min.js"></script>
        <script>
            var ar = new Array(37, 39);
            $(document).keydown(function(e) {
                var key = e.which;
                //console.log(key);
                //if(key==35 || key == 36 || key == 37 || key == 39)
                if ($.inArray(key, ar) > -1) {
                    e.preventDefault();
                    return false;
                }
                return true;
            });

        </script>
    </body>
</html>
