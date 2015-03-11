<footer>
    <div class="row">
        <div class="col-lg-12">
            <ul class="footer link">
                <li><a class="<?php echo ($action == 'about') ? 'active' : '' ?>" href="<?php echo Yii::app()->createUrl('site/about') ?>">Giới Thiệu</a></li>
                <li><a class="<?php echo ($action == 'contact') ? 'active' : '' ?>" href="<?php echo Yii::app()->createUrl('#') ?>">Tuyển Dụng</a></li>
                <li><a class="<?php echo ($action == 'advertise') ? 'active' : '' ?>" href="<?php echo Yii::app()->createUrl('advertise') ?>">Quảng Cáo</a></li>
                <li><a class="<?php echo ($action == 'contact') ? 'active' : '' ?>" href="<?php echo Yii::app()->createUrl('site/contact') ?>">Liên Hệ</a></li>
                <li><a class="<?php echo ($action == 'faq') ? 'active' : '' ?>" href="<?php echo Yii::app()->createUrl('site/faq') ?>">FAQ</a></li>
                <li><a class="<?php echo ($action == 'terms') ? 'active' : '' ?>" href="<?php echo Yii::app()->createUrl('site/terms') ?>">Thỏa Thuận Sử Dụng</a></li>
                <li><a class="<?php echo ($action == 'privacy') ? 'active' : '' ?>" href="<?php echo Yii::app()->createUrl('site/privacy') ?>">Quy Định Bảo Mật</a></li>
            </ul>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-12 footer-contanter-2">
            <div class="col-md-6">
                <h1 class="site-name">Lilely.com</h1>
                <p>&copy; Copyright 2015 <span class="ctn">Lilely</span>. All Rights Reserved</p>
            </div>
            <div class="col-md-6">
                <div class="addr">
                    <h1>25 Nguyen Thi Minh Khai St., Ben Nghe Ward</h1>
                    <h1>Ho Chi Minh City, Vietnam</h1>
                </div>
            </div>
        </div>
    </div>
</footer>