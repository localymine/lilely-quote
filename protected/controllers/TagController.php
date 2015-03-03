<?php

class TagController extends FrontController {

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

        if (Yii::app()->request->isAjaxRequest) {
            $page = Yii::app()->user->getState('front_page_more_by_tag');
            $page += 1;
            $model_story = Post::model()->localized($this->lang)->get_post_by_term($term->id, $this->limit, $page)->findAll();
            Yii::app()->user->setState('front_page_more_by_tag', $page);
            if ($model_story != NULL) {
                $this->renderPartial('../_line/_story_1', array('posts' => $model_story), false, true);
            }
        } else {
            Yii::app()->user->setState('front_page_more_by_tag', 1);
            //
            $model_story = Post::model()->localized($this->lang)->get_post_by_term($term->id, $this->limit, $page)->findAll();

            $this->render('index', array(
                'model_story' => $model_story,
            ));
        }
    }

    public function loadModelSlug($slug) {

        foreach (Yii::app()->request->languages as $l => $language) {
            $model = Terms::model()->localized($l)->get_term_id($slug, 'tag')->find();
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
