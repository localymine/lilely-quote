<?php

class HomeController extends FrontController {

    public $lang = 'en';
    public $languages = array();
    public $limit = 6;

    public function init() {
        $this->lang = Yii::app()->language;
        $this->languages = Yii::app()->request->languages;

        $this->limit = Yii::app()->setting->getValue('SIZE_OF_STORY');
        $this->layout = 'column-home';

        parent::init();
    }
    
    public function actionIndex(){
        
        $post_type = Yii::app()->user->getState('select_topic');
        $post_type = isset($post_type) ? $post_type : 'quote';
        
        $this->render('index-new', array(
            'lang' => $this->lang
        ));
        
    }

    private function actionIndex_del() {
        $page = 1;

        if (Yii::app()->request->isAjaxRequest) {
            $page = Yii::app()->user->getState('front_page_more_lastest');
            $page += 1;
//            $model_story = Post::model()->localized($this->lang)->get_lastest($this->limit, $page)->findAll();
            $model_story = Post::model()->multilang()->get_lastest($this->limit, $page)->findAll();
            Yii::app()->user->setState('front_page_more_lastest', $page);
            if ($model_story != NULL) {
                $this->renderPartial('../_line/_story_1', array('posts' => $model_story), false, true);
            }
        } else {
            Yii::app()->user->setState('front_page_more_lastest', 1);
            //
            srand((float)microtime()*1000000);
            $rand = "0.".rand();
            Yii::app()->user->setState('rand', $rand);
            //
//            $model_story = Post::model()->localized($this->lang)->get_lastest($this->limit, $page)->findAll();
            $model_story = Post::model()->multilang()->get_lastest($this->limit, $page)->findAll();

            $this->render('index', array(
                'model_story' => $model_story,
            ));
        }
    }

}
