<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sidebar
 *
 * @author khangld
 */
class FrontSidebar extends CWidget {
    
    public $controller;
    public $limit = 12;

    public function init() {
        
    }

    public function run() {
        
        $controller = Yii::app()->controller->id;
        
        // load list lastest
        $model_story = Post::model()->get_lastest($this->limit, 1)->findAll();
        
        $this->render('front-sidebar', array(
            'controller' => $controller,
            'model_story' => $model_story,
        ));
    }

}
