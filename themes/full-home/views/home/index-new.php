<?php
$this->pageTitle = 'Home' . ' | ' . Yii::app()->name;
?>

<div class="home-video">
    <div class="home-mid-content">
        <div class="lets-live-lilely">
            <div class="text">
                <?php echo Common::t('To Begin Anew', 'translate', NULL, $lang) ?>
            </div>
        </div>
        <div class="home-buttons">
            <div class="groups">
                <a href="<?php echo Yii::app()->createUrl('quote') ?>">
                    <buton class="btn btn-home-st1"><?php echo Common::t('Browser Lilely', 'translate', NULL, $lang) ?></buton>
                </a>
                <a class="mv2video" href="#">
                    <buton class="btn btn-home-st2"><?php echo Common::t('View Video', 'translate', NULL, $lang) ?><i class="fa fa-long-arrow-right"></i></buton>
                </a>
            </div>
        </div>
        <!--
        <ul class="home-author-group">
            <li class="g">
                <ul class="home-author">
                    <li>Video by</li>
                    <li>
                        <a>
                            <span id="author">Jim Rohn</span>
                            <img id="author-img" class="" width="77" src="<?php echo Yii::app()->baseurl ?>/images/author/jim-rohn-(quote)-4249464501.png"/>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="g" style="display: none;">
                <ul class="home-author">
                    <li>Video by</li>
                    <li>
                        <a>
                            <span id="author">Richard Branson</span>
                            <img id="author-img" class="" width="77" src="<?php echo Yii::app()->baseurl ?>/images/author/richard-branson-(quote-1)-3243042496.png"/>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="g" style="display: none;">
                <ul class="home-author">
                    <li>Video by</li>
                    <li>
                        <a>
                            <span id="author">Antonio Lucio Vivaldi</span>
                            <img id="author-img" class="" width="77" src="<?php echo Yii::app()->baseurl ?>/images/author/music_40_author-9322910038.png"/>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="g" style="display: none;">
                <ul class="home-author">
                    <li>Video by</li>
                    <li>
                        <a>
                            <span id="author">Louis Schwartzberg</span>
                            <img id="author-img" class="" width="77" src="<?php echo Yii::app()->baseurl ?>/images/author/louie-schwartzberg--1938634356.png"/>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        -->
    </div>
    <video id="bgvid" poster="" autoplay="" muted></video>
</div>

<div class="container clearfix home-content">
    <div class="welcome-home">
        <!--<h1 class="h-hi-1"><?php // echo Common::t('Welcome!', 'translate', NULL, $lang) ?></h1>-->
        <!--<h2 class="h-hi-2"><?php // echo Common::t('We are Lilely', 'translate', NULL, $lang) ?></h2>-->
        <h1 class="h-ct"><?php echo Common::t('Lilely is a single place to discover, listen and share all the messages uplifting you.', 'translate', NULL, $lang) ?></h1>
    </div>

    <div class="container top-3-cat">
        <div class="row">
            <div class="col-md-4">
                <div class="hold-title">
                    <div class="t1"><img src="<?php echo Yii::app()->theme->baseurl ?>/img/quote-w.png"/></div>
                    <div class="t2"><a href="<?php echo Yii::app()->createUrl('quote') ?>"><?php echo Common::t('Quote to live by', 'translate', NULL, $lang) ?></a></div>
                </div>
                <img class="img-responsive bi" src="<?php echo Yii::app()->theme->baseurl ?>/img/quote_06.jpg"/>
            </div>
            <div class="col-md-4">
                <div class="hold-title">
                    <div class="t1"><img src="<?php echo Yii::app()->theme->baseurl ?>/img/book-w.png"/></div>
                    <div class="t2"><a href="<?php echo Yii::app()->createUrl('book') ?>"><?php echo Common::t('Knowledge is power', 'translate', NULL, $lang) ?></a></div>
                </div>
                <img class="img-responsive bi" src="<?php echo Yii::app()->theme->baseurl ?>/img/book_06.jpg"/>
            </div>
            <div class="col-md-4">
                <div class="hold-title">
                    <div class="t1"><img src="<?php echo Yii::app()->theme->baseurl ?>/img/music-w.png"/></div>
                    <div class="t2"><a href="<?php echo Yii::app()->createUrl('music') ?>"><?php echo Common::t('Learn English with songs', 'translate', NULL, $lang) ?></a></div>
                </div>
                <img class="img-responsive bi" src="<?php echo Yii::app()->theme->baseurl ?>/img/music_06.jpg"/>
            </div>
        </div>
    </div>

    <div class="container h-n-subscribe">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'subscribe-form',
            'action' => Yii::app()->createUrl('subcribe/regist'),
            'htmlOptions' => array(
                'class' => 'form-horizontal',
        )));
        ?>
        <div class="row">
            <div class="col-md-4 col-md-offset-1 eba">
                <img src="<?php echo Yii::app()->theme->baseurl ?>/img/email.png"/>
                <div class="subt"><?php echo Common::t('Subscribe for Newsletter', 'translate', NULL, $lang) ?></div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <input type="email" id="email" name="email" placeholder="<?php echo Common::t('Enter your Email Address', 'translate', NULL, $lang) ?>" class="form-control" />
                </div>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-cnt"><?php echo Common::t('Subscribe', 'translate', NULL, $lang) ?><i class="fa fa-long-arrow-right"></i></button>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>

</div>




<?php
$url_check = Yii::app()->createUrl('subcribe/exists');
$url_regist = Yii::app()->createUrl('subcribe/regist');

$media_path = Yii::app()->params['siteUrl'] . '/' . Yii::app()->params['set_media_home_path'];
$video_sources = array('Sequence02.webm', 'Sequence03.webm', 'Sequence04.webm');
$quote_urls = array(
    array('quote' => 'screw-it-let-s-do-it'),
    array('music' => 'the-four-seasons-winter'),
    array('quote' => 'beauty-and-seduction-i-believe-is-nature-s-tool-for-survival-because-we-will-protect-what-we-fall-in-love-with'),
);
foreach ($video_sources as $value) {
    $video_source[] = $media_path . $value;
}
foreach ($quote_urls as $value) {
    foreach ($value as $k => $v) {
        $quote_url[] = Yii::app()->createUrl($k . '/show', array('slug' => $v));
    }
}
$video_source = json_encode($video_source);
$quote_url = json_encode($quote_url);
$script = <<< EOD

var quote_url = $quote_url;
        
$('.mv2video').attr('href', quote_url[0]);
        
$('#bgvid').autoPlayVideo({
    source: $video_source,
    after: function (e) {
        $('.home-author-group li.g').fadeOut(1000).removeClass('active');
        $('.home-author-group li.g:nth-child(' + e.index + ')').fadeIn(1000);
        $('a.mv2video').attr('href', quote_url[e.index - 1]);
    }
});

$(function(){
    var form_valid = $('#subscribe-form');

    var validator = form_valid.validate_popover({
        rules: {
            email: {
                email: {
                    required: true,
                    email: true
                },
                remote: {
                    url: '$url_check',
                    type: 'POST',
                    async: false
                }
            }
        },
        showErrors: function(errorMap, errorList) {
            // Clean up any tooltips for valid elements
            $.each(this.validElements(), function(index, element) {
                var \$element = $(element);
                \$element.data("title", "") // Clear the title - there is no error associated anymore
                        .removeClass("error")
                        .tooltip("destroy");
            });
            // Create new tooltips for invalid elements
            $.each(errorList, function(index, error) {
                var \$element = $(error.element);
                \$element.tooltip("destroy") // Destroy any pre-existing tooltip so we can repopulate with new tooltip content
                        .data("title", error.message)
                        .addClass("error")
                        .tooltip(); // Create a new tooltip based on the error messsage we just set in the title
            });
        },
        messages: {
            email: {
                remote: 'Email Exist!'
            }
        },
        submitHandler: function (form) {
            var email = $('#email').val();
            if (email != ''){
                $.ajax({
                    type: 'POST',
                    url: '$url_regist',
                    data: {email: email},
                    before: function(){
                        loader.start();
                    },
                    success: function(res) {
                        if (res == 1) {
                            bootbox.alert('Thank you for applying', function(){
                                $('#modal-subscribe').css('visibility', 'hidden').removeClass('md-effect-13');
                                $('#email').val('');
                            }).find("div.modal-dialog").addClass("largeWidth");
                        }
                        loader.stop();
                    },
                    error: function() {
                        loader.stop();
                    }
                });
            }
            return false;
        }
    });    
});
EOD;

Yii::app()->clientScript->registerScript('home-video-' . rand(), $script, CClientScript::POS_END);
?>