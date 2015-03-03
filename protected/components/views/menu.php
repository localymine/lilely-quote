<?php
$controller = Yii::app()->controller->id;
$action = Yii::app()->controller->action->id;
$banner = Slide::model()->load_banner()->find();
$back_url = Yii::app()->createUrl('home');
?>

<?php if (in_array($controller, array('home'))): ?>
<?php if(isset($banner) && $banner != NULL): ?>
<style>
    #subscribe{
        position: absolute;
        right: 0;
    }
    .show-content{
        margin-top: <?php echo $banner->css ?>px;
    }
    #top-navbar{
        height: <?php echo $banner->css ?>px;
    }
    #top-navbar .container .banner{
        padding: 0 !important;
    }
    @media (max-width: 768px) {
        #top-navbar { height: 0 !important; }
        .show-content{ margin-top: 0 !important; }
    }
</style>
<?php endif; ?>
<?php endif; ?>
<nav id="top-navbar" role="navigation" class="container navbar navbar-fixed-top background-white themed-border-bottom-gray">
    <?php if (in_array($controller, array('home'))): ?>
    <?php if(isset($banner) && $banner != NULL): ?>
    <div class="container hidden-xs"><?php $this->widget('Banner'); ?></div>
    <?php endif; ?>
    <?php endif; ?>
    
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">

        <ul class="nav nav-pills navbar-brand menu-padding">
            <li class="logo">
                <a href="<?php echo $back_url ?>"><img class="img-responsive" src="<?php echo Yii::app()->theme->baseurl ?>/img/logo.png" width="60" /></a>
            </li>
            <li class="dropdown main-menu">
                <a class="main-menu" href="javascript:void(0)">
                    <span><i class="fa fa-bars fa-2x themed-color-reddeep"></i></span>
                    <span class="ll-ui-arrow"></span>
                </a>
            </li>
        </ul>
        <!---->
        <div class="visible-xs hold-subscribe-xs pull-right">
            <a href="javascript:void(0);" id="subscribe" class="subscribe-btn" data-toggle="modal" data-target="#subscribe-modal">
                <i class="fa fa-rss-square fa-2x themed-color-reddeep"></i><div>SUBCRIBE</div>
            </a>
        </div>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="navbar-brand pull-right hidden-xs navbar-brand-subscribe">
        <a href="javascript:void(0);" id="subscribe" class="subscribe-btn" data-toggle="modal" data-target="#subscribe-modal">
            <i class="fa fa-rss-square fa-2x themed-color-reddeep"></i><div>SUBSCRIBE</div>
        </a>
    </div>
    <!--</div>-->
    <!-- /.navbar-collapse -->
    <!-- /.container -->
</nav>

<div aria-hidden="false" role="dialog" id="menu-modal" tabindex="-1" class="modal fade in">
    <div class="">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <div class="top-holder col-md-12">
                    <div class="col-md-2 col-xs-6 col-md-offset-0 top-group-button">
                        <a href="<?php echo Yii::app()->createUrl('quote') ?>" class="btn btn-danger <?php echo $controller == 'quote' ? 'active' : '' ?>" title="quotes"><i class="fa fa-m-quote"></i></a>
                        <a href="<?php echo Yii::app()->createUrl('book') ?>" class="btn btn-danger <?php echo $controller == 'book' ? 'active' : '' ?>" title="books"><i class="fa fa-m-book"></i></a>
                        <a href="<?php echo Yii::app()->createUrl('music') ?>" class="btn btn-danger <?php echo $controller == 'music' ? 'active' : '' ?>" title="music"><i class="fa fa-m-classical-music"></i></a>
                    </div>
                    <div class="col-md-10 col-xs-6 col-md-offset-0 top-search-form">
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
                            <div class="inner-addon right-addon">
                                <?php echo CHtml::textField('kw', (isset($_GET['kw']) ? $_GET['kw'] : ''), array('placeholder' => 'Search...', 'class' => 'form-control top-search')) ?>
                                <i type="submit" class="glyphicon glyphicon-search search" onclick="$('#top-search-form').submit();"></i>
                            </div>
                        </div>
                        <?php $this->endWidget(); ?>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <?php if (isset($model) && $model != NULL): ?>
                            <?php
                            $num_of_topic = count($model);
                            $class_col_li = '';
                            switch (true) {
                                case $num_of_topic <= 16:
                                    $class_col_li = 'col-1';
                                    break;
                                case 16 < $num_of_topic && $num_of_topic <= 32:
                                    $class_col_li = 'col-2';
                                    break;
                                case $num_of_topic > 32:
                                    $class_col_li = 'col-3';
                                    break;
                            }
                            ?>
                            <h2 class="topic">Topics</h2>
                            <ul class="list-topics <?php echo $class_col_li ?>">
                                <?php foreach ($model as $row): ?>
                                    <?php $active_topic_class = ''; ?>
                                    <?php if (isset($_REQUEST['slug'])): ?>
                                        <?php $active_topic_class = $_REQUEST['slug'] == $row->terms->localized($this->lang)->slug ? 'active' : ''; ?>
                                    <?php endif; ?>
                                    <li class="<?php echo $active_topic_class ?>" role="presentation">
                                        <a tabindex="-1" href="<?php echo Yii::app()->createUrl('topic/', array('slug' => $row->terms->localized($this->lang)->slug)) ?>" role="menuitem"><?php echo $row->terms->localized($this->lang)->name ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div aria-hidden="false" aria-labelledby="SubcribeLabel" role="dialog" id="subscribe-modal" tabindex="-1" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="SubcribeLabel">SUBCRIBE</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 title">First one is free... so are the rest. Daily.</div>
                    <div class="col-md-12">
                        <div class="col-md-8">
                            <?php
                            $form = $this->beginWidget('CActiveForm', array(
                                'id' => 'subscribe-form',
                                'action' => Yii::app()->createUrl('subcribe/regist'),
                                'htmlOptions' => array(
                                    'class' => 'form-horizontal',
                            )));
                            ?>
                            <div class="form-group">
                                <div class="col-md-10 col-xs-8 subscribe-email">
                                    <input type="email" id="email" name="email" placeholder="Email Address" class="form-control" />
                                </div>
                                <div class="col-md-2 col-xs-4">
                                    <button type="submit" class="btn btn-danger">I'm In!</button>
                                </div>
                            </div>
                            <?php $this->endWidget(); ?>
                        </div>
                        <div class="col-md-4 center-block hold-social">
                            <div class="col-md-12 title">Lilely on Facebook</div>
                            <div class="col-md-12">
                                <?php
                                $this->widget('SocialNetwork', array(
                                    'type' => 'social-block-item',
                                    'title' => Yii::app()->name,
                                    'data_href' => Yii::app()->params['siteUrl']));
                                ?>
                                <!--<div class="fb-like" data-href="<?php // echo Yii::app()->params['siteUrl']  ?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>-->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">By Submitting above you agree to the Lilely privacy policy.</div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$url_check = Yii::app()->createUrl('subcribe/exists');
$url_regist = Yii::app()->createUrl('subcribe/regist');

$script = <<< EOD

$(function(){
    $('#subscribe-modal').on('shown.bs.modal', function(){
    });
    $('#subscribe-modal').on('hidden.bs.modal',function(){
    });
    //
        
    var form_valid = $('#subscribe-form');

    var validator = form_valid.validate_popover({
        rules: {
            email: {
                email: {
                    required: true,
                    email: true
                },
                remote: {
                    url: '$url_check',
                    type: 'POST',
                    async: false
                }
            }
        },
        showErrors: function(errorMap, errorList) {
            // Clean up any tooltips for valid elements
            $.each(this.validElements(), function(index, element) {
                var \$element = $(element);
                \$element.data("title", "") // Clear the title - there is no error associated anymore
                        .removeClass("error")
                        .tooltip("destroy");
            });
            // Create new tooltips for invalid elements
            $.each(errorList, function(index, error) {
                var \$element = $(error.element);
                \$element.tooltip("destroy") // Destroy any pre-existing tooltip so we can repopulate with new tooltip content
                        .data("title", error.message)
                        .addClass("error")
                        .tooltip(); // Create a new tooltip based on the error messsage we just set in the title
            });
        },
        messages: {
            email: {
                remote: 'Email Exist!'
            }
        },
        submitHandler: function (form) {
            var email = $('#email').val();
            if (email != ''){
                $.ajax({
                    type: 'POST',
                    url: '$url_regist',
                    data: {email: email},
                    before: function(){
                        loader.start();
                    },
                    success: function(res) {
                        if (res == 1) {
                            bootbox.alert('Thank you for applying', function(){
                                $('#modal-subscribe').css('visibility', 'hidden').removeClass('md-effect-13');
                                $('#email').val('');
                            }).find("div.modal-dialog").addClass("largeWidth");
                        }
                        loader.stop();
                    },
                    error: function() {
                        loader.stop();
                    }
                });
            }
            return false;
        }
    });
  
    $('.main-menu').on('click', function(){
        $('#menu-modal').modal('show');
        $('.navbar-brand .main-menu a').addClass('active');
    });
    $('#menu-modal').on('hidden.bs.modal',function(){
        $('.navbar-brand .main-menu a').removeClass('active');
    });
        
});
EOD;
?>

<?php
Yii::app()->clientScript->registerScript('subscribe-' . rand(), $script, CClientScript::POS_END);
?>