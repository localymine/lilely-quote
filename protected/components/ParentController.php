<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ParentController
 *
 * @author khangld
 */
class ParentController extends ExtendedCController {

    public $fb_site_name;
    public $fb_title;
    public $fb_description;
    public $fb_image_url;
    public $fb_share_url;
    public $fb_type;

    public function beforeRender() {

        if (!empty($this->fb_site_name)) {
            Yii::app()->clientScript->registerMetaTag($this->fb_site_name, 'fb-site_name', null, array('property' => 'og:site_name'));
        }
        
        if (!empty($this->fb_title)) {
            Yii::app()->clientScript->registerMetaTag($this->fb_title, 'fb-title', null, array('property' => 'og:title'));
        }
        
        if (!empty($this->fb_description)) {
            Yii::app()->clientScript->registerMetaTag($this->fb_description, 'fb-description', null, array('property' => 'og:description'));
        }
        
        if (!empty($this->fb_image_url)) {
            Yii::app()->clientScript->registerMetaTag($this->fb_image_url, 'fb-image', null, array('property' => 'og:image'));
        }
        
        if (!empty($this->fb_share_url)) {
            Yii::app()->clientScript->registerMetaTag($this->fb_share_url, 'fb-url', null, array('property' => 'og:url'));
        }
        
        if (!empty($this->fb_type)) {
            Yii::app()->clientScript->registerMetaTag($this->fb_type, 'fb-type', null, array('property' => 'og:type'));
        }

        return true;
    }

}
