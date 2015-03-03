<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Footer
 *
 * @author khangld
 */
class Banner extends CWidget {

    public $lang = 'en';

    public function init() {
        $this->lang = Yii::app()->language;
    }

    public function run() {

        $model = NULL;
        $controller = Yii::app()->controller->id;
        $action = Yii::app()->controller->action->id;

        if ($controller != 'search') {
            if ($action != 'show') {
                $model = Slide::model()->localized($this->lang)->load_banner()->find();
            }
        }
        
        $this->render('banner', array(
            'controller' => $controller,
            'action' => $action,
            'model' => $model,
        ));
    }

}
