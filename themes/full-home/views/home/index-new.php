<?php
$this->pageTitle = 'Home' . ' | ' . Yii::app()->name;
?>

<div class="home-video">
    <div class="home-mid-content">
        <div class="lets-live-lilely">
            <div class="text">
                To Begin Anew
            </div>
        </div>
        <div class="home-buttons">
            <div class="groups">
                <a href="#">
                    <buton class="btn btn-home-st1">Browse Lilely</buton>
                </a>
                <a href="#">
                    <buton class="btn btn-home-st2">View Video<i class="fa fa-long-arrow-right"></i></buton>
                </a>
            </div>
        </div>
        <ul class="home-author">
            <li>Video by</li>
            <li>
                <a>
                    <span id="author">John Lewis</span>
                    <img id="author-img" class="" width="77" src="<?php echo Yii::app()->baseurl ?>/images/quote/quote_2_video-2889251853.png"/>
                </a>
            </li>
        </ul>
    </div>
    <video autoplay loop poster="" id="bgvid">
        <!--<source src="<?php // echo Yii::app()->params['set_media_home_path'] ?>trailer.webm" type="video/webm">-->
        <!--<source src="<?php // echo Yii::app()->params['set_media_home_path'] ?>trailer.mp4" type="video/mp4">-->
    </video>
</div>

<div class="container clearfix home-content">
    <div class="welcome-home">
        <h1 class="h-hi-1">Chào mừng</h1>
        <h1 class="h-hi-2">Các bạn đến với Lilely !</h1>
        <p class="h-ct">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
            modo consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor...</p>
    </div>

    <div class="container top-3-cat">
        <div class="row">
            <div class="col-md-4">
                <div class="hold-title">
                    <div class="t1"><img src="<?php echo Yii::app()->theme->baseurl ?>/img/quote-w.png"/></div>
                    <div class="t2"><a href="<?php echo Yii::app()->createUrl('quote') ?>">Trích dẫn sống</a></div>
                </div>
                <img class="img-responsive bi" src="<?php echo Yii::app()->theme->baseurl ?>/img/quote_06.jpg"/>
            </div>
            <div class="col-md-4">
                <div class="hold-title">
                    <div class="t1"><img src="<?php echo Yii::app()->theme->baseurl ?>/img/book-w.png"/></div>
                    <div class="t2"><a href="<?php echo Yii::app()->createUrl('book') ?>">Tri thức là sức mạnh</a></div>
                </div>
                <img class="img-responsive bi" src="<?php echo Yii::app()->theme->baseurl ?>/img/book_06.jpg"/>
            </div>
            <div class="col-md-4">
                <div class="hold-title">
                    <div class="t1"><img src="<?php echo Yii::app()->theme->baseurl ?>/img/music-w.png"/></div>
                    <div class="t2"><a href="<?php echo Yii::app()->createUrl('music') ?>">Học tiếng Anh <br/>qua bài hát</a></div>
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
                <div class="subt">Subscribe for Newsletter</div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <input type="email" id="email" name="email" placeholder="enter your email id here..." class="form-control" />
                </div>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-cnt">Kết Nối<i class="fa fa-long-arrow-right"></i></button>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>

</div>




<?php
$url_check = Yii::app()->createUrl('subcribe/exists');
$url_regist = Yii::app()->createUrl('subcribe/regist');

$media_path = Yii::app()->params['set_media_home_path'];
$video_sources = array('trailer.webm', 'trailer2.webm', 'trailer3.webm');
foreach ($video_sources as $value) {
    $video_source[] = $media_path . $value;
}
$video_source = json_encode($video_source);

$script = <<< EOD
var videoSource = {$video_source};
        
//var player = new MediaElementPlayer('#bgvid');
//player.pause();
//player.setSrc(videoSource[0]);
//player.play();
        
        
var video = $('#bgvid');
video.attr('src', videoSource[1]);
function videoPlay(vNum){
    video.attr('src', videoSource[vNum]);
    video.load();
    video.play();
}

//video.addEventListener('ended', myHandler, false);
//function myHandler(){
//    var count = videoSource.length;
//    i++;
//    console.log(i);
//    if (i == (count -1)){
//        i = 0;
//        videoPlay(i);
//    } else{
//        videoPlay(i);
//    }
//}

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