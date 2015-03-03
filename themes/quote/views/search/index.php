<?php
/* @var $this SearchController */
$this->pageTitle = 'Search' . ' | ' . Yii::app()->name;

// $keyword
?>

<div class="grid-items show-content">
    <div id="infinite-scroll-story" class="row">
        <?php if ($result != '') $this->renderPartial('../_line/_story_1', array('posts' => $result), false); ?>
    </div>
    <?php
    // the pagination widget with some options to mess
    $this->widget('CLinkPager', array(
        'pages' => $pages,
        'currentPage' => $pages->getCurrentPage(),
        'itemCount' => $item_count,
        'pageSize' => $page_size,
        'maxButtonCount' => 5,
        'firstPageCssClass' => 'hidden',
        'firstPageLabel' => '<i class="fa fa-angle-double-left"></i>',
        'previousPageCssClass' => 'control',
        'prevPageLabel' => '<i class="fa fa-angle-left"></i>',
        'nextPageCssClass' => 'control',
        'nextPageLabel' => '<i class="fa fa-angle-right"></i>',
        'lastPageCssClass' => 'hidden',
        'lastPageLabel' => '<i class="fa fa-angle-double-right"></i>',
        'selectedPageCssClass' => 'active',
        'header' => '',
        'htmlOptions' => array('class' => 'pagination'),
    ));
    ?>
</div>