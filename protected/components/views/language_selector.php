<div class="pull-right">
    <div id="language" class="language"><i class="fa fa-m-global"></i><span><?php echo Common::t($languages[$language], 'translate') ?></span></div>
    <ul id="lang" class="lang">
    <?php foreach ($languages as $l => $lang): ?>
        <?php
        $params['language'] = $l;
        if ($l === $language) :
            continue;
            ?>
        <?php else: ?>
        <li>
            <?php
            echo CHtml::link('<span>' . Common::t($lang, 'translate', NULL, $l) . '</span>', $params, array('class' => "$l-lang"));
            ?>
        </li>
        <?php endif; ?>
    <?php endforeach; ?>
    </ul>
</div>

<?php
$script = <<< EOD
$(document).on('click', function (e) {
    var container = $('.language');
    if (!container.is(e.target) && container.has(e.target).length === 0) {
        $('.lang').slideUp();
    }
});
EOD;
?>

<?php
Yii::app()->clientScript->registerScript('menu-' . rand(), $script, CClientScript::POS_END);
?>