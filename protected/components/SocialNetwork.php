<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SocialNetwork
 *
 * @author khangld
 */
class SocialNetwork extends CWidget {

    public $type = 'follow';
    
    public $acc_twitter = '';   // email
    public $acc_facebook = '';  // email
    public $data_href = '';
    public $fb_margin_top = -9;
    
    public $title = '';
    public $description = '';
    public $image_url = '';
    
    public function init() {
        
    }

    public function run() {
        
        switch ($this->type){
            case 'social-youtube':
                $this->render('social-youtube', array(
                    'share_url' => $this->data_href,
                    'title' => $this->title,
                    'description' => $this->description,
                    'image_url' => $this->image_url,
                ));
                break;
            case 'social-block-item':
                $this->render('social-block-item', array(
                    'share_url' => $this->data_href,
                    'title' => $this->title,
                    'description' => $this->description,
                    'image_url' => $this->image_url,
                ));
                break;
            case 'social-top-facebook-share':
                $this->render('social-top-facebook-share', array(
                    'share_url' => $this->data_href,
                    'title' => $this->title,
                    'description' => $this->description,
                    'image_url' => $this->image_url,
                ));
                break;
            case 'social-top-facebook-like':
                $this->render('social-top-facebook-like', array(
                    'share_url' => $this->data_href,
                ));
                break;
            case 'social-top-facebook-like-share':
                $this->render('social-top-facebook-like-share', array(
                    'share_url' => $this->data_href,
                    'image_url' => $this->image_url,
                    'title' => $this->title,
                    'description' => $this->description,
                ));
                break;
            case 'social-top-facebook-like-mainpage':
                $this->render('social-top-facebook-like-mainpage');
                break;
            default:
                $this->render('social-network');
                break;
        }
        
    }

}
