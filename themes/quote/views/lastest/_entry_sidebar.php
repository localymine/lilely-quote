<?php foreach($posts as $row): ?>
<?php // $obj = new Date_Time_Calc($row->post_date, ''); ?>
    <li data-id="<?php echo $row->id ?>">
        <a href="<?php echo Yii::app()->createUrl($row->post_type . '/show', array('slug' => $row->slug)) ?>"><?php echo $row->post_title ?></a><span class="time"><?php echo Common::get_time_duration($row->post_date) ?></span>
        <?php if ($row->post_youtube != ''): ?>
        <div class="play-holder">
            <a href="javascript:void(0);" class="btn-play"><i class="fa fa-play-circle"></i></a>
        </div>
        <?php endif; ?>
    </li>
<?php endforeach; ?>