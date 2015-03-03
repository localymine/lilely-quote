<?php

class AuthorsController extends FrontController {

    public $lang = 'en';
    public $languages = array();
    public $limit = 6;

    public function init() {
        $this->lang = Yii::app()->language;
        $this->languages = Yii::app()->request->languages;

        $this->limit = Yii::app()->setting->getValue('SIZE_OF_OUR_CURATORS');

        parent::init();
    }

    public function actionIndex($alphabet = '') {

        $page = 1;

        if (isset($_REQUEST['alphabet'])) {
            $alphabet = $_REQUEST['alphabet'];
        }

        if (Yii::app()->request->isAjaxRequest) {
            $page = Yii::app()->user->getState('front_page_more_curators');
            $page += 1;
            $model_story = Post::model()->localized($this->lang)->get_post_by_author($alphabet, $this->limit, $page)->findAll();
            Yii::app()->user->setState('front_page_more_curators', $page);
            if ($model_story != NULL) {
                $this->renderPartial('../_line/_story_1', array('posts' => $model_story), false, true);
            }
        } else {
            Yii::app()->user->setState('front_page_more_curators', 1);
            //
            $model_story = Post::model()->localized($this->lang)->get_post_by_author($alphabet, $this->limit, $page)->findAll();

            $this->render('index', array(
                'model_story' => $model_story,
            ));
        }
    }

}
