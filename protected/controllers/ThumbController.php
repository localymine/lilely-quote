<?php

class ThumbController extends Controller {

    public function actionIndex() {

        try {
            if (!isset($_REQUEST))
                exit;

            $array = $_REQUEST;
            $image = isset($array['im']) ? $array['im'] : '';
            $type = isset($array['tp']) ? $array['tp'] : '';

            $image_path = __DIR__ . '/../../' . Yii::app()->params['set_image_path'] . $type . '/' . $image;
            $image_play = __DIR__ . '/../../' . Yii::app()->params['set_image_path'] . 'play-128.png';

            require_once(__DIR__ . '/../extensions/PHPImageWorkshop/Exception/ImageWorkshopBaseException.php');
            require_once(__DIR__ . '/../extensions/PHPImageWorkshop/Exception/ImageWorkshopException.php');
            require_once(__DIR__ . '/../extensions/PHPImageWorkshop/Core/Exception/ImageWorkshopLayerException.php');
            require_once(__DIR__ . '/../extensions/PHPImageWorkshop/Core/ImageWorkshopLib.php');
            require_once(__DIR__ . '/../extensions/PHPImageWorkshop/Core/ImageWorkshopLayer.php');
            require_once(__DIR__ . '/../extensions/PHPImageWorkshop/ImageWorkshop.php');


            if (file_exists($image_path)) {
                $layer_1_image = PHPImageWorkshop\ImageWorkshop::initFromPath($image_path);
                switch ($type) {
                    case 'book':
                        $h_1 = $layer_1_image->getHeight();
                        $w_1 = $layer_1_image->getWidth();
                        break;
                    default:
                        $h_1 = $layer_1_image->getHeight();
                        $layer_1_image->cropInPixel(504, $h_1, 0, 0, 'MM');
                        $w_1 = $layer_1_image->getWidth();
                        break;
                }

                $document = PHPImageWorkshop\ImageWorkshop::initVirginLayer($w_1, $h_1);

                $layer_2_play = PHPImageWorkshop\ImageWorkshop::initFromPath($image_play);
                $layer_2_play->resizeInPercent(50, 50);

                $document->addLayer(1, $layer_1_image);
                $document->addLayer(2, $layer_2_play, 0, 0, 'MM');
            }


            $dirPath = __DIR__ . '/../../' . Yii::app()->params['set_image_path'] . 'thumb';
            $filename = $type . '-' . $image;
            $createFolders = true;
            $backgroundColor = null; // transparent, only for PNG (otherwise it will be white if set null)
            $imageQuality = 100; // useless for GIF, usefull for PNG and JPEG (0 to 100%)

            $document->save($dirPath, $filename, $createFolders, $backgroundColor, $imageQuality);


//            $im = $document->getResult();

//            header('Content-type: image/png');
//            header('Content-Disposition: filename="book.png"');
//            imagepng($im, NULL, 8); // We choose to show a PNG (quality of 8 on a scale of 0 to 9)
            exit;
        } catch (Exception $e) {
            echo '<span style="color: red;">' . $e->getMessage() . '</span>';
        }
    }

}
