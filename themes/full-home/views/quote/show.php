<?php
$this->pageTitle = $post->post_title . ' | ' . Common::t('Quote') . ' | ' . Yii::app()->name;

$avatar = ($post->post_by->image != '') ? $post->post_by->image : 'avatar.png';
$image_entry = ($post->image != '') ? $post->image : 'no-image.png';

// social network
$share_url = Yii::app()->params['siteUrl'] . '/quote/' . $post->slug;
//$title = $post->post_title;
$title = Common::t('Quote') . ' ' . Common::t('By', 'translate') . ' ' . $post->quote_author .  ' | ' . Yii::app()->name;
//$image_url = Yii::app()->params['siteUrl'] . '/images/quote/' . $image_entry;

$filename = $post->post_type . '-' . $image_entry;
$filename_path = Yii::app()->params['set_image_path'] . 'thumb/' . $filename;
if (file_exists($filename_path) === FALSE){
   Yii::app()->curl->get(Yii::app()->params['siteUrl'] . '/thumb', array('im' => $image_entry, 'tp' => $post->post_type));
}
$image_url = Yii::app()->params['siteUrl'] . '/images/thumb/' . $filename;

$description = $post->post_content;

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
            <div><img src="<?php echo Yii::app()->theme->baseUrl ?>/img/quote-r-16.png"/><?php echo $post->post_content ?></div>
        </div>
        <div class="music-text hidden">
            <div><img src="<?php echo Yii::app()->theme->baseUrl ?>/img/quote-r-16.png"/><?php echo $model_line->post_content ?></div>
        </div>
    </div>
</div>

<div class="row show-content">
    <div class="col-md-12">

        <div class="row">
            <div class="col-md-12">
                <div class="s-quote center-block"><?php echo $post->post_content ?></div>
                <div class="s-quote center-block hidden"><?php echo $model_line->post_content ?></div>
            </div>
            <div class="col-md-12">
                <div class="by-author center-block"><span><?php echo Common::t('By', 'translate') ?> <?php echo $post->quote_author ?></span> &nbsp;<a href="javascript:void(0)" class="trans-show-btn"><i class="glyphicon glyphicon-globe"></i></a>&nbsp;
                    <?php $soundtrack = Yii::app()->params['set_quote_sound_path'] . $post->soundtrack; ?>
                    <?php if ($post->soundtrack != '' && file_exists($soundtrack)): ?>
                        <a href="javascript:void(0)" class="jp-play" data-url="<?php echo Yii::app()->params['siteUrl'] . '/' . Yii::app()->params['set_quote_sound_path'] . $post->soundtrack ?>"><i class="fa fa-m-audio-14"></i></a>
                    <?php endif; ?></div>

                <div class="by-author center-block hidden"><span><?php echo Common::t('By', 'translate', NULL, $lang) ?> <?php echo $post->quote_author ?></span> &nbsp;<a href="javascript:void(0)" class="trans-show-btn"><i class="glyphicon glyphicon-globe"></i></a>&nbsp;
                    <?php $soundtrack = Yii::app()->params['set_quote_sound_path'] . $model_line->soundtrack; ?>
                    <?php if ($model_line->soundtrack != '' && file_exists($soundtrack)): ?>
                        <a href="javascript:void(0)" class="jp-play" data-url="<?php echo Yii::app()->params['siteUrl'] . '/' . Yii::app()->params['set_quote_sound_path'] . $model_line->soundtrack ?>"><i class="fa fa-m-audio-14"></i></a>
                    <?php endif; ?></div>
            </div>
        </div>

        <?php if (isset($post->post_youtube) && $post->post_youtube != ''): ?>
            <?php
            $arr_keyvalue = Common::multiExplode(array('?', '&'), $post->post_youtube);
            $yt_video_ids = Common::pairsKeyValue($arr_keyvalue, '=');
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
                        <div id="yt-player"></div>
                    </div>
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

<?php if ($tags != NULL): ?>
    <div class="row dashed"></div>
    <div class="row relation-holder">

        <?php $relation_post = Post::model()->multilang()->get_relation_post_by_term($tags[0]->term_taxonomy_id, $post->id, $post->post_type, 3)->findAll(); ?>
        <div class="container relation-list">
            <?php foreach ($relation_post as $re): ?>
                <div class="col-md-4">
                    <div class="rel-entry">
                        <?php $re_image_entry = ($re->image != '') ? $re->image : '0.jpg'; ?>
                        <a href="<?php echo Yii::app()->createUrl($re->post_type . '/show', array('slug' => $re->slug)) ?>">
                            <img src="<?php echo Yii::app()->baseUrl ?>/images/<?php echo $re->post_type ?>/<?php echo $re_image_entry ?>" class="img-responsive">
                            <div class="rel-title-holder">
                                <div class="rel-title">
                                    <?php echo $re->{$post_content} ?>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="container relation-list hidden">
            <?php foreach ($relation_post as $re): ?>
                <div class="col-md-4">
                    <div class="rel-entry">
                        <?php $re_image_entry = ($re->image != '') ? $re->image : '0.jpg'; ?>
                        <a href="<?php echo Yii::app()->createUrl($re->post_type . '/show', array('slug' => $re->slug)) ?>">
                            <img src="<?php echo Yii::app()->baseUrl ?>/images/<?php echo $re->post_type ?>/<?php echo $re_image_entry ?>" class="img-responsive">
                            <div class="rel-title-holder">
                                <div class="rel-title">
                                    <?php echo $re->{$trans_post_content} ?>
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
$script = <<< EOD

$(function(){
    $('.trans-show-btn').on('click', function(){
        $('.music-text').toggleClass('hidden');
        $('.s-quote').toggleClass('hidden');
        $('.s-quote-top').toggleClass('hidden');
        $('.by-author').toggleClass('hidden');
        $('.info-detail').toggleClass('hidden');
        $('.yt-popup-info').toggleClass('hidden');
        $('.relation-list').toggleClass('hidden');
    });
    //
});
$(document).ready(function() {
    $("#jquery_jplayer").jPlayer("destroy");
    $("#jquery_jplayer").jPlayer({
        ready: function(event) { // The $.jPlayer.event.ready event
            \$this = $(this);
            //
            $('.jp-play').on('click', function(e) {
                e.preventDefault();
                var mp3_url = $(this).data('url');
                //
                \$this.jPlayer("setMedia", {// Set the media
                    mp3: mp3_url
                }).jPlayer("play", event.jPlayer.status.currentTime); // Attempt to auto play the media
            });
            //
            $('.jp-pause').on('click', function(e) {
            });
        },
        ended: function() { // The $.jPlayer.event.ended event
        },
        supplied: "mp3",
        wmode: "window",
        size: {
            width: "0",
            height: "0"
        },
        cssSelector: {
            play: '.jp-play',
            pause: '.jp-pause',
            stop: '.jp-stop'
        },
        errorAlerts: false,
        warningAlerts: false
    });
});
EOD;
Yii::app()->clientScript->registerScript('trans-quote-' . rand(), $script, CClientScript::POS_END);
?>

<script>
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
            videoId: '<?php echo isset($yt_video_ids['v']) ? $yt_video_ids['v'] : '' ?>',
            playerVars: {'autoplay': 1, 'wmode': 'transparent', 'rel': 0, 'start': '<?php echo isset($yt_video_ids['start']) ? $yt_video_ids['start'] : 0  ?>', 'end': '<?php echo isset($yt_video_ids['end']) ? $yt_video_ids['end'] : 0  ?>'},
            events: {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
            }
        });
    }

    // 4. The API will call this function when the video player is ready.
    function onPlayerReady(event) {
        event.target.playVideo();
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
        }
    }
    //
    function loadAnotherVideo() {
        var data = {id: <?php echo $post->id ?>, type: '<?php echo $post->post_type ?>'};
        $.ajax({
            url: "<?php echo Yii::app()->createUrl('loadMore') ?>",
            type: 'post',
            data: data,
            success: function(html) {
                $('.yt-rel-holder').html(html);
            }
        });
    }
</script>