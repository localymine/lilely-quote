<div id="sidebar-wrapper" class="">
    <div class="col-md-12 side-nav-header">
        <div id="top-side-menu">
            <a href="<?php echo Yii::app()->createUrl('quote') ?>" class="btn btn-danger <?php echo $controller == 'quote' ? 'active' : '' ?>" title="quotes"><i class="fa fa-m-quote fa-m-side-nav-p"></i></a>
            <a href="<?php echo Yii::app()->createUrl('book') ?>" class="btn btn-danger <?php echo $controller == 'book' ? 'active' : '' ?>" title="books"><i class="fa fa-m-book fa-m-side-nav-p"></i></a>
            <a href="<?php echo Yii::app()->createUrl('music') ?>" class="btn btn-danger <?php echo $controller == 'music' ? 'active' : '' ?>" title="classical music"><i class="fa fa-m-classical-music fa-m-side-nav-p"></i></a>
            <a id="btn-search" class="btn btn-link pull-right"><i class="fa fa-search fa-rotate-90"></i></a>
        </div>
        <?php
        $form_high_school = $this->beginWidget('CActiveForm', array(
            'id' => 'top-search-form',
            'method' => 'get',
            'action' => Yii::app()->createUrl('search'),
            'htmlOptions' => array(
                'class' => 'inner',
                'role' => 'search',
            )
        ));
        ?>
        <div class="form-group">
            <?php echo CHtml::textField('kw', (isset($_GET['kw']) ? $_GET['kw'] : ''), array('placeholder' => 'Search...', 'class' => 'form-control top-search')) ?>
            
        </div>
        <?php $this->endWidget(); ?>

    </div>
    <div class="col-md-12 j-n-p">
        <strong>Just</strong> <span>Posted</span>
    </div>
    <ul id="sidebar-nav" class="sidebar-nav">
        <?php foreach($model_story as $row): ?>
        <?php // $obj = new Date_Time_Calc($row->post_date, ''); ?>
            <li data-id="<?php echo $row->id ?>">
                <a href="<?php echo Yii::app()->createUrl($row->post_type . '/show', array('slug' => $row->slug)) ?>"><?php echo $row->post_title ?><?php if ($row->post_youtube != ''): ?> <i class="fa fa-play-circle"></i><?php endif; ?></a><span class="time"><?php echo Common::get_time_duration($row->post_date) ?></span>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
<div class="node"></div>

<?php
$post_url = Yii::app()->createUrl('lastest/sidebar');

$script = <<< EOD
$(function() {
        
    $('#btn-search').on('click', function() {
        var f1 = $('#top-search-form');
        f1.animate({
            left: parseInt(f1.css('left'), 0) == 0 ?
                    (-f1.outerWidth() - 10) : 0
        });
    });    
        
    $('#sidebar-nav').slimScroll({
        height: '87.5%',
        wheelStep: 5
    });
    $('#sidebar-nav').slimScroll().bind('slimscroll', function(event, pos){
        if (pos == 'bottom') {
//            $('#sidebar-nav').slimScroll({ scrollBy: '-60px' });
            loader.start();
            var id = $('#sidebar-nav li').last().data('id');
            $.ajax({
                type: 'POST',
                url: "$post_url",
                data: {id: id},
                success: function(html) {
                if(html) {
                    $('#sidebar-nav').append(html);
                    $('#sidebar-nav').slimScroll();
                    loader.stop();
                }
                //        
                loader.stop();
                }
            });
        }
    });
    //
    $('.node').on('click', function(e) {
        e.preventDefault();
        $('#wrapper').toggleClass('toggled');
    });
    //
    //Enable swiping...
    //#top-navbar
    $("#top-navbar").swipe({
        //Generic swipe handler for all directions
        swipe: function(event, direction, distance, duration, fingerCount) {
            $('#wrapper').toggleClass('toggled');
        },
        //Default is 75px, set to 0 for demo so any distance triggers swipe
        threshold: 75
    });

});
EOD;
?>

<?php
Yii::app()->clientScript->registerScript('view-more-' . rand(), $script, CClientScript::POS_END);
?>