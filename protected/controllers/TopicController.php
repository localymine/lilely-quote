<?php

class TopicController extends FrontController {

    public $lang = 'en';
    public $languages = array();
    public $limit = 6;

    public function init() {
        $this->lang = Yii::app()->language;
        $this->languages = Yii::app()->request->languages;

        $this->limit = Yii::app()->setting->getValue('SIZE_OF_STORY');

        parent::init();
    }

    public function actionIndex($slug) {

        $page = 1;
        $term = $this->loadModelSlug($slug);
        //
//        $post_type = Yii::app()->user->getState('select_topic');
//        $post_type = isset($post_type) ? $post_type : 'quote';
        
        $m_topic = array('quote', 'book', 'music');
        $requ_type = isset($_GET['type']) ? $_GET['type'] : 'quote'; 
        $post_type = in_array($requ_type, $m_topic) ? $requ_type : 'quote';
        
        if (Yii::app()->request->isAjaxRequest) {
            $page = Yii::app()->user->getState('front_page_more_by_category');
            $page += 1;
            $model_story = Post::model()->localized($this->lang)->get_post_by_term_post_type($term->id, $post_type, $this->limit, $page)->findAll();
            Yii::app()->user->setState('front_page_more_by_category', $page);
            if ($model_story != NULL) {
                $this->renderPartial('../_line/_story_1', array('posts' => $model_story), false, true);
            }
        } else {
            Yii::app()->user->setState('front_page_more_by_category', 1);
            //
            $model_story = Post::model()->localized($this->lang)->get_post_by_term_post_type($term->id, $post_type, $this->limit, $page)->findAll();

            $this->render('index', array(
                'term' => $term,
                'model_story' => $model_story,
            ));
        }
    }

    public function loadModelSlug($slug) {
        
        $model = Terms::model()->localized($this->lang)->get_term_id($slug, 'category')->find();
        
        if ($model != NULL){
            return $model;
        } else{
            foreach (Yii::app()->request->languages as $l => $language) {
                $model = Terms::model()->localized($l)->get_term_id($slug, 'category')->find();
                if ($model !== null) {
                    return $model;
                }
            }
        }

        //
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

}
