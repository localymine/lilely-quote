<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Menu
 *
 * @author khangld
 */
class MenuHome extends CWidget {

    public $lang = 'vi';
    
    public function init() {
        $this->lang = Yii::app()->language;
    }

    public function run() {
        
        $controller = Yii::app()->controller->id;
        $action = Yii::app()->controller->action->id;
        
        //
        $model = TermTaxonomy::model()->get_all_categories(0)->findAll();
        
        $quote_topics = Terms::model()->localized($this->lang)->get_topic_by_post_type('quote')->findAll();
        $book_topics = Terms::model()->localized($this->lang)->get_topic_by_post_type('book')->findAll();
        $music_topics = Terms::model()->localized($this->lang)->get_topic_by_post_type('music')->findAll();
        
        $this->render('menu-home', array(
            'controller' => $controller,
            'action' => $action,
            'model' => $model,
            'quote_topics' => $quote_topics,
            'book_topics' => $book_topics,
            'music_topics' => $music_topics,
            'lang' => $this->lang,
        ));
    }

}
