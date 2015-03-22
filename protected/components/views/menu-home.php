<?php
$controller = Yii::app()->controller->id;
$action = Yii::app()->controller->action->id;
$banner = Slide::model()->load_banner()->find();
$back_url = Yii::app()->createUrl('home');

$share_url = Yii::app()->params['siteUrl'];
$share_img = Yii::app()->params['siteUrl'] . '/images/logo.png';
$title = Yii::app()->name;
$summary = Common::t('Lilely is a single place to discover, listen and share all the messages uplifting you.', 'translate', NULL, $lang);
?>


<nav class="navbar navbar-fixed-top background-white new-top-home">
    <div class="top-holder">
        <ul class="nav nav-pills logo-padding navbar-left">
            <li>
                <a href="<?php echo $back_url ?>">
                    <img class="img-responsive" alt="Lilely" src="<?php echo Yii::app()->theme->baseurl ?>/img/logo.png" />
                </a>
            </li>
        </ul>

        <div class="hold-fnc navbar-left">
            <div class="dropdown drop-topics navbar-left">
                <button class="btn btn-lilely dropdown-toggle btn-topics-st" type="button" id="dropdown-topmenu" data-toggle="dropdown" data-hover="dropdown" data-delay="500" data-close-others="true" aria-expanded="false">
                    <span><?php echo Common::t('Topics', 'translate', NULL, $lang) ?></span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdown-topmenu">
                    <li><span class="li-all"><?php echo Common::t('All Topics', 'translate', NULL, $lang) ?></span></li>
                    <?php foreach ($model as $row): ?>
                        <?php $active_topic_class = ''; ?>
                        <?php if (isset($_REQUEST['slug'])): ?>
                            <?php $active_topic_class = $_REQUEST['slug'] == $row->slug ? 'active' : ''; ?>
                        <?php endif; ?>
                        <li class="<?php echo $active_topic_class ?>" role="presentation">
                            <a tabindex="-1" href="<?php echo Yii::app()->createUrl('topic/', array('slug' => $row->slug)) ?>" role="menuitem"><?php echo $row->name ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="categories navbar-left">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <button class="btn btn-lilely btn-cate-st dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="500" data-close-others="true" aria-expanded="false" data-href="<?php echo Yii::app()->createUrl('quote') ?>" title="<?php echo Common::t('Quote', 'translate', NULL, $lang) ?>">
                            <span>
                                <i class="fa fa-m-quote"></i>
                                <!--<img class="hov-top-men" alt="<?php echo Common::t('Quote', 'translate', NULL, $lang) ?>" src="<?php echo Yii::app()->theme->baseurl ?>/img/quote-w.png" data-img-d="<?php echo Yii::app()->theme->baseurl ?>/img/quote-w.png" data-img-h="<?php echo Yii::app()->theme->baseurl ?>/img/quote-b.png" />-->
                            </span>
                        </button>
                        <ul class="dropdown-menu cat-group-sub" role="menu">
                            <li><span class="li-all-type"><?php echo Common::t('Quote', 'translate', NULL, $lang) ?></span></li>
                            <?php foreach ($quote_topics as $q_row):?>
                            <li role="presentation">
                                <a class="cat-submenu" tabindex="-1" href="<?php echo Yii::app()->createUrl('topic', array('slug' => $q_row->slug)) ?>"><?php echo $q_row->name ?></a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <button class="btn btn-lilely btn-cate-st dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="500" data-close-others="true" aria-expanded="false" data-href="<?php echo Yii::app()->createUrl('book') ?>" title="<?php echo Common::t('Audiobook', 'translate', NULL, $lang) ?>">
                            <span>
                                 <i class="fa fa-m-book"></i>
                                <!--<img class="hov-top-men" alt="<?php echo Common::t('Audiobook', 'translate', NULL, $lang) ?>" src="<?php echo Yii::app()->theme->baseurl ?>/img/book-w.png" data-img-d="<?php echo Yii::app()->theme->baseurl ?>/img/book-w.png" data-img-h="<?php echo Yii::app()->theme->baseurl ?>/img/book-b.png" />-->
                            </span>
                        </button>
                        <ul class="dropdown-menu cat-group-sub" role="menu">
                            <li><span class="li-all-type"><?php echo Common::t('Audiobook', 'translate', NULL, $lang) ?></span></li>
                            <?php foreach ($book_topics as $b_row):?>
                            <li role="presentation">
                                <a class="cat-submenu" tabindex="-1" href="<?php echo Yii::app()->createUrl('topic', array('slug' => $b_row->slug)) ?>"><?php echo $b_row->name ?></a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <button class="btn btn-lilely btn-cate-st dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="500" data-close-others="true" aria-expanded="false" data-href="<?php echo Yii::app()->createUrl('music') ?>" title="<?php echo Common::t('Music', 'translate', NULL, $lang) ?>">
                            <span>
                                 <i class="fa fa-m-classical-music"></i>
                                <!--<img class="hov-top-men" alt="<?php echo Common::t('Music', 'translate', NULL, $lang) ?>" src="<?php echo Yii::app()->theme->baseurl ?>/img/music-w.png" data-img-d="<?php echo Yii::app()->theme->baseurl ?>/img/music-w.png" data-img-h="<?php echo Yii::app()->theme->baseurl ?>/img/music-b.png" />-->
                            </span>
                        </button>
                        <ul class="dropdown-menu cat-group-sub" role="menu">
                            <li><span class="li-all-type"><?php echo Common::t('Music', 'translate', NULL, $lang) ?></span></li>
                            <?php foreach ($music_topics as $m_row):?>
                            <li role="presentation">
                                <a class="cat-submenu" tabindex="-1" href="<?php echo Yii::app()->createUrl('topic', array('slug' => $m_row->slug)) ?>"><?php echo $m_row->name ?></a>
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
                        <a onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title;?>&amp;p[summary]=<?php echo $summary;?>&amp;p[url]=<?php echo $share_url; ?>&amp;p[images][0]=<?php echo $share_img;?>','sharer','toolbar=0,status=0,width=548,height=325');" href="javascript: void(0)">
                            <img alt="facebook" src="<?php echo Yii::app()->theme->baseurl ?>/img/facebook.png" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img alt="twitter" src="<?php echo Yii::app()->theme->baseurl ?>/img/twitter.png" />
                        </a>
                    </li>
                    <li>
                        <a href="https://plus.google.com/share?url=<?php echo $share_url ?>" onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
                            <img alt="google+" src="<?php echo Yii::app()->theme->baseurl ?>/img/google.png" />
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="lang-link"><?php $this->widget('LanguageSelector') ?></div>
    </div>
</nav>