<?php

class SiteController extends FrontController {

//    public $defaultAction = 'index';
    public $lang = 'en';

    public function init() {
        $this->lang = Yii::app()->language;
	
	parent::init();
    }

    public function actionContact() {

        $model = Page::model()->localized($this->lang)->contact()->sort_by_date()->find();

        $this->render('pages/contact', array(
            'model' => $model
        ));
    }

    public function actionAbout() {

        $model = Page::model()->localized($this->lang)->about()->sort_by_date()->find();

        $this->render('pages/about', array(
            'model' => $model
        ));
    }

    public function actionPrivacy() {

        $model = Page::model()->localized($this->lang)->privacy()->sort_by_date()->find();

        $this->render('pages/privacy', array(
            'model' => $model
        ));
    }

    public function actionTerms() {

        $model = Page::model()->localized($this->lang)->terms()->sort_by_date()->find();

        $this->render('pages/terms', array(
            'model' => $model
        ));
    }

    public function actionFaq() {

        $terms = TermTaxonomy::model()->get_all_terms_by('faq')->findAll();

        $this->render('pages/faq', array(
            'terms' => $terms,
        ));
    }

}
