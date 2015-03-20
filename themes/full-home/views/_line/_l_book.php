<?php $image_entry = ($row->cover != '') ? $row->cover : '0.jpg'; ?>
<?php $image_author = ($row->feature_image != '') ? $row->feature_image : '0.jpg'; ?>
<div>
    <a href="<?php echo Yii::app()->createUrl($row->post_type . '/show', array('slug' => $row->slug)) ?>">
        <img alt="<?php echo $row->post_title ?>" src="<?php echo Yii::app()->baseUrl ?>/images/<?php echo $row->post_type ?>/<?php echo $image_entry ?>" class="img-responsive center-block" width="203">
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
            <div class="b">
                <a href="<?php echo Yii::app()->createUrl($row->post_type . '/show', array('slug' => $row->slug)) ?>">
                    <div><?php echo $row->post_title ?></div>
                    <?php // if ($row->post_excerpt != ''): ?>
                        <?php // echo $row->post_excerpt ?>
                    <?php // else: ?>
                        <?php // echo Common::strip_nl_truncate($row->post_content, 150) ?>
                    <?php // endif; ?>
                </a>
            </div>
            <?php if ($row->quote_author != ''): ?>
                <div class="by-author"><?php echo Common::t('By', 'translate') ?> <?php echo $row->quote_author ?></div>
            <?php endif; ?>
        </div>
    </div>
</div>