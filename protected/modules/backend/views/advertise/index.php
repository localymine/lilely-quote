<?php
/* @var $this TermsController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = "Advertise" . ' | ' . Yii::app()->name;

Common::register('jquery.min.js', 'pro', CClientScript::POS_HEAD);
Common::register_js(Yii::app()->theme->baseUrl . '/js/pages/readyInbox.js', CClientScript::POS_HEAD);
?>

<div class="content-header">
    <div class="header-section">
        <h1>
            <i class="gi gi-brush"></i>Advertise
        </h1>
        <br/>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'export-form',
            'method' => 'post',
            'action' => Yii::app()->createUrl('backend/advertise/export'),
            'enableAjaxValidation' => false,
            'htmlOptions' => array(
                'enctype' => 'multipart/form-data',
                'class' => 'form-horizontal'
            ),
        ));
        ?>
        <div class="form-group">
            <div class="col-md-12">
                <label class="col-md-2" for="recruit-startDate"><h4>Select Date Range</h4></label>
                <div class="col-md-5">
                    <div class="input-group input-daterange" data-date-format="yyyy-mm-dd">
                        <input type="text" id="recruit_startDate" name="Advertise[startDate]" class="form-control text-center" placeholder="From" />
                        <span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
                        <input type="text" id="recruit_endDate" name="Advertise[endDate]" class="form-control text-center" placeholder="To" />
                    </div>
                </div>
                <button class="search btn btn-danger" type="submit">Export <span class="fa fa-share"></span></button>
            </div>
        </div>
        <?php $this->endWidget(); ?>

    </div>
</div>

<div class="block">
    <div class="block-title">
        <h2>Advertise Information</h2>
    </div>
    <div class="table-responsive">
        <table class="table table-vcenter table-striped">
            <thead>
                <tr>
                    <td class="text-center">
                        <input type="checkbox" name="checkbox-all" id="checkbox-all">
                    </td>
                    <td colspan="3">
                        <div class="btn-group btn-group-sm">
                            <a title="" data-toggle="tooltip" class="btn btn-default mark-all-read" href="javascript:void(0)" data-original-title="Mark as Read"><i class="fa fa-flag"></i></a>
                        </div>
                    </td>
                </tr>
            </thead>
            <?php foreach ($posts as $row): ?>
                <tr>
                    <td width="2%" align="center">
                        <label>
                            <span class="badge label-success"><?php echo $row->id ?></span>
                            <input class="recruit-check" type="checkbox" data-postid="<?php echo $row->id ?>" />
                        </label>
                    </td>
                    <td width="96%">
                        <div class="col-md-1">
                            <?php echo $row->create_date ?>
                            <div id="recruit-status-<?php echo $row->id ?>" data-postid="<?php echo $row->id ?>" class="recruit-status">
                                <?php if ($row->status == 0): ?>
                                    <span class="label label-warning animation-pulse">Pendding...</span>
                                <?php else: ?>
                                    <span class="label label-default">Read</span>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="col-md-11">
                            <div class="col-md-4">
                                Company: <?php echo $row->company ?><br/>
                                Name: <?php echo $row->first_name ?> <?php echo $row->last_name ?><br/>
                                Email: <?php echo $row->email ?><br/>
                            </div>
                            <div class="col-md-4">
                                Organization Type: <?php echo Advertise::itemAlias('type', $row->type) ?><br/>
                                <?php $interest = AdvertiseRelation::model()->findAllByAttributes(array('ads_id' => $row->id)) ?>
                                <?php if ($interest != NULL): ?>
                                    Interest in:<br/>
                                    <ul>
                                    <?php foreach ($interest as $item): ?>
                                        <li><?php echo Advertise::itemAlias('interest', $item->interest) ?></li>
                                    <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-4">
                                <?php echo Common::strip_nl_truncate($row->description, 500) ?><br/>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="block-options">
                            <a title="" data-toggle="tooltip" data-postid="<?php echo $row->id ?>" class="view btn btn-alt btn-sm btn-success btn-option" data-original-title="View"><i class="fa fa-exclamation-circle"></i></a>
                            <a title="" data-toggle="tooltip" data-postid="<?php echo $row->id ?>" class="delete btn btn-alt btn-sm btn-danger btn-option" data-original-title="Delete"><i class="fa fa-times"></i></a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
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

<div class="modal fade" tabindex="-1" id="viewModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 id="ads_id" class="modal-title">Advertise</h4>
            </div>
            <div class="modal-body">
                <p>
                    <label class="form-label">Company</label>
                    <span id="company"></span>
                </p>
                <p>
                    <label class="form-label">First Name</label>
                    <span id="first_name"></span>
                </p>
                <p>
                    <label class="form-label">Last Name</label>
                    <span id="last_name"></span>
                </p>
                <p>
                    <label class="form-label">Email</label>
                    <span id="email"></span>
                </p>
                <p>
                    <label class="form-label">Organization Type</label>
                    <span id="type"></span>
                </p>
                <p>
                    <label class="form-label">Are you interest in (check all that apply)</label>
                <p id="interest"></p>
                </p>
                <p>
                    <label class="form-label">Please provide any further details/ask any further questions here </label>
                <p id="description"></p>
                </p>
            </div>
        </div>
    </div>
</div>

<script>$(function(){ ReadyInbox.init(); });</script>
<script>
    var ajaxloader = '<div id="ajaxloader"><i class="ajaxloader fa fa-spinner fa-4x fa-spin text-info"></i></div>';

    $('.mark-all-read').click(function(){
        var count = 0;
        var postid = [];
        $('.recruit-check').each(function(){
            count = $('.recruit-check:checked').length;
            if ($(this).is(':checked')){
                postid.push($(this).data('postid'));
            }
        });
        //
        if (count > 0) {
            var request = $.ajax({
                url: '<?php echo Yii::app()->createUrl('backend/advertise/mark_read') ?>',
                type: 'POST',
                data: {id: postid},
                dataType: 'json',
                beforeSend: function() {
                    $('body').append(ajaxloader);
                },
                success: function(msg) {
                    //
                    $.each(postid, function(index, value){
                        var status_holder = '#recruit-status-' + value + ' span';
                        $(status_holder).removeClass('label-warning animation-pulse').addClass('label-default').html('Read');
                    });
                    $('.recruit-check').prop('checked', false);
                    //
                    $('#ajaxloader').remove();
                },
                error: function() {
                    $('#ajaxloader').remove();
                }
            });
        }
    });

    $("a.view").click(function(e) {
        var postid = $(this).data('postid');
        var request = $.ajax({
            url: '<?php echo Yii::app()->createUrl('backend/advertise/view') ?>',
            type: 'POST',
            data: {id: postid},
            dataType: 'json',
            beforeSend: function() {
                $('body').append(ajaxloader);
            },
            success: function(msg) {
                $('#company').html(msg.company);
                $('#first_name').html(msg.first_name);
                $('#last_name').html(msg.last_name);
                $('#email').html(msg.email);
                $('#type').html(msg.type);
                $('#interest').html(msg.interest);
                $('#description').html(msg.description);
                //
                if(msg.status == 'R'){
                    var status_holder = '#recruit-status-' + postid + ' span';
                    $(status_holder).removeClass('label-warning animation-pulse').addClass('label-default').html('Read');
                }
                //
                $('#viewModal').modal('show');
                $('#ajaxloader').remove();
            },
            error: function() {
                $('#ajaxloader').remove();
            }
        });
    });

    $("a.delete").click(function(e) {
        e.preventDefault();
        if (confirm('Are you sure you want to delete this?\nCan not recover after delete.')) {
            var postid = $(this).data('postid');
            var request = $.ajax({
                url: '<?php echo Yii::app()->createUrl('backend/advertise/delete') ?>',
                type: 'POST',
                data: {id: postid},
                dataType: 'json',
                beforeSend: function() {
                    $('body').append(ajaxloader);
                },
                success: function(msg) {
                    if (msg == 0) {
                        alert('Can not delete.');
                    } else if (msg == 1) {
                        location.href = location.href;
                    }
                    $('#ajaxloader').remove();
                },
                error: function() {
                    $('#ajaxloader').remove();
                }
            });
        }
    });
</script>