<?php
foreach ($this->languages as $key => $value) {
    if ($this->lang != $key) {
        $lang = $key;
        break;
    }
}
//
$cover = 'cover_' . $this->lang;
$post_content = 'post_content_' . $this->lang;
$post_title = 'post_title_' . $this->lang;

$trans_cover = 'cover_' . $lang;
$trans_post_content = 'post_content_' . $lang;
$trans_post_title = 'post_title_' . $lang;
?>

<?php foreach ($posts as $row): ?>

    <?php
// get topics
    $tags = TermRelationships::model()->get_relate_terms($row->id, 'category', 0)->findAll();
    $arr_tags = NULL;
    if ($tags != NULL) {
        foreach ($tags as $tag) {
            $t_tag = $tag->termtaxonomy->terms->localized($this->lang)->name;
//                        $arr_tags[] = '#' . $t_tag;
            $arr_tags[] = CHtml::link($t_tag, Yii::app()->createUrl('topic', array('slug' => $tag->termtaxonomy->terms->localized($this->lang)->slug)));
        }
    }
    ?>

    <?php if ($row->post_type == 'quote'): ?> <!-- view if quote -->

        <div class="item-holder">
            <div class="item">
                <div class="head quote">
                    <a href="<?php echo Yii::app()->createUrl($row->post_type . '/show', array('slug' => $row->slug)) ?>">
                        <img class="img-responsive" src="<?php echo Yii::app()->baseUrl ?>/images/<?php echo $row->post_type ?>/<?php echo $row->image ?>" />
                    </a>
                </div>
                <div class="body well">
                    <div class="text">
                        <a href="<?php echo Yii::app()->createUrl($row->post_type . '/show', array('slug' => $row->slug)) ?>">
                            <?php echo $row->{$post_content} ?>
                        </a>
                    </div>
                </div>
                <div class="foot well">
                    <div class="r1">
                        <img src="<?php echo Yii::app()->theme->baseUrl ?>/img/quote-r-24.png"/>
                    </div>
                    <div class="r2">
                        <div class="topic"><?php echo Common::t('Topics', 'translate') ?></div>
                        <?php if ($arr_tags != NULL): ?>
                            <div class="topic-link">
                                <?php echo isset($arr_tags) ? join($arr_tags, '') : '' ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

    <?php elseif ($row->post_type == 'music'): ?> <!-- view if not quote -->

        <div class="item-holder">
            <div class="item">
                <div class="head music">
                    <a href="<?php echo Yii::app()->createUrl($row->post_type . '/show', array('slug' => $row->slug)) ?>">
                        <img class="img-responsive" src="<?php echo Yii::app()->baseUrl ?>/images/<?php echo $row->post_type ?>/<?php echo $row->image ?>" />
                    </a>
                </div>
                <div class="body well">
                    <div class="text">
                        <a href="<?php echo Yii::app()->createUrl($row->post_type . '/show', array('slug' => $row->slug)) ?>">
                            <?php echo $row->{$post_title} ?>
                        </a>
                    </div>
                </div>
                <div class="foot well">
                    <div class="r1">
                        <img src="<?php echo Yii::app()->theme->baseUrl ?>/img/music-r-24.png"/>
                    </div>
                    <div class="r2">
                        <div class="topic"><?php echo Common::t('Performer', 'translate') ?></div>
                        <div class="topic-link">
                            <?php echo $row->performer ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php elseif ($row->post_type == 'book'): ?>

        <div class="item-holder">
            <div class="item">
                <div class="head book">
                    <a href="<?php echo Yii::app()->createUrl($row->post_type . '/show', array('slug' => $row->slug)) ?>">
                        <?php if ($row->{$cover} != '' && $row->{$trans_cover} != ''): ?>
                            <img class="img-responsive" src="<?php echo Yii::app()->createUrl('bookArrange', array('b1' => $row->{$cover}, 'b2' => $row->{$trans_cover})) ?>" />
                        <?php else: ?>
                            <img class="img-responsive" src="<?php echo Yii::app()->createUrl('bookArrange', array('b1' => $row->{$cover}, 'b2' => $row->{$cover})) ?>" />
                        <?php endif; ?>
                    </a>
                </div>
                <div class="foot well">
                    <div class="r1">
                        <img src="<?php echo Yii::app()->theme->baseUrl ?>/img/book-r-24.png"/>
                    </div>
                    <div class="r2">
                        <div class="topic"><?php echo Common::t('Topics', 'translate') ?></div>
                        <?php if ($arr_tags != NULL): ?>
                            <div class="topic-link">
                                <?php echo isset($arr_tags) ? join($arr_tags, '') : '' ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

    <?php endif; ?>

<?php endforeach; ?>