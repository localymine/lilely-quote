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
class FooterNew extends CWidget {

    public function init() {
        
    }

    public function run() {

        $controller = Yii::app()->controller->id;
        $action = Yii::app()->controller->action->id;

        $this->render('footer-new', array(
            'controller' => $controller,
            'action' => $action,
        ));
    }

}
