<?php

class TestController extends FrontController {

    public function init() {

        parent::init();
    }

    public function actionIndex() {

        $model = Slide::model()->load_banner()->findAll();

        foreach ($model as $row) {
            print_r($row->post_id . ' - ' . $row->title . ' - ' . $row->post_ref->post_title . '<br>');
        }
    }

}
