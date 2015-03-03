<?php

class LoadMoreController extends FrontController {
    
    public $lang = 'en';
    public $languages = array();
    public $limit = 4;

    public function init() {
        $this->lang = Yii::app()->language;
        $this->languages = Yii::app()->request->languages;
        
        parent::init();
    }

    public function actionIndex() {
        if (isset($_REQUEST)) {

            $data = $_REQUEST;

            $arr = array();
            $model = Post::model()->get_post_random((int) $data['id'], $data['type'], $this->limit)->findAll();

            $this->renderPartial('../_line/_l_yt_relation', array(
                'model' => $model
                    ), false, true);

//            $arr['yt-id'] = $model->post_youtube;
//            $arr['image'] = $model->image;
        }
    }

}
