<?php $image_entry = ($row->image != '') ? $row->image : '0.jpg'; ?>
<?php $image_author = ($row->feature_image != '') ? $row->feature_image : '0.jpg'; ?>
<div class="hslug-mu">
    <a href="<?php echo Yii::app()->createUrl($row->post_type . '/show', array('slug' => $row->slug)) ?>">
        <img alt="<?php echo $row->post_title ?>" src="<?php echo Yii::app()->baseUrl ?>/images/<?php echo $row->post_type ?>/<?php echo $image_entry ?>" class="img-responsive">
        <div class="quote-video-holder">
            <div class="quote-video-play-btn"><i class="fa fa-play-circle-o fa-6x"></i></div>
        </div>
    </a>
</div>
<div class="m-a-quote">
    <div class="pull-left">
        <?php
        $tags = TermRelationships::model()->get_relate_terms($row->id, 'category', 0)->findAll();
        $arr_tags = NULL;
        if ($tags != NULL) {
            foreach ($tags as $tag) {
                $t_tag = $tag->termtaxonomy->terms->localized($this->lang)->name;
//                $arr_tags[] = $t_tag;
                $arr_tags[] = CHtml::link($t_tag, Yii::app()->createUrl('topic', array('slug' => $tag->termtaxonomy->terms->slug)));
            }
        }
        ?>
        <?php if (isset($arr_tags)): ?>
            <div class="hold-hashtag-title">
                <span class="hashtag-title"><?php echo isset($arr_tags) ? (join($arr_tags, ' & ')) : '' ?></span>
            </div>
        <?php endif; ?>
    </div>
    <div class="pull-left">
        <div class="author">
            <img src="<?php echo Yii::app()->baseUrl ?>/images/author/<?php echo $image_author ?>" class="img-responsive" alt="<?php echo $row->quote_author ?>" title="<?php echo $row->quote_author ?>">
        </div>
        <div class="quote">
            <div class="m">
                <img alt="m16" src="<?php echo Yii::app()->theme->baseUrl ?>/img/music-r-16.png"/>
                <a href="<?php echo Yii::app()->createUrl($row->post_type . '/show', array('slug' => $row->slug)) ?>">
                    <?php echo $row->post_title ?>
                </a>
            </div>
            <table class="by-mp">
                <?php if ($row->quote_author != ''): ?>
                <tr>
                    <td class="c1"><span><?php echo Common::t('Composer', 'translate') ?></span></td>
                    <td class="c2"><span><?php echo $row->quote_author ?></span></td>
                </tr>
                <?php endif; ?>
                <?php if ($row->performer != ''): ?>
                <tr>
                    <td class="c1"><span><?php echo Common::t('Performer', 'translate') ?></span></td>
                    <td class="c2"><span><?php echo $row->performer ?></span></td>
                </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>
</div>