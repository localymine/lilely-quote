<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ExtendedCController
 *
 * @author khangld
 */
class ExtendedCController extends CController {

    public function render($view, $data = null, $return = false) {
        if ($this->beforeRender()) {
            parent::render($view, $data, $return);
        }
    }

    public function beforeRender() {
        return true;
    }

}
