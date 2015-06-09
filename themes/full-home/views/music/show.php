<?php
$this->pageTitle = $post->post_title . ' | ' . Common::t('Classical Music') . ' | ' . Yii::app()->name;

$avatar = ($post->post_by->image != '') ? $post->post_by->image : 'avatar.png';
$image_entry = ($post->image != '') ? $post->image : 'no-image.png';

// social network
$share_url = Yii::app()->params['siteUrl'] . '/music/' . $post->slug;
//$title = $post->post_title;
$title = Common::t('Classical Music') . ' | ' . Yii::app()->name;
//$image_url = Yii::app()->params['siteUrl'] . '/images/music/' . $image_entry;

$filename = $post->post_type . '-' . $image_entry;
$filename_path = Yii::app()->params['set_image_path'] . 'thumb/' . $filename;
if (file_exists($filename_path) === FALSE) {
    Yii::app()->curl->get(Yii::app()->params['siteUrl'] . '/thumb', array('im' => $image_entry, 'tp' => $post->post_type));
}
$image_url = Yii::app()->params['siteUrl'] . '/images/thumb/' . $filename;

//$description = $post->post_excerpt;
$description = $post->post_title;

foreach ($this->languages as $key => $value) {
    if ($this->lang != $key) {
        $lang = $key;
        break;
    }
}

// get topics
$tags = TermRelationships::model()->get_relate_terms($post->id, 'category', 0)->findAll();
$arr_tags = NULL;
$arr_trans_tags = NULL;

$post_content = 'post_content_' . $this->lang;
$name = 'name_' . $this->lang;
$slug = 'slug_' . $this->lang;
$soundtrack = 'soundtrack_' . $this->lang;

$trans_post_content = 'post_content_' . $lang;
$trans_name = 'name_' . $lang;
$trans_slug = 'slug_' . $lang;
$trans_soundtrack = 'soundtrack_' . $lang;

if ($tags != NULL) {
    foreach ($tags as $tag) {
        $terms = Terms::model()->multilang()->findByPk($tag->term_taxonomy_id);
        $arr_tags[] = CHtml::link($terms->{$name}, Yii::app()->createUrl('topic', array('slug' => $terms->slug)));
        $arr_trans_tags[] = CHtml::link($terms->{$trans_name}, Yii::app()->createUrl('topic', array('slug' => $terms->{$trans_slug}, 'language' => $lang)));
    }
}

// for translate
$model_line = Post::model()->localized($lang)->findByPk($post->id);
?>

<div class="top-social-holder">
    <div class="col-md-2 col-md-offset-1 col-xs-12 holder">
        <?php
        $this->widget('SocialNetwork', array(
            'type' => 'social-top-facebook-share',
            'data_href' => $share_url,
            'title' => $title,
            'image_url' => $image_url,
            'description' => $description,
        ));
        ?>
    </div>
    <div class="col-md-8 col-xs-12">
        <div class="music-text">
            <div><img src="<?php echo Yii::app()->theme->baseUrl ?>/img/music-r-16.png"/><?php echo $post->post_title ?></div>
        </div>
        <div class="music-text hidden">
            <div><img src="<?php echo Yii::app()->theme->baseUrl ?>/img/music-r-16.png"/><?php echo $model_line->post_title ?></div>
        </div>
    </div>
</div>

<div class="row show-content">
    <div class="col-md-12">

        <div class="row">
            <div class="col-md-12">
                <div class="s-book-title center-block"><?php echo $post->post_title ?></div>
                <div class="s-book-title center-block hidden"><?php echo $model_line->post_title ?></div>
            </div>
            <div class="col-md-12">
                <div class="by-author center-block"><span><?php echo Common::t('By', 'translate') ?> <?php echo $post->quote_author ?></span> &nbsp;<a href="javascript:void(0)" class="trans-show-btn"><i class="glyphicon glyphicon-globe"></i></a></div>
                <div class="by-author center-block hidden"><span><?php echo Common::t('By', 'translate', NULL, $lang) ?> <?php echo $post->quote_author ?></span> &nbsp;<a href="javascript:void(0)" class="trans-show-btn"><i class="glyphicon glyphicon-globe"></i></a></div>
            </div>
            <div class="col-md-12">
                <div class="music-content"><?php echo $post->post_content ?></div>
                <div class="music-content hidden"><?php echo $post->post_content ?></div>
            </div>
        </div>

        <?php if (isset($post->post_youtube) && $post->post_youtube != ''): ?>
            <?php
            if ($post->post_mv_type == 0){
                $arr_keyvalue = Common::multiExplode(array('?', '&'), $post->post_youtube);
                $yt_video_ids = Common::pairsKeyValue($arr_keyvalue, '=');
            } else {
                $yt_video_ids = $post->post_youtube;
            }
            ?>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="video-container center-block">
                        <div class="yt-rel-holder container">
                            <div class="close close-yt-rel"><i class="fa fa-times-circle"></i></div>
                            <?php
                            $model = Post::model()->multilang()->get_post_random($post->id, $post->post_type, 4)->findAll();
                            $this->renderPartial('../_line/_l_yt_relation', array(
                                'model' => $model,
                                'this_lang' => $this->lang,
                                'lang' => $lang
                                    ), false, true);
                            ?>
                        </div>
                        <?php if ($post->post_mv_type == 0): ?>
                        <div id="yt-player"></div>
                        <?php else: ?>
                        <iframe id="yt-player" src="//player.vimeo.com/video/<?php echo $yt_video_ids?>?autoplay=1" width="630" height="354" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                        <?php endif; ?>
                    </div>
                    <div id="timer"></div>
                    <?php
                    $this->widget('SocialNetwork', array(
                        'type' => 'social-youtube',
                        'data_href' => $share_url,
                        'title' => $title,
                        'image_url' => $image_url,
                        'description' => $description,
                    ));
                    ?>
                </div>
                <div class="col-md-2"></div>
            </div>
        <?php endif; ?>

        <div class="row info-detail">
            <?php if ($post->from != ''): ?>
                <div class="col-md-6 col-md-offset-1">
                    <table style="width: 100%">
                        <tr>
                            <td valign="top" class="v-about" width="100"><span><?php echo Common::t('Biography', 'translate') ?></span></td>
                            <td align="left">
                                <?php echo Common::t('Name', 'translate') ?>: <?php echo $post->quote_author ?><br/>
                                <?php echo $post->from ?>
                            </td>
                        </tr>
                    </table>
                </div>
            <?php endif; ?>

            <?php if ($post->about != ''): ?>
                <div class="col-md-6 col-md-offset-1">
                    <table style="width: 100%">
                        <tr>
                            <td valign="top" class="v-about" width="100"><span><?php echo Common::t('About', 'translate') ?></span></td>
                            <td>
                                <span><?php echo $post->about ?></span>
                            </td>
                        </tr>
                    </table>
                </div>
            <?php endif; ?>

            <?php if ($arr_tags != NULL): ?>
                <div class="col-md-6 col-md-offset-1">
                    <table style="width: 100%">
                        <tr>
                            <td valign="top" class="v-topics" width="100"><span><?php echo Common::t('Topics', 'translate') ?></span></td>
                            <td>
                                <span><?php echo isset($arr_tags) ? join($arr_tags, '') : '' ?></span>
                            </td>
                        </tr>
                    </table>
                </div>
            <?php endif; ?>
        </div>

        <!--trans-->
        <div class="row info-detail hidden">
            <?php if ($model_line->from != ''): ?>
                <div class="col-md-6 col-md-offset-1">
                    <table style="width: 100%">
                        <tr>
                            <td valign="top" class="v-about" width="100"><span><?php echo Common::t('Biography', 'translate', NULL, $lang) ?></span></td>
                            <td align="left">
                                <?php echo Common::t('Name', 'translate', NULL, $lang) ?>: <?php echo $post->quote_author ?><br/>
                                <?php echo $model_line->from ?>
                            </td>
                        </tr>
                    </table>
                </div>
            <?php endif; ?>

            <?php if ($model_line->about != ''): ?>
                <div class="col-md-6 col-md-offset-1">
                    <table style="width: 100%">
                        <tr>
                            <td valign="top" class="v-about" width="100"><span><?php echo Common::t('About', 'translate', NULL, $lang) ?></span></td>
                            <td>
                                <span><?php echo $model_line->about ?></span>
                            </td>
                        </tr>
                    </table>
                </div>
            <?php endif; ?>

            <?php if ($arr_trans_tags != NULL): ?>
                <div class="col-md-6 col-md-offset-1">
                    <table style="width: 100%">
                        <tr>
                            <td valign="top" class="v-topics" width="100"><span><?php echo Common::t('Topics', 'translate', NULL, $lang) ?></span></td>
                            <td>
                                <span><?php echo isset($arr_trans_tags) ? join($arr_trans_tags, '') : '' ?></span>
                            </td>
                        </tr>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php $next_video = array(); ?>
<?php if ($tags != NULL): ?>
    <?php $relation_post = Post::model()->localized($this->lang)->get_relation_post_by_term($tags[0]->term_taxonomy_id, $post->id, $post->post_type, 3)->findAll(); ?>
    <div class="row dashed"></div>
    <div class="row relation-holder">
        <div class="container relation-list">
            <?php foreach ($relation_post as $re): ?>
                <div class="col-md-4">
                    <div class="rel-entry">
                        <?php $re_image_entry = ($re->image != '') ? $re->image : '0.jpg'; ?>
                        <a href="<?php echo Yii::app()->createUrl($re->post_type . '/show', array('slug' => $re->slug)) ?>">
                            <img src="<?php echo Yii::app()->baseUrl ?>/images/<?php echo $re->post_type ?>/<?php echo $re_image_entry ?>" class="img-responsive">
                            <div class="rel-title-holder">
                                <div class="rel-title">
                                    <?php echo $re->post_title ?>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

<?php else: ?>
    <?php $relation_post = Post::model()->localized($this->lang)->get_post_random($post->id, $post->post_type, 3)->findAll(); ?>
    <div class="row dashed"></div>
    <div class="row relation-holder">
        <div class="container relation-list">
            <?php foreach ($relation_post as $re): ?>
                <div class="col-md-4">
                    <div class="rel-entry">
                        <?php $re_image_entry = ($re->image != '') ? $re->image : '0.jpg'; ?>
                        <?php $next_video[] = Yii::app()->createUrl($re->post_type . '/show', array('slug' => $re->slug)); ?>
                        <a href="<?php echo Yii::app()->createUrl($re->post_type . '/show', array('slug' => $re->slug)) ?>">
                            <img src="<?php echo Yii::app()->baseUrl ?>/images/<?php echo $re->post_type ?>/<?php echo $re_image_entry ?>" class="img-responsive">
                            <div class="rel-title-holder">
                                <div class="rel-title">
                                    <?php echo $re->post_title ?>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

<?php endif; ?>

<?php

$v_id = isset($yt_video_ids['v']) ? $yt_video_ids['v'] : '';
$v_s = isset($yt_video_ids['start']) ? $yt_video_ids['start'] : 0;
$v_e = isset($yt_video_ids['end']) ? $yt_video_ids['end'] : 0;
$post_id = $post->id;
$post_type = $post->post_type;

$script = <<< EOD

$(function(){
    $('.trans-show-btn').on('click', function(){
        $('.music-text').toggleClass('hidden');
        $('.s-quote-top').toggleClass('hidden');
        $('.by-author').toggleClass('hidden');
        $('.music-content').toggleClass('hidden');
        $('.info-detail').toggleClass('hidden');
        $('.yt-popup-info').toggleClass('hidden');
        $('.relation-list').toggleClass('hidden');
    });
    //
});
function loadAnotherVideo() {
    var data = {id: $post_id, type: '$post_type'};
    $.ajax({
        url: "<?php echo Yii::app()->createUrl('loadMore') ?>",
        type: 'post',
        data: data,
        success: function(html) {
            $('.yt-rel-holder').html(html);
        }
    });
}
EOD;
Yii::app()->clientScript->registerScript('trans-music-' . rand(), $script, CClientScript::POS_END);
?>

<?php if ($post->post_mv_type == 0): ?>
<script>
    var next_vid = <?php echo json_encode($next_video) ?>;
    // 2. This code loads the IFrame Player API code asynchronously.
    var tag = document.createElement('script');

    tag.src = "//www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    // 3. This function creates an <iframe> (and YouTube player)
    //    after the API code downloads.
    var player;
    function onYouTubeIframeAPIReady() {
        player = new YT.Player('yt-player', {
            videoId: '<?php echo $v_id ?>',
            playerVars: {'wmode': 'transparent', 'rel': 0, 'start': '<?php echo $v_s  ?>', 'end': '<?php echo $v_e ?>'},
            events: {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
            }
        });
    }

    // 4. The API will call this function when the video player is ready.
    function onPlayerReady(event) {
        if(typeof window.orientation == 'undefined'){
            event.target.playVideo();
	} else { 
            player.addEventListener('onStateChange', function(e) {
                console.log('State is:', e.data);
            });
        }
    }

    // 5. The API calls this function when the player's state changes.
    var done = false;
    function onPlayerStateChange(event) {
        //
        if (event.data == YT.PlayerState.PLAYING) {
            $('.yt-rel-holder').hide();
        }
        //
        if (event.data == YT.PlayerState.ENDED) {
            $('.yt-rel-holder').show();
            $("#timer").countdown360({
                radius: 60,
                seconds: 10,
                fontColor: '#333',
                strokeStyle: '#ffda39',
//                fillStyle: "#ffdf53",
                fillStyle: "transparent",
                label: '',
                autostart: false,
                onComplete: function () {
                    var next = next_vid[Math.floor(Math.random() * next_vid.length)];
                    location.href = next;
                }
            }).start()
        }
    }
    //
</script>
<?php endif; ?>