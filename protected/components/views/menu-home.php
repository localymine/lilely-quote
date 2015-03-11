<?php
$controller = Yii::app()->controller->id;
$action = Yii::app()->controller->action->id;
$banner = Slide::model()->load_banner()->find();
$back_url = Yii::app()->createUrl('home');
?>


<nav class="navbar navbar-fixed-top background-white new-top-home">
    <div class="top-holder">
        <ul class="nav nav-pills logo-padding navbar-left">
            <li>
                <a href="<?php echo $back_url ?>">
                    <img class="img-responsive" src="<?php echo Yii::app()->theme->baseurl ?>/img/logo.png" />
                </a>
            </li>
        </ul>

        <div class="hold-fnc navbar-left">
            <div class="dropdown drop-topics navbar-left">
                <button class="btn btn-lilely dropdown-toggle btn-topics-st" type="button" id="dropdown-topmenu" data-toggle="dropdown" aria-expanded="true">
                    <span>Topics</span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdown-topmenu">
                    <li><span class="li-all">All Topics</span></li>
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
            </div>
            <div class="categories navbar-left">
                <ul class="nav navbar-nav">
                    <li class="btn-lilely btn-cate-st">
                        <a href="<?php echo Yii::app()->createUrl('quote') ?>">
                            <span>
                                <img src="<?php echo Yii::app()->theme->baseurl ?>/img/quote-w.png" />
                            </span>
                        </a>
                    </li>
                    <li class="btn-lilely btn-cate-st">
                        <a href="<?php echo Yii::app()->createUrl('book') ?>">
                            <span>
                                <img src="<?php echo Yii::app()->theme->baseurl ?>/img/book-w.png" />
                            </span>
                        </a>
                    </li>
                    <li class="btn-lilely btn-cate-st">
                        <a href="<?php echo Yii::app()->createUrl('music') ?>">
                            <span>
                                <img src="<?php echo Yii::app()->theme->baseurl ?>/img/music-w.png" />
                            </span>
                        </a>
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
                        <?php echo CHtml::textField('kw', (isset($_GET['kw']) ? $_GET['kw'] : ''), array('placeholder' => 'Search...', 'class' => 'form-control top-search')) ?>
                        <span>
                            <i type="submit" class="glyphicon glyphicon-search search" onclick="$('#top-search-form').submit();"></i>
                        </span>
                    </div>
                </div>
                <?php $this->endWidget(); ?>
            </div>
            <div class="social-link navbar-left">
                <ul class="nav navbar-nav">
                    <li><div class="join-us">Join Us On</div></li>
                    <li>
                        <a href="#">
                            <img src="<?php echo Yii::app()->theme->baseurl ?>/img/facebook.png" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="<?php echo Yii::app()->theme->baseurl ?>/img/twitter.png" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="<?php echo Yii::app()->theme->baseurl ?>/img/google.png" />
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="lang-link"><?php $this->widget('LanguageSelector') ?></div>
    </div>
</nav>