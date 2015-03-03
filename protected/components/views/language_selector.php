<!--<div class="pull-right">-->
    <!--<i class="glyphicon glyphicon-globe"></i>--><?php // echo $languages[$language]  ?>
    <?php foreach ($languages as $l => $lang): ?>
        <?php
        $params['language'] = $l;
        if ($l === $language) {
            continue;
            echo CHtml::link('<i class="glyphicon glyphicon-globe"></i>', $params, array('class' => "lang-btn $l-lang active"));
        } else {
            echo CHtml::link('<i class="glyphicon glyphicon-globe"></i>', $params, array('class' => "lang-btn $l-lang"));
        }
        ?>

    <?php endforeach; ?>
<!--</div>-->

<?php
//$script = <<< EOD
//$(function() {
//    var showLang = $('.lang-btn.active');
//    $('.nav-lang').hover(function() {
//        $('.lang-btn').addClass('active');
//    }, function() {
//        $('.lang-btn').removeClass('active');
//        showLang.addClass('active');
//    });
//});
//EOD;
?>

<?php
//Yii::app()->clientScript->registerScript('lang-selector-' . rand(), $script, CClientScript::POS_END);
?>