<?php

class QuoteController extends FrontController {

    public $lang = 'en';
    public $languages = array();
    public $post_type = 'quote';
    public $limit = 6;

    public function init() {
        $this->lang = Yii::app()->language;
        $this->languages = Yii::app()->request->languages;

        $this->limit = Yii::app()->setting->getValue('SIZE_OF_QUOTE');
        

        parent::init();
    }

    public function actionIndex() {
        
        Yii::app()->user->setState('select_topic', $this->post_type);

        $page = 2;  // this stand for offset

        if (Yii::app()->request->isAjaxRequest) {
            $page = Yii::app()->user->getState('front_page_more_quote');
//            $page += 1;
            $page = $this->limit + $page;   // this is next offset
            $model_story = Post::model()->localized($this->lang)->get_quote($this->limit, $page)->findAll();
            Yii::app()->user->setState('front_page_more_quote', $page);
            if ($model_story != NULL) {
                $this->renderPartial('../_line/_story', array('posts' => $model_story), false, true);
            }
        } else {
            Yii::app()->user->setState('front_page_more_quote', $page);
            //
            $model_story = Post::model()->localized($this->lang)->get_quote($this->limit, $page)->findAll();
            
            $model_story_2 = Post::model()->localized($this->lang)->get_quote(2, 0)->findAll();

            $this->render('index', array(
                'model_story' => $model_story,
                'model_story_2' => $model_story_2,
            ));
        }
    }

    public function actionShow($slug) {
        $post_from_slug = $this->loadModelSlug($slug);
        $post = $this->loadModel($post_from_slug->id, true);
        $post->saveCounters(array('visits'=>1));
        //
        Post::model()->update_last_visited($post_from_slug->id);
        //
        $this->render('show', array(
            'post' => $post,
        ));
    }
    
    public function actionShowbox($slug) {
        $post_from_slug = $this->loadModelSlug($slug);
        $post = $this->loadModel($post_from_slug->id, true);
        $post->saveCounters(array('visits'=>1));
        //
        $this->renderPartial('show', array(
            'post' => $post,
        ), false, true);
    }

    public function loadModelSlug($slug) {

        foreach (Yii::app()->request->languages as $l => $language) {
            $model = Post::model()->localized($l)->get_post_by_slug($slug, $this->post_type)->find();
            if ($model !== null) {
                return $model;
            }
        }
        //
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

}