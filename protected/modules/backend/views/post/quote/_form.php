<?php
/* @var $this TermsController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = ($update == 0) ? ("Add Quote" . ' | ' . Yii::app()->name) : ("Update Quote" . ' | ' . Yii::app()->name);

Common::register('textext.core.css', 'pro/js/jqtextext');
Common::register('textext.plugin.tags.css', 'pro/js/jqtextext');
Common::register('textext.plugin.autocomplete.css', 'pro/js/jqtextext');
Common::register('textext.plugin.focus.css', 'pro/js/jqtextext');
Common::register('textext.plugin.prompt.css', 'pro/js/jqtextext');
Common::register('textext.plugin.arrow.css', 'pro/js/jqtextext');

Common::register('textext.core.js', 'pro/js/jqtextext', CClientScript::POS_HEAD);
Common::register('textext.plugin.tags.js', 'pro/js/jqtextext', CClientScript::POS_HEAD);
Common::register('textext.plugin.autocomplete.js', 'pro/js/jqtextext', CClientScript::POS_HEAD);
Common::register('textext.plugin.suggestions.js', 'pro/js/jqtextext', CClientScript::POS_HEAD);
Common::register('textext.plugin.filter.js', 'pro/js/jqtextext', CClientScript::POS_HEAD);
Common::register('textext.plugin.focus.js', 'pro/js/jqtextext', CClientScript::POS_HEAD);
Common::register('textext.plugin.prompt.js', 'pro/js/jqtextext', CClientScript::POS_HEAD);
Common::register('textext.plugin.ajax.js', 'pro/js/jqtextext', CClientScript::POS_HEAD);
Common::register('textext.plugin.arrow.js', 'pro/js/jqtextext', CClientScript::POS_HEAD);
?>

<div class="content-header">
    <div class="header-section">
        <h1>
            <i class="gi gi-brush"></i>Quotes<br /><small>...</small>
        </h1>
    </div>
</div>

<div class="row">

    <div class="col-md-8">
        <div class="block">
            <div class="block-title">
                <h2><?php echo $form_title; ?></h2>
                <?php if ($update == 1): ?>
                    <div class="block-options pull-right"><a href="<?php echo Yii::app()->createUrl('backend/post/addQuote') ?>" class="btn btn-sm btn-primary">Add New</a></div>
                <?php endif; ?>
            </div>

            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'stories-form',
                'enableAjaxValidation' => false,
                'htmlOptions' => array(
                    'method' => 'post',
                    'enctype' => 'multipart/form-data',
                    'class' => 'form-horizontal form-bordered'
                ),
            ));
            ?>

            <div class="form-group">
                <div class="col-md-12">
                    <?php echo $form->errorSummary($model); ?>
                </div>
            </div>

            <div class="form-group">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <?php
                    foreach (Yii::app()->params['translatedLanguages'] as $l => $lang):
                        if ($l === Yii::app()->params['defaultLanguage']) {
                            $suffix = '';
                            $active = ' active';
                        } else {
                            $suffix = '_' . $l;
                            $active = '';
                        }
                        ?>
                        <li class="<?php echo $active ?>"><a href="#<?php echo $lang ?>" data-toggle="tab"><img src="<?php echo Yii::app()->baseUrl ?>/images/flags/<?php echo $l ?>.png"/></a></li>
                    <?php endforeach; ?>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <?php
                    foreach (Yii::app()->params['translatedLanguages'] as $l => $lang):
                        if ($l === Yii::app()->params['defaultLanguage']) {
                            $suffix = '';
                            $active = ' active';
                        } else {
                            $active = '';
                            $suffix = '_' . $l;
                        }
                        ?>
                        <div class="tab-pane fade in <?php echo $active ?>" id="<?php echo $lang; ?>">

                            <div class="form-group">
                                <label class="col-md-2 control-label">Title</label>
                                <div class="col-md-10">
                                    <?php echo $form->textField($model, 'post_title' . $suffix, array('class' => 'form-control')) ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Slug</label>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <?php echo $form->textField($model, 'slug' . $suffix, array('class' => 'form-control', 'form' => 'stories-form', 'id' => 'slug-' . $lang)) ?>
                                        <span class="input-group-addon"><a class="clear-slug hand" data-slug-id="<?php echo 'slug-' . $lang ?>"><i class="fa fa-times text-danger"></i></a></span>
                                    </div>
                                    <div class="help-block">Auto generate slug when empty</div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-2 control-label">Quote mp3</label>
                                <div class="col-md-8">
                                    <?php echo $form->fileField($model, 'soundtrack' . $suffix, array('class' => '')) ?>
                                </div>
                                <div class="col-md-2">
                                    <?php if ($update == 1): ?>
                                        <?php $soundtrack = 'soundtrack' . $suffix; ?>
                                        <span class="media-<?php echo $l ?>"><?php echo $model->{$soundtrack} ?></span>
                                        <a class="hand remove-media" data-id="<?php echo $model->id ?>" data-lang="<?php echo $l ?>"><i class="fa fa-times text-danger"></i></a>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Movie Information</label>
                                <div class="col-md-7">
                                    <?php echo $form->textField($model, 'post_youtube' . $suffix, array('class' => 'form-control')) ?>
                                    <div class="help-block">ex: v=rN5Z4eifmEg&list=PL4DD121BD11D869B0</div>
                                </div>
                                <div class="col-md-3">
                                    <?php echo $form->dropDownList($model, 'post_mv_type' . $suffix, Post::item_alias('mv_type'), array('class' => 'form-control')) ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Info About the Video</label>
                                <div class="help-block">(about) NOTE ( RECOMMEND,...)</div>
                                <div class="col-md-10">
                                    <?php echo $form->textArea($model, 'about' . $suffix, array('class' => 'form-control basic_editor')) ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Info About the Author</label>
                                <div class="help-block">(from) BIOGRAPHY</div>
                                <div class="col-md-10">
                                    <?php echo $form->textArea($model, 'from' . $suffix, array('class' => 'form-control basic_editor')) ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-offset-1">Quote</label>
                                <div class="col-md-12">
                                    <?php echo $form->textArea($model, 'post_content' . $suffix, array('class' => 'form-control custom_editor')) ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-offset-1">Excerpt</label>
                                <div class="help-block col-md-offset-1">This content will showed on the main page</div>
                                <div class="col-md-12">
                                    <?php echo $form->textArea($model, 'post_excerpt' . $suffix, array('class' => 'form-control custom_editor')) ?>
                                </div>
                            </div>

                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <?php $this->endWidget(); ?>
        </div>
    </div>

    <div class="col-md-4">

        <div class="block clearfix">
            <div class="form-group">
                <label class="control-label">Quote Author</label>
                <div class="col-md-12">
                    <?php echo CHtml::textField('Post[quote_author]', $model->quote_author, array('class' => 'form-control', 'form' => 'stories-form')) ?>
                </div>
            </div>
        </div>

        <div class="block clearfix">
            <div class="form-group">
                <label class="col-md-2 control-label">Image</label>
                <div class="col-md-8">
                    <input type="file" id="Post_image" name="Post[image]" class="" form="stories-form">
                    <div class="help-block">The best image size (recommend): 525 x 324</div>
                </div>
                <div class="col-md-2">
                    <?php echo CHtml::image(Yii::app()->baseUrl . '/images/quote/' . $model->image, '', array('width' => '52')) ?>
                </div>
            </div>
        </div>

        <div class="block clearfix">
            <div class="form-group">
                <label class="col-md-2 control-label">Author Photo</label>
                <div class="col-xs-8">
                    <input type="file" id="Post_feature_image" name="Post[feature_image]" class="" form="stories-form">
                    <div class="help-block">The best image size (recommend): 132 x 132</div>
                </div>
                <div class="col-md-2">
                    <?php echo CHtml::image(Yii::app()->baseUrl . '/images/author/' . $model->feature_image, '', array('width' => '52')) ?>
                </div>
            </div>
        </div>

        <div class="block clearfix">
            <div class="block-title">
                <h2>Categories</h2>
            </div>
            <div class="form-group">
                <div class="lst_category auto">
                    <?php
                    $this->widget('TreeCategory', array(
                        'submit_form' => 'stories-form',
                        'submit_name' => 'Post[category][]',
                        'select' => $select_categories,
                        'show_in' => 'original',
                        'single_select' => true,
                    ))
                    ?>
                </div>
            </div>
        </div>

        <div class="block clearfix">
            <div class="block-title">
                <h2>Enter tags</h2>
            </div>
            <div class="form-group">
                <div class="">
                    <input id="tags_form"/>
                </div>
            </div>
        </div>

        <div class="block">
            <div class="block-title">
                <?php if (!$model->isNewRecord): ?><div class="block-options pull-right">Last Modified: <?php echo $model->post_modified ?></div><?php endif; ?>
                <h2>Publish</h2>
            </div>
            <div class="form-group form-actions">
                <div class="col-md-offset-4 col-xs-offset-4">
                    <?php echo CHtml::submitButton($model->isNewRecord ? 'Add New' : 'Update', array('class' => 'btn btn-sm btn-primary', 'form' => 'stories-form')); ?>
                    <button class="btn btn-sm btn-warning" type="reset" form="stories-form"><i class="fa fa-repeat"></i> Reset</button>
                </div>
            </div>
        </div>

    </div>
</div>

<?php
$script = <<< EOD
window.onload = function() {
        
    $('textarea.basic_editor').each(function(){
        CKEDITOR.replace($(this).attr('id') , {
            customConfig : 'config_basic.js'
        });
    });
    
    $('textarea.custom_editor').each(function(){
        CKEDITOR.replace($(this).attr('id'));
    });
     
//    editor.setData( '<p>Hello world!</p>' );
};
        
var offset = 300;
$(window).scroll(function() {
    if ($(this).scrollTop() > offset) {
        $('.nav.nav-tabs').addClass('fix-lang');
    } else {
        $('.nav.nav-tabs').removeClass('fix-lang');
    }
});
EOD;

Common::register_script('input-form', $script);
?>

<script>

    $('#tags_form').textext({
        plugins: 'tags prompt focus autocomplete ajax arrow',
        tagsItems: <?php echo $tags_json == NULL ? '' : $tags_json ?>,
        prompt: 'add a tag ...',
        html: {hidden: '<input id="Post_tags" name="Post[tags]" type="hidden" form="stories-form" />'},
//        suggestions: ['',''], /* suggestions */
        ajax: {
            url: '<?php echo Yii::app()->createUrl('backend/post/loadTags') ?>',
            dataType: 'json',
            cacheResults: true
        }
    }).bind('isTagAllowed', function (e, data) {

        var formData = $(e.target).siblings('input#Post_tags').val();
        list = eval(formData);

        if (formData.length && list.indexOf(data.tag) >= 0) {
//            var message = [ data.tag, 'is already listed.' ].join(' ');
//            alert(message);
            data.result = false;
        } else {
            var lnhRegex = /^([a-zA-Z0-9 _-]+)$/;
            if ((data.tag).match(lnhRegex)) {
                // valid
                data.result = true;
            } else {
                // invalid
                data.result = false;
            }
        }
    });

    $('.clear-slug').click(function () {
        var id = $(this).data('slug-id');
        $('#' + id).val("");
    });

</script>