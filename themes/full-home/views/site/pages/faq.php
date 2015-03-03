<?php
$this->pageTitle = 'FAQ' . ' | ' . Yii::app()->name;

Common::register_js(Yii::app()->baseUrl . '/js/jquery-ui-1.10.4.custom.min.js', CClientScript::POS_END);

$script = <<< EOD
$(function(){
    $('.accordion').accordion();
    $('.faq-ref').click(function(){
        //
        var id = $(this).data('id');
        $('html,body').animate({
            scrollTop: $("#"+id).offset().top},
        'slow');
    });
});
EOD;
Common::register_script('faq-accordion-', $script, CClientScript::POS_END);
?>

<div class="gallery min-height">
    <div class="row">
        <div class="block">
            <div class="btn-group dropdown">
            <button type="button" class="btn btn-default">Frequently Asked Questions (FAQ)</button>
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
              <span class="caret"></span>
              <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu faq-menu" role="menu">
            <?php foreach ($terms as $row): ?>
                <li><a class="hand faq-ref" data-id="<?php echo $row->terms->slug ?>"><?php echo $row->terms->name ?></a></li>
            <?php endforeach; ?>
            </ul>
          </div>
        </div>
    </div>
    <div class="row">
        <div class="block faq-content">
            <?php foreach ($terms as $row): ?>
            <div id="<?php echo $row->terms->slug ?>" class="alert alert-danger">FAQ: <?php echo $row->terms->name ?></div>
                <div class="accordion">
                    <?php $model = Page::model()->get_faq_by_term_id($row->term_id)->findAll() ?>
                    <?php foreach ($model as $element): ?>
                        <h3 class=""><i class="fa fa-check"></i> <?php echo $element->post_title ?></h3>
                        <div><p><?php echo $element->post_content ?></p></div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>