<div class="pull-right">
    <?php foreach ($languages as $l => $lang): ?>
        <?php
        $params['language'] = $l;
        $icon_global = CHtml::image(Yii::app()->theme->baseurl . '/img/global.png');
        if ($l === $language) {
            continue;
            echo CHtml::link($icon_global . '<span>' . Common::t($lang, 'translate') . '</span>', $params, array('class' => "lang-btn $l-lang active"));
        } else {
            echo CHtml::link($icon_global . '<span>' . Common::t($lang, 'translate', NULL, $l) . '</span>', $params, array('class' => "lang-btn $l-lang"));
        }
        ?>
    <?php endforeach; ?>
</div>