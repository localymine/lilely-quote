<?php

class BookArrangeController extends Controller {

    public function actionIndex() {

        try {
            if (!isset($_REQUEST))
                exit;
            
            $array = $_REQUEST;
            $image_1 = isset($array['b2']) ? $array['b2'] : '';
            $image_2 = isset($array['b1']) ? $array['b1'] : '';

//            $image_path_1 = Yii::app()->params['set_book_path'] . $image_1;
//            $image_path_2 = Yii::app()->params['set_book_path'] . $image_2;
            
            $image_path_1 = __DIR__  . '/../../' . Yii::app()->params['set_book_path'] . $image_1;
            $image_path_2 = __DIR__  . '/../../' . Yii::app()->params['set_book_path'] . $image_2;

            require_once(__DIR__ . '/../extensions/PHPImageWorkshop/Exception/ImageWorkshopBaseException.php');
            require_once(__DIR__ . '/../extensions/PHPImageWorkshop/Exception/ImageWorkshopException.php');
            require_once(__DIR__ . '/../extensions/PHPImageWorkshop/Core/Exception/ImageWorkshopLayerException.php');
            require_once(__DIR__ . '/../extensions/PHPImageWorkshop/Core/ImageWorkshopLib.php');
            require_once(__DIR__ . '/../extensions/PHPImageWorkshop/Core/ImageWorkshopLayer.php');
            require_once(__DIR__ . '/../extensions/PHPImageWorkshop/ImageWorkshop.php');

            $width = 412;
            $height = 364;
            $backgroundColor = NULL;

            $document = PHPImageWorkshop\ImageWorkshop::initVirginLayer($width, $height, $backgroundColor);

            if (file_exists($image_path_1)) {
                $image_shadow = Yii::app()->params['set_book_path'] . 'book-shadow.png';
                $layer_1_shadow = PHPImageWorkshop\ImageWorkshop::initFromPath($image_shadow);
                $layer_1_shadow->resizeInPixel(215, NULL, TRUE);
                $layer_1_shadow->rotate(6);

                $layer_1 = PHPImageWorkshop\ImageWorkshop::initFromPath($image_path_1);
                $layer_1->resizeInPixel(185, NULL, TRUE);
                $layer_1->rotate(6);

                $document->addLayer(1, $layer_1_shadow, 173, 63);
                $document->addLayer(2, $layer_1, 190, 80);
            }

            if (file_exists($image_path_2)) {
                $image_shadow = Yii::app()->params['set_book_path'] . 'book-shadow.png';
                $layer_2_shadow = PHPImageWorkshop\ImageWorkshop::initFromPath($image_shadow);
                $layer_2_shadow->resizeInPixel(263, NULL, TRUE);
                $layer_2_shadow->rotate(-10);

                $layer_2 = PHPImageWorkshop\ImageWorkshop::initFromPath($image_path_2);
                $layer_2->resizeInPixel(227, NULL, TRUE);
                $layer_2->rotate(-10);

                $document->addLayer(3, $layer_2_shadow, -7, -13);
                $document->addLayer(4, $layer_2, 14, 8);
            }

            $image = $document->getResult();

            header('Content-type: image/png');
            header('Content-Disposition: filename="book.png"');
            imagepng($image, NULL, 8); // We choose to show a PNG (quality of 8 on a scale of 0 to 9)
            exit;
        } catch (Exception $e) {
            echo '<span style="color: red;">' . $e->getMessage() . '</span>';
        }
    }

}
