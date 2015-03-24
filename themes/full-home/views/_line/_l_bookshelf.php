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
<?php $image_cover = ($row->cover != '') ? $row->cover : '0.jpg'; ?>

<ul class="bk-list clearfix" id="bk-list">
    <li class="trans-book" id="main-lang-id-<?php echo $row->id ?>">
        <div class="bk-book book-1 bk-bookdefault">
            <div class="bk-front">
                <div class="bk-cover bk-bookview" data-trans-id="<?php echo $row->id ?>">
                    <a class="pl-icon-cover" href="<?php echo Yii::app()->createUrl($row->post_type . '/show', array('slug' => $row->slug)) ?>"><i class="fa fa-play fa-2x"></i></a>
                    <?php if($row->cover != ''): ?>
                        <img alt="<?php echo $row->post_title ?>" src="<?php echo Yii::app()->baseUrl ?>/images/<?php echo $row->post_type ?>/<?php echo $image_cover ?>" class="img-responsive">
                    <?php else: ?>
                        <h2>
                            <span><?php echo $row->quote_author ?></span>
                            <span><?php echo $row->post_title ?></span>
                        </h2>
                    <?php endif; ?>
                </div>
                <div class="bk-cover-back"></div>
            </div>
            <div class="bk-page">
                <div class="bk-content bk-content-current bk-holder">
                    <div class="pull-left bk-info-holder">
                        <div class="col-md-12 author">
                            <img src="<?php echo Yii::app()->baseUrl ?>/images/<?php echo $row->post_type ?>/<?php echo $image_entry ?>" class="img-responsive center-block" alt="<?php echo $row->quote_author ?>" title="<?php echo $row->quote_author ?>">
                        </div>
                        <div class="col-md-12 bk-excerpt">
                            <?php echo $row->post_excerpt ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bk-back">
            </div>
            <div class="bk-right"></div>
            <div class="bk-left">
            </div>
            <div class="bk-top"></div>
            <div class="bk-bottom"></div>
        </div>
        <div class="bk-info">
            <button class="bk-booktrans" data-trans-id="<?php echo $row->id ?>"><i class="fa fa-globe"></i></button>
            <a href="<?php echo Yii::app()->createUrl($row->post_type . '/show', array('slug' => $row->slug)) ?>"><button><i class="fa fa-play"></i></button></a>
        </div>
    </li>
    
    <?php $model_line = Post::model()->localized($lang)->findByPk((int) $row->id); ?>
    <?php $image_cover = ($model_line->cover != '') ? $model_line->cover : '0.jpg'; ?>
    <li class="trans-book-back hide" id="trans-id-<?php echo $row->id ?>">
        <div class="bk-book book-1 bk-bookdefault">
            <div class="bk-front">
                <div class="bk-cover bk-bookview" data-trans-id="<?php echo $row->id ?>">
                    <a class="pl-icon-cover" href="<?php echo Yii::app()->createUrl($row->post_type . '/show', array('slug' => $row->slug)) ?>"><i class="fa fa-play fa-2x"></i></a>
                    <?php if($row->cover != ''): ?>
                        <img alt="<?php echo $model_line->post_title ?>" src="<?php echo Yii::app()->baseUrl ?>/images/<?php echo $row->post_type ?>/<?php echo $image_cover ?>" class="img-responsive">
                    <?php else: ?>
                        <h2>
                            <span><?php echo $row->quote_author ?></span>
                            <span><?php echo $model_line->post_title ?></span>
                        </h2>
                    <?php endif; ?>
                </div>
                <div class="bk-cover-back"></div>
            </div>
            <div class="bk-page">
                <div class="bk-content bk-content-current bk-holder">
                    <div class="pull-left bk-info-holder">
                        <div class="col-md-12 author">
                            <img src="<?php echo Yii::app()->baseUrl ?>/images/<?php echo $row->post_type ?>/<?php echo $image_entry ?>" class="img-responsive center-block" alt="<?php echo $row->quote_author ?>" title="<?php echo $row->quote_author ?>">
                        </div>
                        <div class="col-md-12 bk-excerpt">
                            <?php echo $row->post_excerpt ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bk-back">
            </div>
            <div class="bk-right"></div>
            <div class="bk-left">
            </div>
            <div class="bk-top"></div>
            <div class="bk-bottom"></div>
        </div>
        <div class="bk-info">
            <button class="bk-booktrans-back" data-trans-id="<?php echo $row->id ?>"><i class="fa fa-globe"></i></button>
            <a href="<?php echo Yii::app()->createUrl($row->post_type . '/show', array('slug' => $model_line->slug, 'language' => $lang)) ?>"><button><i class="fa fa-play"></i></button></a>
        </div>
    </li>
   
</ul>

<?php
$script = <<< EOD
$(function() {
//    var opened = false;
//    var flip = false;
//    $('.bk-book').on('click', function(){
//
//        // close all books
//        $('.bk-book').each(function(){
//            if($(this).hasClass('bk-viewinside')){
//                $(this).removeClass('bk-viewinside').addClass('bk-bookdefault');
//            }
//        });
//
//        if (opened == false) {
//            // open current book
//            $(this).removeClass('bk-bookdefault').addClass('bk-viewinside');
//            opened = true;
//            flip = true;
//        } else{
//            if (flip){
//                $(this).removeClass('bk-viewinside').addClass('bk-bookdefault');
//                opened = false;
//                flip = false;
//            }
//        }
//    });
        
    $('.bk-booktrans').on('click', function(){
       var id = $(this).data('trans-id'); 
        $('#main-lang-id-' + id).addClass('hide');
        $('#trans-id-' + id).removeClass('hide');
        return false;
    });
    //
    $('.bk-booktrans-back').on('click', function() {
        var id = $(this).data('trans-id');
        $('#trans-id-' + id).addClass('hide');
        $('#main-lang-id-' + id).removeClass('hide');
        return false;
    });
});
EOD;

Yii::app()->clientScript->registerScript('books', $script, CClientScript::POS_END);
?>
