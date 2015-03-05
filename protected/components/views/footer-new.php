<footer>
    <div class="row">
        <div class="col-lg-12 center-block">
            <ul class="footer">
                <li><a class="<?php echo ($action == 'contact') ? 'active' : '' ?>" href="<?php echo Yii::app()->createUrl('site/contact') ?>">Contact</a></li>
                <li><a class="<?php echo ($action == 'about') ? 'active' : '' ?>" href="<?php echo Yii::app()->createUrl('site/about') ?>">About</a></li>
                <li><a class="<?php echo ($action == 'faq') ? 'active' : '' ?>" href="<?php echo Yii::app()->createUrl('site/faq') ?>">FAQ</a></li>
                <li><a class="<?php echo ($action == 'advertise') ? 'active' : '' ?>" href="<?php echo Yii::app()->createUrl('advertise') ?>">Advertise</a></li>
                <li><a class="<?php echo ($action == 'privacy') ? 'active' : '' ?>" href="<?php echo Yii::app()->createUrl('site/privacy') ?>">Privacy</a></li>
                <li><a class="<?php echo ($action == 'terms') ? 'active' : '' ?>" href="<?php echo Yii::app()->createUrl('site/terms') ?>">Terms</a></li>
            </ul>
        </div>
        <!--<div class="col-lg-12">-->
            <!--<p>Copyright &copy; Lilely 2014</p>-->
        <!--</div>-->
    </div>
</footer>