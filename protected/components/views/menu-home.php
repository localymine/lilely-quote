<?php
$controller = Yii::app()->controller->id;
$action = Yii::app()->controller->action->id;
$banner = Slide::model()->load_banner()->find();
$back_url = Yii::app()->createUrl('home');
?>


<nav class="container navbar navbar-fixed-top background-white new-top-home">
    <ul class="nav nav-pills navbar-brand menu-padding">
        <li class="logo">
            <a href="<?php echo $back_url ?>"><img class="img-responsive" src="<?php echo Yii::app()->theme->baseurl ?>/img/logo.png" width="60" /></a>
        </li>
    </ul>

    <div class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
            Dropdown
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">

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

    <div><?php $this->widget('LanguageSelector') ?></div>
</nav>