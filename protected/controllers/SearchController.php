<?php

class SearchController extends FrontController {

    public $lang = 'en';
    public $languages = array();
    public $pageSize = 20;
    public $pageSizeScholarship = '20';
    public $pageSizeInternship = '20';
    public $pageSizeCollege = '20';

    public function init() {
        $this->lang = Yii::app()->language;
        $this->languages = Yii::app()->request->languages;

        $this->pageSize = Yii::app()->setting->getValue('SIZE_OF_SEARCH_ALL');

        parent::init();
    }

    public function actionIndex() {
        $model = new Post;
        $select_title = array();
        //
        $result = NULL;
        $item_count = 0;
        $page_size = $this->pageSize;

        // create params for url
        $route = Yii::app()->controller->route;
        $params = $_GET;
        array_unshift($params, $route);

        if (isset($_GET['kw']) && trim($_GET['kw']) != '') {

            $keyword = $_GET['kw'];

            if (trim($keyword) != '') {

                // tracking
                $log = new Logs();
                $log->root = 'logs/search';
                $log->content = array(
                    array(
                        Yii::app()->user->id,
                        isset(Yii::app()->user->username) ? Yii::app()->user->username : '',
                        '',
                        'all',
                        $_GET['kw'],
                        '',
                        '',
                        Common::get_current_date(),
                    ),
                );
                $log->track();

//                $item_count = $model->localized($this->lang)->search_all_count($keyword)->count();
                $item_count = $model->multilang()->search_all_count($keyword)->count();

                // the pagination itself
                $pages = new CPagination($item_count);
                $pages->setPageSize($page_size);

//                $result = $model->localized($this->lang)->search_all($keyword, $pages->limit, $pages->offset)->findAll();
                $result = $model->multilang()->search_all($keyword, $pages->limit, $pages->offset)->findAll();
            }

            $this->render('index', array(
                'keyword' => $keyword,
                'select_title' => $select_title,
                'result' => $result,
                'item_count' => $item_count,
                'page_size' => $page_size,
                'pages' => $pages,
                'params' => $params,
            ));
        } else {
            $pages = new CPagination(0);
            $pages->setPageSize(0);

            $this->render('index', array(
                'result' => NULL,
                'pages' => $pages,
                'item_count' => 0,
                'page_size' => 0,
            ));
        }
    }

}
