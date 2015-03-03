<?php

class LastestController extends FrontController {

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
            $page = Yii::app()->user->getState('front_page_more_lastest');
            $page += 1;
            $model_story = Post::model()->localized($this->lang)->get_lastest($this->limit, $page)->findAll();
            Yii::app()->user->setState('front_page_more_lastest', $page);
            if ($model_story != NULL) {
                $this->renderPartial('../_line/_story_1', array('posts' => $model_story), false, true);
            }
        } else {
            Yii::app()->user->setState('front_page_more_lastest', 1);
            //
            $model_story = Post::model()->localized($this->lang)->get_lastest($this->limit, $page)->findAll();

            $this->render('index', array(
                'model_story' => $model_story,
            ));
        }
    }

    public function actionSidebar() {
        $page = 1;

        if (Yii::app()->request->isAjaxRequest) {

            $id = (int) $_POST['id'];

            $page = Yii::app()->user->getState('front_page_more_sidebar');
            $page += 1;
            $model_story = Post::model()->localized($this->lang)->get_lastest_sidebar($id, $this->limit, $page)->findAll();
            Yii::app()->user->setState('front_page_more_sidebar', $page);
            if ($model_story != NULL) {
                $this->renderPartial('_entry_sidebar', array('posts' => $model_story), false, true);
            }
        }
    }

}
