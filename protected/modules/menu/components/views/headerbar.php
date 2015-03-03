<?php
$avatar = (isset(Yii::app()->user->image)) ? (Yii::app()->user->image) : 'avatar.png';
?>
<ul class="nav navbar-nav-custom">
    <li class="hidden-xs hidden-sm">
        <a href="javascript:void(0)" id="sidebar-toggle-lg">
            <i class="fa fa-list-ul fa-fw"></i>
        </a>
    </li>
    <li class="hidden-md hidden-lg">
        <a href="javascript:void(0)" id="sidebar-toggle-sm">
            <i class="fa fa-bars fa-fw"></i>
        </a>
    </li>
    <li class="hidden-md hidden-lg">
        <a href="<?php echo Yii::app()->createUrl('/backend/dashboard') ?>">
            <i class="gi gi-stopwatch fa-fw"></i>
        </a>
    </li>
</ul>
<ul class="nav navbar-nav-custom pull-right">
    <li class="dropdown">
        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/avatars/<?php echo $avatar ?>" alt="avatar" /> <i class="fa fa-angle-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
            <li class="dropdown-header text-center">Account</li>
            <li class="divider"></li>
            <li>
                <a href="<?php echo Yii::app()->createUrl('/user/profile') ?>">
                    <i class="fa fa-user fa-fw pull-right"></i>
                    Profile
                </a>
                <a href="#modal-user-settings" data-toggle="modal">
                    <i class="fa fa-cog fa-fw pull-right"></i>
                    Settings
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="<?php echo Yii::app()->createUrl('/user/logout') ?>"><i class="fa fa-ban fa-fw pull-right"></i> Logout</a>
            </li>
        </ul>
    </li>
</ul>