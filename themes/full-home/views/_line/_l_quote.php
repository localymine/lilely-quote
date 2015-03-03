<?php 
foreach ($this->languages as $key => $value){
    if ($this->lang != $key) {
        $lang = $key;
        break;
    }
}
?>

<?php $image_entry = ($row->image != '') ? $row->image : '0.jpg'; ?>
<?php $image_author = ($row->feature_image != '') ? $row->feature_image : '0.jpg'; ?>

<div>
    <a href="<?php echo Yii::app()->createUrl($row->post_type . '/show', array('slug' => $row->slug)) ?>">
        <img src="<?php echo Yii::app()->baseUrl ?>/images/<?php echo $row->post_type ?>/<?php echo $image_entry ?>" class="img-responsive">
        <!--<div class="quote-video-holder">-->
            <!--<div class="quote-video-play-btn"><i class="fa fa-play fa-3x"></i></div>-->
        <!--</div>-->
    </a>
</div>
<div class="m-a-quote">
    <div class="pull-left">
        <?php
        $tags = TermRelationships::model()->get_relate_terms($row->id, 'category', 0)->findAll();
        $arr_tags = NULL;
        $arr_trans_tags = NULL;
        $trans_name = 'name_' . $lang;
        $trans_slug = 'slug_' . $lang;
        if ($tags != NULL) {
            foreach ($tags as $tag) {
                $terms = Terms::model()->multilang()->findByPk($tag->term_taxonomy_id);
                $arr_tags[] = CHtml::link($terms->name, Yii::app()->createUrl('topic', array('slug' => $terms->slug)));
                $arr_trans_tags[] = CHtml::link($terms->{$trans_name}, Yii::app()->createUrl('topic', array('slug' => $terms->{$trans_slug}, 'language' => $lang)));
            }
        }
        ?>
        <?php if (isset($arr_tags)): ?>
            <div class="hold-hashtag-title topic-of-<?php echo $row->id ?>">
                <span class="hashtag-title"><?php echo isset($arr_tags) ? (join($arr_tags, ' & ')) : '' ?></span>
            </div>
        <?php endif; ?>
        
        <?php if (isset($arr_trans_tags)): ?>
            <div class="hold-hashtag-title topic-trans-of-<?php echo $row->id ?> hide">
                <span class="hashtag-title"><?php echo isset($arr_trans_tags) ? (join($arr_trans_tags, ' & ')) : '' ?></span>
            </div>
        <?php endif; ?>
        
    </div>
    <div class="pull-left">
        <div class="author">
            <img src="<?php echo Yii::app()->baseUrl ?>/images/author/<?php echo $image_author ?>" class="img-responsive" alt="<?php echo $row->quote_author ?>" title="<?php echo $row->quote_author ?>">
        </div>
        <div class="quote">

            <?php $model_line = Post::model()->localized($lang)->findByPk((int) $row->id); ?>

            <div id="main-lang-id-<?php echo $row->id ?>" class="box-quote">
                <div class="q">
                    <a href="<?php echo Yii::app()->createUrl($row->post_type . '/show', array('slug' => $row->slug)) ?>">
                        <?php echo $row->post_content ?>
                    </a>
                </div>
                
                <?php if ($row->quote_author != ''): ?>
                <div class="by-author"><?php echo Common::t('By', 'translate') ?> <span><?php echo $row->quote_author ?></span></div>
                <?php endif; ?>
                    
                <div class="gr-btn-func">
                    <a href="javascript:void(0)" class="trans-btn" data-trans-id="<?php echo $row->id ?>"><i class="fa fa-globe"></i></a>
                    <?php $soundtrack = Yii::app()->params['set_quote_sound_path'] . $row->soundtrack; ?>
                    <?php if ($row->soundtrack != '' && file_exists($soundtrack)): ?>
                        <a href="javascript:void(0)" class="jp-play" data-url="<?php echo Yii::app()->params['siteUrl'] . '/' . Yii::app()->params['set_quote_sound_path'] . $row->soundtrack ?>"><i class="fa fa-headphones"></i></a>
                        <!--<a href="javascript:void(0)" class="jp-pause"><i class="fa fa-stop"></i></a>-->
                    <?php endif; ?>
                </div>
            </div>

            <?php
            $post_content = 'post_content_' . $lang;
            $slug = 'slug_' . $lang;
            $soundtrack = 'soundtrack_' . $lang;
            ?>
            
            <div id="trans-id-<?php echo $row->id ?>" class="box-trans-quote">
                <div class="q">
                    <a href="<?php echo Yii::app()->createUrl($row->post_type . '/show', array('slug' => $model_line->slug, 'language' => $lang)) ?>">
                        <?php echo $model_line->post_content ?>
                    </a>
                </div>
                
                <?php if ($row->quote_author != ''): ?>
                <div class="by-author"><?php echo Common::t('By', 'translate', NULL, $lang) ?> <span><?php echo $row->quote_author ?></span></div>
                <?php endif; ?>

                <div class="gr-btn-func">
                    <a href="javascript:void(0)" class="trans-back-btn" data-trans-id="<?php echo $row->id ?>"><i class="fa fa-globe"></i></a>
                    <?php $soundtrack_file = Yii::app()->params['set_quote_sound_path'] . $model_line->soundtrack; ?>
                    <?php if ($model_line->soundtrack != '' && file_exists($soundtrack_file)): ?>
                        <a href="javascript:void(0)" class="jp-play" data-url="<?php echo Yii::app()->params['siteUrl'] . '/' . Yii::app()->params['set_quote_sound_path'] . $model_line->soundtrack ?>"><i class="fa fa-headphones"></i></a>
                        <!--<a href="javascript:void(0)" class="jp-pause"><i class="fa fa-stop"></i></a>-->
                    <?php endif; ?>
                </div>
            </div>
            
        </div>
    </div>
</div>

<?php
$script = <<< EOD

$(function(){
    $('.trans-back-btn').on('click', function(){
        var id = $(this).data('trans-id');
        $('#trans-id-' + id).slideUp('fast');
        $('#main-lang-id-' + id).slideDown('fast');
        //
        $('.topic-of-' + id).removeClass('hide');
        $('.topic-trans-of-' + id).addClass('hide');
        return false;
    });
    //
    $('.trans-btn').on('click', function() {
        var id = $(this).data('trans-id');
        $('#main-lang-id-' + id).slideUp('fast');
        $('#trans-id-' + id).slideDown('fast');
        //
        $('.topic-of-' + id).addClass('hide');
        $('.topic-trans-of-' + id).removeClass('hide');
        return false;
    });
    //
});
$(document).ready(function() {
//    $('.jp-pause').hide();
        
//    var \$voice_click = null;
//    var \$this = null;
    $("#jquery_jplayer").jPlayer("destroy");
    $("#jquery_jplayer").jPlayer({
        ready: function(event) { // The $.jPlayer.event.ready event
            \$this = $(this);
            //
            $('.jp-play').on('click', function(e) {
                e.preventDefault();
//                \$voice_click = $(this);
                var mp3_url = $(this).data('url');
                //
//                \$voice_click.hide();
//                \$voice_click.next().show();
                //
                \$this.jPlayer("setMedia", {// Set the media
                    mp3: mp3_url
                }).jPlayer("play", event.jPlayer.status.currentTime); // Attempt to auto play the media
            });
            //
            $('.jp-pause').on('click', function(e) {
//                \$voice_click.show();
//                \$voice_click.next().hide();
//                \$this.jPlayer("pause");
            });
        },
        ended: function() { // The $.jPlayer.event.ended event
//            \$voice_click.show();
//            \$voice_click.next().hide();
//            $(this).jPlayer("play"); // Repeat the media
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