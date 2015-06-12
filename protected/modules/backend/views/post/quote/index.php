<?php
/* @var $this TermsController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = "All Quotes" . ' | ' . Yii::app()->name;

Common::register('jquery.min.js', 'pro', CClientScript::POS_HEAD);
Common::register('jquery-ui-1.10.4.custom.min.js', 'pro', CClientScript::POS_END);
?>

<div class="content-header">
    <div class="header-section">
        <h1>
            <i class="gi gi-brush"></i>All Quotes<br />
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'search-form',
                'method' => 'post',
                'enableAjaxValidation' => false,
                'htmlOptions' => array(
                    'role' => 'search',
                    'enctype' => 'multipart/form-data',
                    'class' => 'form-horizontal'
                ),
            ));
            ?>
            <div class="form-group">
                <div class="col-md-12">
                    <div class="input-group">
                        <input type="text" placeholder="Input keyword..." class="form-control" name="keyword" id="keyword" value="<?php echo $keyword ?>" />
                        <div class="input-group-btn">
                            <button class="search btn btn-danger" type="button">Search <span class="fa fa-search"></span></button>
                        </div>
                    </div>
                </div>
            </div>
            <?php $this->endWidget(); ?>
        </h1>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="block">
            <div class="block-title">
                <h2>List Quotes</h2>
                <a href="<?php echo Yii::app()->createUrl('backend/post/quote') ?>">All</a> | <a href="<?php echo Yii::app()->createUrl('backend/post/quoteHiddenList') ?>">Hidden</a>
                <div class="block-options pull-right"><i class="fa fa-star" style="color:#1BBAE1"></i>Show   <i class="fa fa-star" style="color:#ccc"></i>Hidden</div>
                <div class="table-responsive">

                    <table class="table table-vcenter table-striped">
                        <thead>
                            <tr>
                                <th width="5%">Author</th>
                                <th width="90%">Description</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th width="5%">Author</th>
                                <th width="90%">Description</th>
                                <th>&nbsp;</th>
                            </tr>
                        </tfoot>
                        <tbody id="the-list" class="ui-sortable">
                            <?php foreach ($posts as $row): ?>
                                <tr id="post-<?php echo $row->id ?>">
                                    <td>
                                        <?php
                                        $model_profile = Yii::app()->getModule('user');
                                        $user = $model_profile->user();
                                        ?>
                                        <?php if ($user->profile->image == ''): ?>
                                            <img class="img-circle" width="64" src="<?php echo Yii::app()->baseUrl ?>/avatars/avatar.png"/>
                                        <?php else: ?>
                                            <img class="img-circle" width="64" src="<?php echo Yii::app()->baseUrl ?>/avatars/<?php echo $user->profile->image ?>"/>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="block clearfix <?php echo ($row->disp_flag != 1) ? 'bk-hidden' : '' ?>">
                                            <img align="left" width="126" style="padding:5px" src="<?php echo Yii::app()->baseUrl ?>/images/<?php echo $row->post_type ?>/<?php echo $row->image ?>" />
                                            <div><?php echo $row->post_title ?></div>
                                            <p><?php echo mb_substr(strip_tags($row->post_content), 1, 400) . '...' ?></p>

                                            <?php
                                            $categories = TermRelationships::model()->get_relate_terms($row->id, 'category')->findAll();
                                            $arr_cats = NULL;
                                            if ($categories != NULL) {
                                                foreach ($categories as $cat) {
                                                    $t_name = $cat->termtaxonomy->terms->name;
                                                    $arr_cats[] = $t_name;
                                                }
                                            }
                                            ?>
                                            <div>Categories: <?php echo isset($arr_cats) ? join($arr_cats, ', ') : '' ?></div>

                                            <?php
                                            $tags = TermRelationships::model()->get_relate_terms($row->id, 'tag')->findAll();
                                            $arr_tags = NULL;
                                            if ($tags != NULL) {
                                                foreach ($tags as $tag) {
                                                    $t_tag = $tag->termtaxonomy->terms->name;
                                                    $arr_tags[] = $t_tag;
                                                }
                                            }
                                            ?>
                                            <div>Tags: <?php echo isset($arr_tags) ? join($arr_tags, ', ') : '' ?></div>
                                            <div>Last Modified: <?php echo $row->post_modified ?></div>
                                            <?php
                                            unset($arr_cats);
                                            unset($arr_tags);
                                            ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="block-options">
                                            <a title="" data-toggle="tooltip" data-postid="<?php echo $row->id ?>" class="ordertop btn btn-alt btn-sm btn-success btn-option" data-original-title="Order Top"><i class="fa fa-arrow-up"></i></a>
                                            <a title="" data-toggle="tooltip" data-postid="<?php echo $row->id ?>" class="status btn btn-alt btn-sm btn-default btn-option" data-original-title="Status"><i class="fa fa-star <?php echo ($row->disp_flag == 1) ? 'status-show' : 'status-hide' ?>"></i></a>
                                            <a title="" data-toggle="tooltip" class="btn btn-alt btn-sm btn-default btn-option" href="<?php echo Yii::app()->createUrl('backend/post/updateQuote', array('id' => $row->id)) ?>" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                            <a title="" data-toggle="tooltip" data-postid="<?php echo $row->id ?>" class="delete btn btn-alt btn-sm btn-danger btn-option" data-original-title="Delete"><i class="fa fa-times"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 text-center">
        <?php
        // the pagination widget with some options to mess
        $this->widget('CLinkPager', array(
            'pages' => $pages,
            'currentPage' => $pages->getCurrentPage(),
            'itemCount' => $item_count,
            'pageSize' => $page_size,
            'maxButtonCount' => 5,
            'firstPageCssClass' => '',
            'firstPageLabel' => '<i class="fa fa-angle-double-left"></i>',
            'prevPageLabel' => '<i class="fa fa-angle-left"></i>',
            'nextPageLabel' => '<i class="fa fa-angle-right"></i>',
            'lastPageCssClass' => '',
            'lastPageLabel' => '<i class="fa fa-angle-double-right"></i>',
            'selectedPageCssClass' => 'active',
            'header' => '',
            'htmlOptions' => array('class' => 'pagination pagination-sm'),
        ));
        ?>
    </div>
</div>

<script>
    $(function () {
        var ajaxloader = '<div id="ajaxloader"><i class="ajaxloader fa fa-spinner fa-4x fa-spin text-info"></i></div>';

        $('a.status').click(function (e) {
            e.preventDefault();
            var tap = $(this).children('i');
            var postid = $(this).data('postid');
            var request = $.ajax({
                url: '<?php echo Yii::app()->createUrl('backend/post/statusQuote') ?>',
                type: 'POST',
                data: {id: postid},
                dataType: 'json',
                beforeSend: function () {
                    $('body').append(ajaxloader);
                },
                success: function (msg) {
                    if (msg == 0) {
                        $(tap).removeClass('status-show').addClass('status-hide');
                    } else if (msg == 1) {
                        $(tap).removeClass('status-hide').addClass('status-show');
                    }
                    $('#ajaxloader').remove();
                },
                error: function () {
                    $('#ajaxloader').remove();
                }
            });
        });

        $("a.delete").click(function (e) {
            e.preventDefault();
            if (confirm('Are you sure you want to delete this?\nCan not recover after delete.')) {
                var postid = $(this).data('postid');
                var request = $.ajax({
                    url: '<?php echo Yii::app()->createUrl('backend/post/deleteQuote') ?>',
                    type: 'POST',
                    data: {id: postid},
                    dataType: 'json',
                    beforeSend: function () {
                        $('body').append(ajaxloader);
                    },
                    success: function (msg) {
                        if (msg == 0) {
                            alert('Can not delete.');
                        } else if (msg == 1) {
                            location.href = location.href;
                        }
                        $('#ajaxloader').remove();
                    },
                    error: function () {
                        $('#ajaxloader').remove();
                    }
                });
            }
        });
        
        $("a.ordertop").click(function (e) {
            e.preventDefault();
            var postid = $(this).data('postid');
            $.ajax({
                url: '<?php echo Yii::app()->createUrl('backend/post/orderTop') ?>',
                type: 'POST',
                data: {id: postid, post_type: 'quote'},
                dataType: 'json',
                beforeSend: function () {
                    $('body').append(ajaxloader);
                },
                success: function (msg) {
                    location.href = location.href;
                },
                error: function () {
                    $('#ajaxloader').remove();
                }
            });
        });

        $('.search').click(function (e) {
            e.preventDefault();
            if ($('#keyword').val() != '')
                $('#search-form').submit();
        });

        $('#the-list').sortable({
            'items': 'tr',
            'axis': 'y',
            'helper': fixHelper,
            'update': function (e, ui) {
                $.post('<?php echo Yii::app()->createUrl('backend/post/sortQuote') ?>', {
                    order: $('#the-list').sortable('serialize')
                });
            }
        });

        var fixHelper = function (e, ui) {
            ui.children().children().each(function () {
                $(this).width($(this).width());
            });
            return ui;
        };
    });
</script>