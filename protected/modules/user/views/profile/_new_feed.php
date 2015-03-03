<?php foreach ($posts as $row): ?>
<?php
$user = UserModule::user($row->post_author);
?>
<li class="media">
    <?php if ($user->profile->image == ''): ?>
        <a href="#" class="pull-left">
            <img width="64" src="<?php echo Yii::app()->baseUrl ?>/avatars/avatar.png" alt="Avatar" class="img-circle" />
        </a>
    <?php else: ?>
        <a href="#" class="pull-left">
            <img width="64" src="<?php echo Yii::app()->baseUrl ?>/avatars/<?php echo $user->profile->image ?>" alt="Avatar" class="img-circle" />
        </a>
    <?php endif; ?>
    <div class="media-body">
        <p class="push-bit">
            <span class="text-muted pull-right">
                <small><?php echo Common::get_time_duration($row->post_date) ?></small>
            </span>
            <strong><a href="#"><?php echo $user->username ?></a> published a new <?php echo $row->post_type ?>.</strong>
        </p>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li>ID: <strong><?php echo $row->id ?></strong></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="block clearfix">
                <h5>
                    <a href="<?php echo Yii::app()->createUrl('backend/post/update' . ucfirst($row->post_type), array('id' => $row->id)) ?>">
                        <strong><?php echo $row->post_title ?></strong>
                        <?php echo Common::get_time_duration($row->post_date) ?>
                    </a>
                </h5>
                <?php if($row->post_type == 'book'): ?>
                <p><img align="left" width="100" style="padding:5px" src="<?php echo Yii::app()->baseUrl ?>/images/<?php echo $row->post_type ?>/<?php echo $row->cover ?>" /><?php echo mb_substr(strip_tags($row->post_content), 1, 300) . '...' ?></p>
                <?php else: ?>
                <p><img align="left" width="100" style="padding:5px" src="<?php echo Yii::app()->baseUrl ?>/images/<?php echo $row->post_type ?>/<?php echo $row->image ?>" /><?php echo mb_substr(strip_tags($row->post_content), 1, 300) . '...' ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</li>
<?php endforeach; ?>