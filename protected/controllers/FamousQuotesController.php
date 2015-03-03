<?php

class FamousQuotesController extends FrontController {

    public $lang = 'en';
    public $languages = array();
    public $limit = 6;

    public function init() {
        $this->lang = Yii::app()->language;
        $this->languages = Yii::app()->request->languages;

        $this->limit = Yii::app()->setting->getValue('SIZE_OF_STORY');

        parent::init();
    }

    public function actionIndex() {
        $page = 1;

        if (Yii::app()->request->isAjaxRequest) {
            $page = Yii::app()->user->getState('front_page_more_story');
            $page += 1;
            $model_story = Post::model()->localized($this->lang)->get_famous_quotes($this->limit, $page)->findAll();
            Yii::app()->user->setState('front_page_more_story', $page);
            if ($model_story != NULL) {
                $this->renderPartial('../_line/_story', array('posts' => $model_story), false, true);
            }
        } else {
            Yii::app()->user->setState('front_page_more_story', 1);
            //
            $model_story = Post::model()->localized($this->lang)->get_famous_quotes($this->limit, $page)->findAll();

            $this->render('index', array(
                'model_story' => $model_story,
            ));
        }
    }

}
