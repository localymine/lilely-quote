<!DOCTYPE html>
<html id="html" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- for Google -->
        <meta name="description" content="<?php echo Common::t('Lilely is a single place to discover, listen and share all the messages uplifting you.', 'translate', NULL, $this->lang) ?>" />
        <meta name="keywords" content="quote, book, music" />
        <meta name="author" content="Live Lilely" />
        <meta name="copyright" content="Lilely Company" />
        <meta name="application-name" content="<?php echo $this->pageTitle ?>" />

        <!-- for Facebook -->          
        <meta property="og:title" content="<?php echo $this->pageTitle ?>" />
        <meta property="og:type" content="article" />
        <meta property="og:image" content="<?php echo Yii::app()->params['siteUrl'] . '/images/logo.png' ?>" />
        <meta property="og:url" content="<?php echo Yii::app()->params['siteUrl'] ?>" />
        <meta property="og:description" content="<?php echo Common::t('Lilely is a single place to discover, listen and share all the messages uplifting you.', 'translate', NULL, $this->lang) ?>" />

        <!-- for Twitter -->          
        <meta name="twitter:card" content="summary" />
        <meta name="twitter:title" content="<?php echo $this->pageTitle ?>" />
        <meta name="twitter:description" content="<?php echo Common::t('Lilely is a single place to discover, listen and share all the messages uplifting you.', 'translate', NULL, $this->lang) ?>" />
        <meta name="twitter:image" content="<?php echo Yii::app()->params['siteUrl'] . '/images/logo.png' ?>" />
        
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
        <!--<link href="<?php // echo Yii::app()->theme->baseUrl  ?>/css/style.css" rel="stylesheet">-->
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

        <div class="container clearfix">
            <!-- Page Content -->
            <?php echo $content ?>
            <!-- /#page-content-wrapper -->
        </div>
        
        <div class="container clearfix footer-holder-new <?php echo 'f-' . $this->lang ?>">
            <!-- Footer -->
            <?php $this->widget('FooterNew') ?>
            <!-- // Footer -->
        </div>

        <!--<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/js/jquery-1.11.0.min.js"></script>-->
        <!--<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/bootstrap/js/bootstrap.min.js"></script>-->
        <!--<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/bootstrap/js/bootstrap-hover-dropdown.min.js"></script>-->
        <!--<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/jQuery.jPlayer.2.7.0/jquery.jplayer.min.js"></script>-->
        <!--<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/js-media/jvplay.min.js"></script>-->
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
            $(document).keydown(function (e) {
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
