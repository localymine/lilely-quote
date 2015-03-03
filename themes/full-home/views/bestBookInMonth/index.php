<?php
$this->pageTitle = 'Best Book In Month' . ' | ' . Yii::app()->name;

?>

<div class="gallery show-content">
    <div id="infinite-scroll-story" class="row">
        <?php if ($model_story != '') $this->renderPartial('../_line/_story', array('posts' => $model_story), false); ?>
    </div>
</div>

<?php
$post_url = Yii::app()->createUrl('best-book-in-month');
    
$script = <<< EOD
$(window).scroll(function() {
    if($(window).scrollTop() == $(document).height() - $(window).height()) {
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