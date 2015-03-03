<?php
$this->pageTitle = 'Authors' . ' | ' . Yii::app()->name;

?>

<div class="grid-items show-content">
    <div id="infinite-scroll-story" class="row">
        <?php if ($model_story != '') $this->renderPartial('../_line/_story_1', array('posts' => $model_story), false); ?>
    </div>
</div>

<?php
$post_url = Yii::app()->createUrl('authors');
    
$script = <<< EOD
$(window).scroll(function() {

    var wintop = $(window).scrollTop(), docheight = $(document).height(), winheight = $(window).height();
    var  scrolltrigger = 70;
    var scrollPercent = Math.ceil((wintop / (docheight - winheight)) * 100);
        
//    if($(window).scrollTop() == $(document).height() - $(window).height()) {
    if  ( scrollPercent == scrolltrigger) {
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
Yii::app()->clientScript->registerScript('view-more-best-book-in-month-' . rand(), $script, CClientScript::POS_END);
?>