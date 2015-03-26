<?php
$this->pageTitle = 'Topic ' . $_REQUEST['slug'] . ' | ' . Yii::app()->name;

$bk_class = '';
//$post_type = Yii::app()->user->getState('select_topic');
$post_type = isset($_GET['type']) ? $_GET['type'] : 'quote'; 
if (in_array($post_type, array('book'))){
    $bk_class = ' bk-block book-gallery ';
    Common::register_css(Yii::app()->theme->baseUrl . '/js-book/css/component.css');
    Common::register_css(Yii::app()->theme->baseUrl . '/js-book/css/style.css');
}
?>

<div class="gallery show-content">
    <div class="row topic-holder">
        <div class="col-md-12 center-block">
            <div class="topic-title"><?php echo Common::t('Topic', 'translate') ?></div>
            <h1 class="topic-text"><?php echo $term->name ?></h1>
        </div>
    </div>
    
    <div class="gallery show-content">
        <div id="infinite-scroll-story" class="row <?php echo $bk_class ?> ">
            <?php if ($model_story != '') $this->renderPartial('../_line/_story', array('posts' => $model_story), false); ?>
        </div>
    </div>
</div>

<?php
$post_url = Yii::app()->createUrl('topic', array('slug' => $term->slug));
    
$script = <<< EOD
$(window).scroll(function() {

    // var wintop = $(window).scrollTop(), docheight = $(document).height(), winheight = $(window).height();
    // var  scrolltrigger = 70;
    // var scrollPercent = Math.ceil((wintop / (docheight - winheight)) * 100);
        
    if($(window).scrollTop() == $(document).height() - $(window).height()) {
    // if  ( scrollPercent == scrolltrigger) {
        loader.start();
        $.ajax({
        url: "$post_url",
        success: function(html) {
                if(html) {
                    $("#infinite-scroll-story").append(html);
                    loader.stop();
                } else {
                    loader.nomore();
                    loader.stop();
                }
                // reload social button
                FB.XFBML.parse(); // For Facebook button.
                twttr.widgets.load(); // For Twitter button.
                // gapi.plusone.go(); // For Google plus button.
                //        
                loader.stop();
            }
        });
    }
});
EOD;
?>

<?php
Yii::app()->clientScript->registerScript('view-more-by-tag-' . rand(), $script, CClientScript::POS_END);
?>