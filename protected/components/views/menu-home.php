<?php
$controller = Yii::app()->controller->id;
$action = Yii::app()->controller->action->id;
$back_url = Yii::app()->createUrl('home');
$r_type = isset($_REQUEST['type']) ? $_REQUEST['type'] : '';
$r_slug = isset($_REQUEST['slug']) ? $_REQUEST['slug'] : '';

$share_url = Yii::app()->params['siteUrl'];
$share_img = Yii::app()->params['siteUrl'] . '/images/logo.png';
$title = Yii::app()->name;
$summary = Common::t('Lilely is a single place to discover, listen and share all the messages uplifting you.', 'translate', NULL, $lang);
?>


<nav class="navbar navbar-fixed-top background-white border-top" role="navigation">
    <div class="container new-top-home">

        <div class="navbar-header">

            <!--
            <a id="sp-menu" href="sidr">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </a>
            -->
            <a class="navbar-brand logo-padding" href="<?php echo $back_url ?>">
                <img class="img-responsive sm" alt="Lilely" src="<?php echo Yii::app()->theme->baseurl ?>/img/logo.png" />
            </a>
            <div class="sp-lang"><?php $this->widget('LanguageSelector') ?></div>
        </div>

        <div id="navbar" class="top-holder navbar-collapse collapse">

            <div class="hold-fnc navbar-left">
                <div class="dropdown drop-topics navbar-left">
                    <button class="btn btn-lilely dropdown-toggle btn-topics-st" type="button" id="dropdown-topmenu" data-toggle="dropdown" data-delay="500" data-close-others="true" aria-expanded="false">
                        <span><?php echo Common::t('Topics', 'translate', NULL, $lang) ?></span>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu all-topics-me" role="menu" aria-labelledby="dropdown-topmenu">
                        <li>
                            <ul>
                                <li>
                                    <a class="aall" href="<?php echo Yii::app()->createUrl('quote') ?>">
                                        <span class="li-all <?php echo ($controller == 'quote' || $r_type == 'quote') ? 'active' : '' ?>"><?php echo Common::t('Quote', 'translate', NULL, $lang) ?></span>
                                    </a>
                                </li>
                                <?php foreach ($quote_topics as $q_row): ?>
                                    <li role="presentation">
                                        <a class="cat-submenu <?php echo ($r_slug == $q_row->slug && $r_type == 'quote') ? 'active' : '' ?>" tabindex="-1" href="<?php echo Yii::app()->createUrl('topic', array('slug' => $q_row->slug, 'type' => 'quote')) ?>"><?php echo $q_row->name ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                        <li>
                            <ul>
                                <li>
                                    <a class="aall" href="<?php echo Yii::app()->createUrl('book') ?>">
                                        <span class="li-all <?php echo ($controller == 'book' || $r_type == 'book') ? 'active' : '' ?>"><?php echo Common::t('Audiobook', 'translate', NULL, $lang) ?></span>
                                    </a>
                                </li>
                                <?php foreach ($book_topics as $b_row): ?>
                                    <li role="presentation">
                                        <a class="cat-submenu <?php echo ($r_slug == $b_row->slug && $r_type == 'book') ? 'active' : '' ?>" tabindex="-1" href="<?php echo Yii::app()->createUrl('topic', array('slug' => $b_row->slug, 'type' => 'book')) ?>"><?php echo $b_row->name ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                        <li>
                            <ul>
                                <li>
                                    <a class="aall" href="<?php echo Yii::app()->createUrl('music') ?>">
                                        <span class="li-all <?php echo ($controller == 'music' || $r_type == 'music') ? 'active' : '' ?>"><?php echo Common::t('Music', 'translate', NULL, $lang) ?></span>
                                    </a>
                                </li>
                                <?php foreach ($music_topics as $m_row): ?>
                                    <li role="presentation">
                                        <a class="cat-submenu <?php echo ($r_slug == $m_row->slug && $r_type == 'music') ? 'active' : '' ?>" tabindex="-1" href="<?php echo Yii::app()->createUrl('topic', array('slug' => $m_row->slug, 'type' => 'music')) ?>"><?php echo $m_row->name ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="categories navbar-left">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <button class="btn btn-lilely btn-cate-st dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="500" data-close-others="true" aria-expanded="false" data-href="<?php echo Yii::app()->createUrl('quote') ?>" title="<?php echo Common::t('Quote', 'translate', NULL, $lang) ?>">
                                <span>
                                    <i class="fa fa-m-quote <?php echo ($controller == 'quote' || $r_type == 'quote') ? 'active' : '' ?>"></i>
                                </span>
                            </button>
                            <ul class="dropdown-menu cat-group-sub" role="menu">
                                <li><span class="li-all-type"><?php echo Common::t('Quote', 'translate', NULL, $lang) ?></span></li>
                                <?php foreach ($quote_topics as $q_row): ?>
                                    <li role="presentation">
                                        <a class="cat-submenu <?php echo ($r_slug == $q_row->slug && $r_type == 'quote') ? 'active' : '' ?>" tabindex="-1" href="<?php echo Yii::app()->createUrl('topic', array('slug' => $q_row->slug, 'type' => 'quote')) ?>"><?php echo $q_row->name ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <button class="btn btn-lilely btn-cate-st dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="500" data-close-others="true" aria-expanded="false" data-href="<?php echo Yii::app()->createUrl('book') ?>" title="<?php echo Common::t('Audiobook', 'translate', NULL, $lang) ?>">
                                <span>
                                    <i class="fa fa-m-book <?php echo ($controller == 'book' || $r_type == 'book') ? 'active' : '' ?>"></i>
                                </span>
                            </button>
                            <ul class="dropdown-menu cat-group-sub" role="menu">
                                <li><span class="li-all-type"><?php echo Common::t('Audiobook', 'translate', NULL, $lang) ?></span></li>
                                <?php foreach ($book_topics as $b_row): ?>
                                    <li role="presentation">
                                        <a class="cat-submenu <?php echo ($r_slug == $b_row->slug && $r_type == 'book') ? 'active' : '' ?>" tabindex="-1" href="<?php echo Yii::app()->createUrl('topic', array('slug' => $b_row->slug, 'type' => 'book')) ?>"><?php echo $b_row->name ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <button class="btn btn-lilely btn-cate-st dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="500" data-close-others="true" aria-expanded="false" data-href="<?php echo Yii::app()->createUrl('music') ?>" title="<?php echo Common::t('Music', 'translate', NULL, $lang) ?>">
                                <span>
                                    <i class="fa fa-m-classical-music <?php echo ($controller == 'music' || $r_type == 'music') ? 'active' : '' ?>"></i>
                                </span>
                            </button>
                            <ul class="dropdown-menu cat-group-sub" role="menu">
                                <li><span class="li-all-type"><?php echo Common::t('Music', 'translate', NULL, $lang) ?></span></li>
                                <?php foreach ($music_topics as $m_row): ?>
                                    <li role="presentation">
                                        <a class="cat-submenu <?php echo ($r_slug == $m_row->slug && $r_type == 'music') ? 'active' : '' ?>" tabindex="-1" href="<?php echo Yii::app()->createUrl('topic', array('slug' => $m_row->slug, 'type' => 'music')) ?>"><?php echo $m_row->name ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="n-search-form nav navbar-nav">
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
                            <?php echo CHtml::textField('kw', (isset($_GET['kw']) ? $_GET['kw'] : ''), array('placeholder' => Common::t('Search...', 'translate', NULL, $lang), 'class' => 'form-control top-search')) ?>
                            <span>
                                <i class="glyphicon glyphicon-search search" onclick="$('#top-search-form').submit();"></i>
                            </span>
                        </div>
                    </div>
                    <?php $this->endWidget(); ?>
                </div>
                <div class="social-link navbar-left <?php echo $lang ?>">
                    <ul class="nav navbar-nav">
                        <li><div class="join-us"><?php echo Common::t('Join Us On', 'translate', NULL, $lang) ?></div></li>
                        <li>
                            <a onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title; ?>&amp;p[summary]=<?php echo $summary; ?>&amp;p[url]=<?php echo $share_url; ?>&amp;p[images][0]=<?php echo $share_img; ?>', 'sharer', 'toolbar=0,status=0,width=548,height=325');" href="javascript: void(0)">
                                <i class="fa fa-m-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-m-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://plus.google.com/share?url=<?php echo $share_url ?>" onclick="javascript:window.open(this.href,
                                            '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');
                                    return false;">
                                <i class="fa fa-m-google"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="lang-link"><?php $this->widget('LanguageSelector') ?></div>

        </div>

    </div>
</nav>


<div role="navigation" class="navbar navbar-default navbar-fixed-bottom menu-bt">
    <div class="container">
        <div class="navbar-header">

            <a id="sp-menu" href="sidr" class="pull-left menu-bt-btn">
                <button class="navbar-toggle" type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </a>
            <ul class="lst-btn">
                <li>
                    <button class="btn btn-lilely btn-cate-st dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="500" data-close-others="true" aria-expanded="false" data-href="<?php echo Yii::app()->createUrl('quote') ?>" title="<?php echo Common::t('Quote', 'translate', NULL, $lang) ?>">
                        <span class="br-lf">
                            <i class="fa fa-m-quote <?php echo ($controller == 'quote' || $r_type == 'quote') ? 'active' : '' ?>"></i>
                        </span>
                    </button>
                </li>
                <li>
                    <button class="btn btn-lilely btn-cate-st dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="500" data-close-others="true" aria-expanded="false" data-href="<?php echo Yii::app()->createUrl('book') ?>" title="<?php echo Common::t('Audiobook', 'translate', NULL, $lang) ?>">
                        <span class="br-lf">
                            <i class="fa fa-m-book <?php echo ($controller == 'book' || $r_type == 'book') ? 'active' : '' ?>"></i>
                        </span>
                    </button>
                </li>
                <li>
                    <button class="btn btn-lilely btn-cate-st dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="500" data-close-others="true" aria-expanded="false" data-href="<?php echo Yii::app()->createUrl('music') ?>" title="<?php echo Common::t('Music', 'translate', NULL, $lang) ?>">
                        <span>
                            <i class="fa fa-m-classical-music <?php echo ($controller == 'music' || $r_type == 'music') ? 'active' : '' ?>"></i>
                        </span>
                    </button>
                </li>
                <li>
                    <button class="btn btn-lilely btn-cate-st" data-href="#">
                        <span>
                            <i class="glyphicon glyphicon-search search"></i>
                        </span>
                    </button>
                </li>
            </ul>
        </div>

    </div><!--/.container -->
</div>

<div id="sidr" style="display: none;">
    <a class="logo-padding" href="<?php echo $back_url ?>">
        <img width="62" alt="Lilely" src="<?php echo Yii::app()->theme->baseurl ?>/img/logo.png" />
    </a>
    <div class="pull-right" style="margin-top: 15px; margin-right: 15px;">
        <button class="close close-sidr" type="button"><i class="fa fa-times"></i></button>
    </div>
    <ul class="sidebar">
        <li>
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
            <div class="inner-addon right-addon">
                <?php echo CHtml::textField('kw', (isset($_GET['kw']) ? $_GET['kw'] : ''), array('placeholder' => Common::t('Search...', 'translate', NULL, $lang), 'class' => 'form-control top-search')) ?>
                <span>
                    <i class="glyphicon glyphicon-search search" onclick="$('#top-search-form').submit();"></i>
                </span>
            </div>
            <?php $this->endWidget(); ?>
        </li>
        <li>
            <a class="s1" href="<?php echo Yii::app()->createUrl('quote') ?>"><i class="fa fa-m-quote-b <?php echo ($controller == 'quote' || $r_type == 'quote') ? 'active' : '' ?>"></i></a>
            <a class="s2 sidebar-menu" href="javascript:void(0)">
                <i class="fa fa-angle-left sidebar-nav-indicator"></i>
                <?php echo Common::t('Quote', 'translate', NULL, $lang) ?>
            </a>
            <ul>
                <?php foreach ($quote_topics as $q_row): ?>
                    <li>
                        <a class="<?php echo ($r_slug == $q_row->slug && $r_type == 'quote') ? 'active' : '' ?>" tabindex="-1" href="<?php echo Yii::app()->createUrl('topic', array('slug' => $q_row->slug, 'type' => 'quote')) ?>"><?php echo $q_row->name ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>
        <li>
            <a class="s1" href="<?php echo Yii::app()->createUrl('book') ?>"><i class="fa fa-m-book-b <?php echo ($controller == 'book' || $r_type == 'book') ? 'active' : '' ?>"></i></a>
            <a class="s2 sidebar-menu" href="javascript:void(0)">
                <i class="fa fa-angle-left sidebar-nav-indicator"></i>
                <?php echo Common::t('Audiobook', 'translate', NULL, $lang) ?>
            </a>
            <ul>
                <?php foreach ($book_topics as $b_row): ?>
                    <li>
                        <a class="<?php echo ($r_slug == $b_row->slug && $r_type == 'book') ? 'active' : '' ?>" tabindex="-1" href="<?php echo Yii::app()->createUrl('topic', array('slug' => $b_row->slug, 'type' => 'book')) ?>"><?php echo $b_row->name ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>
        <li>
            <a class="s1" href="<?php echo Yii::app()->createUrl('music') ?>"><i class="fa fa-m-classical-music-b <?php echo ($controller == 'music' || $r_type == 'music') ? 'active' : '' ?>"></i></a>
            <a class="s2 sidebar-menu" href="javascript:void(0)">
                <i class="fa fa-angle-left sidebar-nav-indicator"></i>
                <?php echo Common::t('Music', 'translate', NULL, $lang) ?>
            </a>
            <ul>
                <?php foreach ($music_topics as $m_row): ?>
                    <li>
                        <a class="cat-submenu <?php echo ($r_slug == $m_row->slug && $r_type == 'music') ? 'active' : '' ?>" tabindex="-1" href="<?php echo Yii::app()->createUrl('topic', array('slug' => $m_row->slug, 'type' => 'music')) ?>"><?php echo $m_row->name ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>
    </ul>
</div>