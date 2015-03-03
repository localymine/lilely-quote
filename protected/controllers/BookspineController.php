<?php

class BookspineController extends Controller {

    public function actionIndex() {
        
        if (!isset($_REQUEST['i'])) exit;
        
        $image = $_REQUEST['i'];
        
        $image_path = Yii::app()->params['set_book_path'] . $image;
        
        if (!file_exists($image_path)) exit;
        
        $im_info = getimagesize($image_path);
        $im_width = $im_info[0];
        $im_height = $im_info[1];
        
        switch ($im_info['mime']) {
            case 'image/png':
                //Create a new image from file 
                $im = imagecreatefrompng($image_path);
                break;
            case 'image/gif':
                $im = imagecreatefromgif($image_path);
                break;
            case 'image/jpeg':
            case 'image/pjpeg':
                $im = imagecreatefromjpeg($image_path);
                break;
            default:
                exit; //output error and exit
        }
        
        //create instance
        $im_dest = imagecreatetruecolor(3, $im_height);
        
        // copy
        imagecopy($im_dest, $im, 0, 0, 0, 0, $im_width, $im_height);

        // Set the content type header - in this case image/jpeg
        header('Content-Type: image/jpeg');

        // Output the image
        imagejpeg($im_dest);

        // Free up memory
        imagedestroy($im_dest);
        imagedestroy($im);
    }

}
