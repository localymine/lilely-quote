<?php
$avatar = (isset(Yii::app()->user->image)) ? (Yii::app()->user->image) : 'avatar.png';
?>
<div class="sidebar-scroll">
    <div class="sidebar-content">
        <a href="<?php echo Yii::app()->createUrl('/backend/dashboard') ?>" class="sidebar-brand">
            <i class="gi gi-wifi_alt"></i><strong>Lilely</strong>Quotes
        </a>
        <div class="sidebar-section sidebar-user clearfix">
            <div class="sidebar-user-avatar">
                <a href="<?php echo Yii::app()->createUrl('/user/profile') ?>">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/avatars/<?php echo $avatar ?>" alt="avatar" />
                </a>
            </div>
            <div class="sidebar-user-name"><?php echo Yii::app()->user->username; ?></div>
            <div class="sidebar-user-links">
                <a href="<?php echo Yii::app()->createUrl('/user/profile') ?>" data-toggle="tooltip" data-placement="bottom" title="Profile"><i class="gi gi-user"></i></a>
                <a href="#modal-user-settings" data-toggle="modal" class="enable-tooltip" data-placement="bottom" title="Settings"><i class="gi gi-cogwheel"></i></a>
                <a href="<?php echo Yii::app()->createUrl('/user/logout') ?>" data-toggle="tooltip" data-placement="bottom" title="Logout"><i class="gi gi-exit"></i></a>
            </div>
        </div>

        <ul class="sidebar-nav">
            <?php if ($admin == 1): ?>
            <!--<li>-->
                <!--<a href="<?php // echo Yii::app()->createUrl('/backend/dashboard') ?>" class="<?php // if ($flags_open[0] == true): ?> active <?php // endif;?>"><i class="gi gi-stopwatch sidebar-nav-icon"></i>Dashboard</a>-->
            <!--</li>-->
            <!--<li>-->
                <!--<a href="<?php // echo Yii::app()->createUrl('/backend/statistics') ?>" class="<?php // if ($flags_open[14] == true): ?> active <?php // endif;?>"><i class="gi gi-charts sidebar-nav-icon"></i>Statistics</a>-->
            <!--</li>-->
            <li>
                <a href="<?php echo Yii::app()->createUrl('/backend/slide') ?>" class="<?php if ($flags_open[5] == true): ?> active <?php endif;?>"><i class="gi gi-film sidebar-nav-icon"></i>Banner</a>
            </li>
            <li>
                <a href="<?php echo Yii::app()->createUrl('/backend/advertise') ?>" class="<?php if ($flags_open[12] == true): ?> active <?php endif;?>"><i class="fa fa-bullhorn sidebar-nav-icon"></i>Advertise</a>
            </li>
            <?php endif; ?>
            
            <li class="sidebar-header">
                <span class="sidebar-header-options clearfix"><i class="fa fa-cog"></i></span>
                <span class="sidebar-header-title"><strong>Management</strong></span>
            </li>
            
            <?php if ($admin == 1): ?>
            <li>
                <a href="<?php echo Yii::app()->createUrl('backend/terms') ?>" class="<?php if ($flags_open[1] == true): ?> active <?php endif;?> "><i class="gi gi-list sidebar-nav-icon"></i>Categories</a>
            </li>
            <li>
                <a href="<?php echo Yii::app()->createUrl('backend/tags') ?>" class="<?php if ($flags_open[4] == true): ?> active <?php endif;?> "><i class="gi gi-tags sidebar-nav-icon"></i>Tags</a>
            </li>
            <li>
                <a href="#" class="sidebar-nav-menu <?php if ($flags_open[10] && $controller == 'page') echo " open bold" ?> "><i class="fa fa-angle-left sidebar-nav-indicator"></i><i class="fa fa-puzzle-piece sidebar-nav-icon"></i>Static Pages</a>
                <ul <?php if ($flags_open[10] && $controller == 'page') echo ' style="display:block;" ' ?> >
                    <li>
                        <a class="<?php if ($flags_open[10] && $flags_active[0]) echo " active " ?>" href="<?php echo Yii::app()->createUrl('backend/page') ?>">All Pages</a>
                    </li>
                    <li>
                        <a class="<?php if ($flags_open[10] && $flags_active[1]) echo " active " ?>" href="<?php echo Yii::app()->createUrl('backend/page/create') ?>">Add New</a>
                    </li>
                    <?php if ( strtolower($action) == 'update') : ?>
                    <li>
                        <a class="<?php if ($flags_open[10] && $flags_active[2]) echo " active " ?>" href="#">Update</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </li>
            <li>
                <a href="#" class="sidebar-nav-menu <?php if ($flags_open[11] && $controller == 'faq') echo " open bold" ?> "><i class="fa fa-angle-left sidebar-nav-indicator"></i><i class="fa fa-comments-o sidebar-nav-icon"></i>FAQ Pages</a>
                <ul <?php if ($flags_open[11] && $controller == 'faq') echo ' style="display:block;" ' ?> >
                    <li>
                        <a class="<?php if ($flags_open[11] && $flags_active[0]) echo " active " ?>" href="<?php echo Yii::app()->createUrl('backend/faq') ?>">List All FAQ</a>
                    </li>
                    <li>
                        <a class="<?php if ($flags_open[11] && $flags_active[1]) echo " active " ?>" href="<?php echo Yii::app()->createUrl('backend/faq/create') ?>">Add New</a>
                    </li>
                    <?php if ( strtolower($action) == 'update') : ?>
                    <li>
                        <a class="<?php if ($flags_open[11] && $flags_active[2]) echo " active " ?>" href="#">Update</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </li>
            <li>
                <a href="<?php echo Yii::app()->createUrl('backend/setting') ?>" class="<?php if ($flags_open[13] == true): ?> active <?php endif;?> "><i class="fa fa-gears sidebar-nav-icon"></i>Settings</a>
            </li>
            <?php endif; ?>
            
            <li class="sidebar-header">
                <span class="sidebar-header-options clearfix"><i class="fa fa-cog"></i></span>
                <span class="sidebar-header-title"><strong>Post content</strong></span>
            </li>
            
            <li>
                <a href="#" class="sidebar-nav-menu <?php if ($flags_open[2] && strpos(strtolower($action), 'quote') || $action == 'quote') echo " open bold" ?>"><i class="fa fa-angle-left sidebar-nav-indicator"></i><i class="fa fa-quote-left sidebar-nav-icon"></i>Quotes</a>
                <ul <?php if ($flags_open[2] && strpos(strtolower($action), 'quote') || $action == 'quote') echo ' style="display:block;" ' ?> >
                    <li>
                        <a class="<?php if ($flags_open[2] && $flags_active[0]) echo " active " ?>" href="<?php echo Yii::app()->createUrl('backend/post/quote') ?>">All Posts</a>
                    </li>
                    <li>
                        <a class="<?php if ($flags_open[2] && $flags_active[1]) echo " active " ?>" href="<?php echo Yii::app()->createUrl('backend/post/addQuote') ?>">Add New</a>
                    </li>
                    <?php if ( strtolower($action) == 'updatequote') : ?>
                    <li>
                        <a class="<?php if ($flags_open[2] && $flags_active[2]) echo " active " ?>" href="#">Update</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </li>
            <li>
                <a href="#" class="sidebar-nav-menu <?php if ($flags_open[2] && strpos(strtolower($action), 'book') || $action == 'quote') echo " open bold" ?>"><i class="fa fa-angle-left sidebar-nav-indicator"></i><i class="fa fa-book sidebar-nav-icon"></i>Books</a>
                <ul <?php if ($flags_open[2] && strpos(strtolower($action), 'book') || $action == 'book') echo ' style="display:block;" ' ?> >
                    <li>
                        <a class="<?php if ($flags_open[2] && $flags_active[3]) echo " active " ?>" href="<?php echo Yii::app()->createUrl('backend/post/book') ?>">All Posts</a>
                    </li>
                    <li>
                        <a class="<?php if ($flags_open[2] && $flags_active[4]) echo " active " ?>" href="<?php echo Yii::app()->createUrl('backend/post/addBook') ?>">Add New</a>
                    </li>
                    <?php if ( strtolower($action) == 'updatebook') : ?>
                    <li>
                        <a class="<?php if ($flags_open[2] && $flags_active[5]) echo " active " ?>" href="#">Update</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </li>
            <li>
                <a href="#" class="sidebar-nav-menu <?php if ($flags_open[2] && strpos(strtolower($action), 'music') || $action == 'music') echo " open bold" ?>"><i class="fa fa-angle-left sidebar-nav-indicator"></i><i class="fa fa-music sidebar-nav-icon"></i>Music</a>
                <ul <?php if ($flags_open[2] && strpos(strtolower($action), 'music') || $action == 'music') echo ' style="display:block;" ' ?> >
                    <li>
                        <a class="<?php if ($flags_open[2] && $flags_active[6]) echo " active " ?>" href="<?php echo Yii::app()->createUrl('backend/post/music') ?>">All Posts</a>
                    </li>
                    <li>
                        <a class="<?php if ($flags_open[2] && $flags_active[7]) echo " active " ?>" href="<?php echo Yii::app()->createUrl('backend/post/addMusic') ?>">Add New</a>
                    </li>
                    <?php if ( strtolower($action) == 'updatemusic') : ?>
                    <li>
                        <a class="<?php if ($flags_open[2] && $flags_active[8]) echo " active " ?>" href="#">Update</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </li>
            <li class="sidebar-header">
                <span class="sidebar-header-options clearfix"><i class="fa fa-users"></i></span>
                <span class="sidebar-header-title"><strong>User</strong></span>
            </li>
            
            <li>
                <a href="<?php echo Yii::app()->createUrl('user/profile'); ?>" class="<?php if ($module =='user' && $action=='profile' && $flags_active[0] == true) echo 'active' ?>"></i><i class="gi gi-user sidebar-nav-icon"></i>User Profile</a>
                <?php $actions = array('admin', 'create', 'update') ?>
                <?php if($admin == 1): ?>
                <a href="<?php echo Yii::app()->createUrl('user/admin'); ?>" class="<?php if (($module =='user' && $action != 'profile') || ($module =='user' && in_array($action, $actions))) echo 'active' ?>"></i><i class="gi gi-cogwheels sidebar-nav-icon"></i>Manage Users</a>
                <?php endif; ?>
            </li>
        </ul>

    </div>
</div>