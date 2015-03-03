<?php 
$i = 1;
$class = '';
$class_s = '';
?>
<?php foreach ($posts as $row): ?>
    <?php
        switch ($row->post_type) {
            case 'quote' :
                $class = 'quote-item';
                break;
            case 'music' :
                if (in_array(Yii::app()->controller->id, array('home', 'search', 'topic'))){
                    $class = 'quote-item';
                }else{
                    $class = 'music-item';
                }
                break;
            case 'book' :
                if (in_array(Yii::app()->controller->id, array('book', 'topic'))){
                    if ($i > 3){
                        $i = 1;
                    }
                    $class = "book-item book-item-$i";
                    $class_s = "bk-s-$i";
                    $i++;
                }
                //
//                if (in_array(Yii::app()->controller->id, array('search', 'topic'))){
//                    $class = 'quote-item bg';
//                }
                break;
        }
    ?>

    <div class="col-xs-12 col-md-4 <?php echo $class_s ?>">
        <div class="item <?php echo $class ?>">
            <?php if (Yii::app()->controller->id == 'famousQuotes' && $row->visits > 0): ?>
                <div class="visits">
                    <?php echo number_format($row->visits) ?>
                </div>
            <?php endif; ?>

            <?php if ($row->post_type == 'quote'): ?> <!-- view if quote -->

                <?php $this->renderPartial('../_line/_l_quote', array('row' => $row)) ?>

            <?php elseif ($row->post_type == 'music'): ?> <!-- view if not quote -->

                <?php $this->renderPartial('../_line/_l_music', array('row' => $row)) ?>

            <?php else: ?>

                <?php // if (Yii::app()->controller->id == 'book'):  ?>
                    <?php $this->renderPartial('../_line/_l_bookshelf', array('row' => $row)) ?>
                <?php // else: ?>
                    <?php // $this->renderPartial('../_line/_l_book', array('row' => $row)) ?>
                <?php // endif;?>

            <?php endif; ?>

        </div>
    </div>
<?php endforeach; ?>