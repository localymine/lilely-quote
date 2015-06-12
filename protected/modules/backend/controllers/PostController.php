<?php

class PostController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
//            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'delete', 'create', 'update'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
//                'actions' => array('create', 'update'),
//                'users' => array('*'),
            ),
//            array('allow', // allow admin user to perform 'admin' and 'delete' actions
//                'actions' => array('admin', 'delete'),
//                'users' => array('*'),
//            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionLoadTags() {

        $model_tags = TermTaxonomy::model()->tags()->findAll();
        $arr_tags = array();
        foreach ($model_tags as $sub) {
            $arr_tags[] = $sub->terms['name'];
        }

        $tags_json = json_encode($arr_tags);

        echo $tags_json;
    }

    private function create_tags($tags_json) {
        $tags_id = array();
        $tags_arr = json_decode($tags_json);
        foreach ($tags_arr as $value) {

            if ($value != NULL) {
                $model = TermsLang::model()->findByAttributes(array('l_name' => $value));
                if ($model == NULL) {
                    $tags_id[] = Terms::create_basic_tag($value);
                }
            }
        }
        return $tags_id;
    }

    private function get_tags($tags_json) {
        $tags_id = array();
        $tags_arr = json_decode($tags_json);
        foreach ($tags_arr as $value) {
            $model = Terms::model()->findByAttributes(array('name' => $value));
            $tags_id[] = $model->id;
        }
        return $tags_id;
    }

    /* Quote - Begin */

    public function actionSortQuote() {
        parse_str($_POST['order'], $data);

        if (is_array($data)) {
            $id_arr = array();
            foreach ($data as $key => $values) {
                foreach ($values as $position => $id) {
                    $id_arr[] = $id;
                }
            }
            $menu_order_arr = array();
            foreach ($id_arr as $key => $id) {
                $results = Post::model()->get_menu_order_by_id($id);
                foreach ($results as $result) {
                    $menu_order_arr[] = $result->menu_order;
                }
            }
            sort($menu_order_arr);
            foreach ($data as $key => $values) {
                foreach ($values as $position => $id) {
                    Post::model()->update_menu_order($menu_order_arr[$position], $id);
                }
            }
        }
    }

    public function actionStatusQuote() {

        $id = $_POST['id'];
        $model = Post::model()->change_status($id, 'quote');

        echo $model->disp_flag;
    }

    public function actionDeleteQuote() {

        $id = $_POST['id'];
        $post_type = 'quote';

        $module_user = Yii::app()->getModule('user');
        $admin = $module_user->isAdmin();

        if ($admin == 1) {
            echo Post::model()->delete_post($id, $post_type);
        } elseif ($admin == 2) {
            echo Post::model()->delete_post($id, $post_type, Yii::app()->user->user_id);
        }
    }

    public function actionQuote() {

        $model = new Post;
        $item_count = 0;
        $page_size = Yii::app()->params['pageSize'];
        $condition = '';
        $pages = NULL;
        $post_type = 'quote';
        $keyword = '';

        $model->refresh_menu_order($post_type);

        if (isset($_REQUEST['keyword'])) {
            $keyword = $_REQUEST['keyword'];
        }

        $module_user = Yii::app()->getModule('user');
        $admin = $module_user->isAdmin();

        if ($admin == 1) {
            // administrator, see all stories of another
            $condition = " post_type = '$post_type' AND disp_flag = 1 ";
            if (trim($keyword) != '') {
                $keyword = Common::clean_text($keyword);
                $t_keys = Common::make_keywords($keyword);
                $condition .= " AND (post_title LIKE '%$keyword%' ";
                foreach ($t_keys as $key) {
                    $condition .= " OR post_title LIKE '%$key%' ";
                    $condition .= " OR quote_author LIKE '%$key%' ";
                }
                $condition .= ")";
            }
            $item_count = $model->count($condition);

            // the pagination itself
            $pages = new CPagination($item_count);
            $pages->setPageSize($page_size);
            if (trim($keyword) != '') {
                $pages->params = array('keyword' => $keyword);
            }

            $criteria = new CDbCriteria(array(
                'condition' => $condition,
                'order' => 'menu_order',
                'limit' => $pages->limit,
                'offset' => $pages->offset,
            ));

            $posts = $model->multilang()->findAll($criteria);
        } elseif ($admin == 2) {
            // normal admin, only see what they posted
            $condition = " post_type = '$post_type' AND disp_flag = 1  AND post_author = " . Yii::app()->user->user_id;
            if (trim($keyword) != '') {
                $t_keys = Common::make_keywords($keyword);
                $condition .= " AND (post_title LIKE '%$keyword%' ";
                foreach ($t_keys as $key) {
                    $condition .= " OR post_title LIKE '%$key%' ";
                }
                $condition .= ")";
            }
            $item_count = $model->count($condition);

            // the pagination itself
            $pages = new CPagination($item_count);
            $pages->setPageSize($page_size);
            if (trim($keyword) != '') {
                $pages->params = array('keyword' => $keyword);
            }

            $criteria = new CDbCriteria(array(
                'condition' => $condition,
//                'order' => 'post_date DESC',
                'order' => 'menu_order',
                'limit' => $pages->limit,
                'offset' => $pages->offset,
            ));

            $posts = $model->multilang()->findAll($criteria);
        }

        $this->render('quote/index', array(
            'posts' => $posts,
            'item_count' => $item_count,
            'page_size' => $page_size,
            'pages' => $pages,
            'keyword' => $keyword,
        ));
    }
    
    public function actionQuoteHiddenList() {

        $model = new Post;
        $item_count = 0;
        $page_size = Yii::app()->params['pageSize'];
        $condition = '';
        $pages = NULL;
        $post_type = 'quote';
        $keyword = '';

        $model->refresh_menu_order($post_type);

        if (isset($_REQUEST['keyword'])) {
            $keyword = $_REQUEST['keyword'];
        }

        $module_user = Yii::app()->getModule('user');
        $admin = $module_user->isAdmin();

        if ($admin == 1) {
            // administrator, see all stories of another
            $condition = " post_type = '$post_type' AND disp_flag = 0 ";
            if (trim($keyword) != '') {
                $keyword = Common::clean_text($keyword);
                $t_keys = Common::make_keywords($keyword);
                $condition .= " AND (post_title LIKE '%$keyword%' ";
                foreach ($t_keys as $key) {
                    $condition .= " OR post_title LIKE '%$key%' ";
                    $condition .= " OR quote_author LIKE '%$key%' ";
                }
                $condition .= ")";
            }
            $item_count = $model->count($condition);

            // the pagination itself
            $pages = new CPagination($item_count);
            $pages->setPageSize($page_size);
            if (trim($keyword) != '') {
                $pages->params = array('keyword' => $keyword);
            }

            $criteria = new CDbCriteria(array(
                'condition' => $condition,
                'order' => 'menu_order',
                'limit' => $pages->limit,
                'offset' => $pages->offset,
            ));

            $posts = $model->multilang()->findAll($criteria);
        } elseif ($admin == 2) {
            // normal admin, only see what they posted
            $condition = " post_type = '$post_type' AND disp_flag = 0 AND post_author = " . Yii::app()->user->user_id;
            if (trim($keyword) != '') {
                $t_keys = Common::make_keywords($keyword);
                $condition .= " AND (post_title LIKE '%$keyword%' ";
                foreach ($t_keys as $key) {
                    $condition .= " OR post_title LIKE '%$key%' ";
                }
                $condition .= ")";
            }
            $item_count = $model->count($condition);

            // the pagination itself
            $pages = new CPagination($item_count);
            $pages->setPageSize($page_size);
            if (trim($keyword) != '') {
                $pages->params = array('keyword' => $keyword);
            }

            $criteria = new CDbCriteria(array(
                'condition' => $condition,
//                'order' => 'post_date DESC',
                'order' => 'menu_order',
                'limit' => $pages->limit,
                'offset' => $pages->offset,
            ));

            $posts = $model->multilang()->findAll($criteria);
        }

        $this->render('quote/index', array(
            'posts' => $posts,
            'item_count' => $item_count,
            'page_size' => $page_size,
            'pages' => $pages,
            'keyword' => $keyword,
        ));
    }

    public function actionUpdateQuote($id) {

        $form_title = 'Update Quote';
        $update = 1;

        $tags_arr = array();
        $tags_json = '[""]';
        $select_categories = array();

        $model = $this->loadModel($id, true);
        $model_term_relationships = new TermRelationships;

        // for upload
        $cf = Yii::app()->file;
        $upload_path = Yii::app()->params['set_quote_path'];
        $cf->createDir(0755, $upload_path);
        //
        $upload_path_author = Yii::app()->params['set_author_path'];
        $cf->createDir(0755, $upload_path_author);
        //
        $upload_path_media = Yii::app()->params['set_quote_sound_path'];
        $cf->createDir(0755, $upload_path_media);
        //
        $upload = Yii::app()->upload;
        $upload->folder = $upload_path;

        if (!isset($_POST['Post']['category'])) {
            $hold_categories = array();
            $categories = $model_term_relationships->get_relate_terms((int) $id, 'category')->findAll();
            if ($categories != NULL) {
                foreach ($categories as $row) {
                    $select_categories[] = $row->term_taxonomy_id;
                }
            }
        } else {
            $select_categories = $_POST['Post']['category'];
        }

        if (!isset($_POST['Post']['tags'])) {
            $tags = $model_term_relationships->get_relate_terms((int) $id, 'tag')->findAll();
            if ($tags != NULL) {
                foreach ($tags as $row) {
                    $tags_arr[] = $row->termtaxonomy->terms['name'];
                }
                $tags_json = json_encode($tags_arr);
            }
        }

        if (isset($_POST['Post'])) {
            $model->attributes = $_POST['Post'];

            if ($model->validate()) {

                // upload image - update
                if (CUploadedFile::getInstance($model, 'image') != NULL) {
                    $upload->old_file = $model->image;
                    $upload->post = $model->image = CUploadedFile::getInstance($model, 'image');
                    $model->image = $upload->normal();
                }
                // upload author image - update
                $upload->folder = $upload_path_author;
                if (CUploadedFile::getInstance($model, 'feature_image') != NULL) {
                    $upload->old_file = $model->feature_image;
                    $upload->post = $model->feature_image = CUploadedFile::getInstance($model, 'feature_image');
                    $model->feature_image = $upload->normal();
                }

                foreach (Yii::app()->params['translatedLanguages'] as $l => $lang) {
                    if ($l === Yii::app()->params['defaultLanguage']) {
                        // upload soundtrack - update
                        $upload->folder = $upload_path_media;
                        if (CUploadedFile::getInstance($model, 'soundtrack') != NULL) {
                            $upload->old_file = $model->soundtrack;
                            $upload->post = $model->soundtrack = CUploadedFile::getInstance($model, 'soundtrack');
                            $model->soundtrack = $upload->media();
                        }
                        // title, slug
                        $title = $_POST['Post']['post_title'];
                        $slug = $_POST['Post']['slug'];
                        if ($_POST['Post']['slug'] == '') {
                            // auto make slug from name
                            $model->slug = Slug::create($title);
                        } else {
                            // make slug from slug input
                            $model->slug = Slug::create($slug);
                        }
                        // convert title to alphabet
                        $model->post_title_clean = Slug::to_alphabet($title);
                    } else {
                        // upload soundtrack - update
                        $upload->folder = $upload_path_media;
                        $l_soundtrack = 'soundtrack_' . $l;
                        if (CUploadedFile::getInstance($model, $l_soundtrack) != NULL) {
                            $upload->old_file = $model->{$l_soundtrack};
                            $upload->post = $model->{$l_soundtrack} = CUploadedFile::getInstance($model, $l_soundtrack);
                            $model->{$l_soundtrack} = $upload->media();
                        }
                        // title, slug
                        $l_slug = 'slug_' . $l;
                        $l_title = 'post_title_' . $l;
                        $title = $_POST['Post'][$l_title];
                        $slug = $_POST['Post'][$l_slug];
                        if ($_POST['Post'][$l_slug] == '') {
                            // auto make slug from name
                            $model->{$l_slug} = Slug::create($title);
                        } else {
                            // make slug from slug input
                            $model->{$l_slug} = Slug::create($slug);
                        }
                        // convert title to alphabet
                        $l_post_title_clean = 'post_title_clean_' . $l;
                        $model->{$l_post_title_clean} = Slug::to_alphabet($title);
                    }
                }

                /*                 * *** */

                if ($model->save()) {

                    $model_term_relationships->object_id = $model->id;

                    //delete all relationships
                    $model_term_relationships->deleteAllByAttributes(array('object_id' => (int) $id));

                    //relations with category
                    if (isset($_POST['Post']['category'])) {
                        $categories_id = $_POST['Post']['category'];
                        if ($categories_id != NULL) {
                            foreach ($categories_id as $value) {
                                $model_term_relationships->term_taxonomy_id = $value;
                                $model_term_relationships->isNewRecord = true;
                                $model_term_relationships->save();
                            }
                        }
                    }

                    // relations with tags
                    if (isset($_POST['Post']['tags'])) {

                        $this->create_tags($_POST['Post']['tags']);

                        $tags_id = $this->get_tags($_POST['Post']['tags']);
                        $i = 0;
                        foreach ($tags_id as $value) {
                            $model_term_relationships->term_taxonomy_id = $value;
                            $model_term_relationships->term_order = $i++;
                            $model_term_relationships->isNewRecord = true;
                            $model_term_relationships->save();
                        }
                    }

                    // redirect
                    $this->redirect(array('updateQuote', 'id' => $id));
                }
            }
        }

        $this->render('quote/_form', array(
            'form_title' => $form_title,
            'update' => $update,
            'model' => $model,
            'tags_json' => (isset($_POST['Post']['tags'])) ? $_POST['Post']['tags'] : $tags_json,
            'select_categories' => $select_categories,
        ));
    }

    public function actionAddQuote() {

        $form_title = 'Add New Quote';
        $update = 0;

        $tags_json = '[""]';
        $select_categories = array();

        $model = new Post;
        $model_term_relationships = new TermRelationships;

        // for upload
        $cf = Yii::app()->file;
        $upload_path = Yii::app()->params['set_quote_path'];
        $cf->createDir(0755, $upload_path);
        //
        $upload_path_author = Yii::app()->params['set_author_path'];
        $cf->createDir(0755, $upload_path_author);
        //
        $upload_path_media = Yii::app()->params['set_quote_sound_path'];
        $cf->createDir(0755, $upload_path_media);
        //
        $upload = Yii::app()->upload;
        $upload->folder = $upload_path;

        if (isset($_POST['Post'])) {

            $model->attributes = $_POST['Post'];

            $select_categories = isset($_POST['Post']['category']) ? $_POST['Post']['category'] : NULL;

            if ($model->validate()) {

                // upload image
                if (CUploadedFile::getInstance($model, 'image') != NULL) {
                    $upload->post = $model->image = CUploadedFile::getInstance($model, 'image');
                    $model->image = $upload->normal();
                }
                // upload author image - update
                $upload->folder = $upload_path_author;
                if (CUploadedFile::getInstance($model, 'feature_image') != NULL) {
                    $upload->post = $model->feature_image = CUploadedFile::getInstance($model, 'feature_image');
                    $model->feature_image = $upload->normal();
                }

                foreach (Yii::app()->params['translatedLanguages'] as $l => $lang) {
                    if ($l === Yii::app()->params['defaultLanguage']) {
                        // upload soundtrack
                        $upload->folder = $upload_path_media;
                        if (CUploadedFile::getInstance($model, 'soundtrack') != NULL) {
                            $upload->post = $model->soundtrack = CUploadedFile::getInstance($model, 'soundtrack');
                            $model->soundtrack = $upload->media();
                        }
                        // title, slug
                        $title = $_POST['Post']['post_title'];
                        $slug = $_POST['Post']['slug'];
                        if ($_POST['Post']['slug'] == '') {
                            // auto make slug from name
                            $model->slug = Slug::create($title);
                        } else {
                            // make slug from slug input
                            $model->slug = Slug::create($slug);
                        }
                        // convert title to alphabet
                        $model->post_title_clean = Slug::to_alphabet($title);
                    } else {
                        // upload soundtrack
                        $upload->folder = $upload_path_media;
                        $l_soundtrack = 'soundtrack_' . $l;
                        if (CUploadedFile::getInstance($model, $l_soundtrack) != NULL) {
                            $upload->post = $model->{$l_soundtrack} = CUploadedFile::getInstance($model, $l_soundtrack);
                            $model->{$l_soundtrack} = $upload->media();
                        }
                        // title, slug
                        $l_slug = 'slug_' . $l;
                        $l_title = 'post_title_' . $l;
                        $title = $_POST['Post'][$l_title];
                        $slug = $_POST['Post'][$l_slug];
                        if ($_POST['Post'][$l_slug] == '') {
                            // auto make slug from name
                            $model->{$l_slug} = Slug::create($title);
                        } else {
                            // make slug from slug input
                            $model->{$l_slug} = Slug::create($slug);
                        }
                        // convert title to alphabet
                        $l_post_title_clean = 'post_title_clean_' . $l;
                        $model->{$l_post_title_clean} = Slug::to_alphabet($title);
                    }
                }

                $model->post_type = 'quote';

                /*                 * * * */

                if ($model->save()) {

                    $model_term_relationships->object_id = $model->id;

                    $model->refresh_menu_order('quote');
//                    $model->rearrange_menu_order('quote');
                    //relations with category
                    if (isset($_POST['Post']['category'])) {
                        $categories_id = $_POST['Post']['category'];
                        if ($categories_id != NULL) {
                            foreach ($categories_id as $value) {
                                $model_term_relationships->term_taxonomy_id = $value;
                                $model_term_relationships->isNewRecord = true;
                                $model_term_relationships->save();
                            }
                        }
                    }

                    // relations with tags
                    if (isset($_POST['Post']['tags'])) {
                        $this->create_tags($_POST['Post']['tags']);

                        $tags_id = $this->get_tags($_POST['Post']['tags']);
                        $i = 0;
                        foreach ($tags_id as $value) {
                            $model_term_relationships->term_taxonomy_id = $value;
                            $model_term_relationships->term_order = $i++;
                            $model_term_relationships->isNewRecord = true;
                            $model_term_relationships->save();
                        }
                    }

                    // redirect
                    $this->redirect(array('updateQuote', 'id' => $model->id));
                }
            }
        }

        $this->render('quote/_form', array(
            'form_title' => $form_title,
            'update' => $update,
            'model' => $model,
            'tags_json' => (isset($_POST['Post']['tags'])) ? $_POST['Post']['tags'] : $tags_json,
            'select_categories' => $select_categories,
        ));
    }

    /* Quote - End */

    /* Book - Begin */

    public function actionSortBook() {
        parse_str($_POST['order'], $data);

        if (is_array($data)) {
            $id_arr = array();
            foreach ($data as $key => $values) {
                foreach ($values as $position => $id) {
                    $id_arr[] = $id;
                }
            }
            $menu_order_arr = array();
            foreach ($id_arr as $key => $id) {
                $results = Post::model()->get_menu_order_by_id($id);
                foreach ($results as $result) {
                    $menu_order_arr[] = $result->menu_order;
                }
            }
            sort($menu_order_arr);
            foreach ($data as $key => $values) {
                foreach ($values as $position => $id) {
                    Post::model()->update_menu_order($menu_order_arr[$position], $id);
                }
            }
        }
    }

    public function actionStatusBook() {

        $id = $_POST['id'];
        $model = Post::model()->change_status($id, 'book');

        echo $model->disp_flag;
    }

    public function actionDeleteBook() {

        $id = $_POST['id'];
        $post_type = 'book';

        $module_user = Yii::app()->getModule('user');
        $admin = $module_user->isAdmin();

        if ($admin == 1) {
            echo Post::model()->delete_post($id, $post_type);
        } elseif ($admin == 2) {
            echo Post::model()->delete_post($id, $post_type, Yii::app()->user->user_id);
        }
    }

    public function actionBook() {

        $model = new Post;
        $item_count = 0;
        $page_size = Yii::app()->params['pageSize'];
        $condition = '';
        $pages = NULL;
        $post_type = 'book';
        $keyword = '';

        $model->refresh_menu_order($post_type);

        if (isset($_REQUEST['keyword'])) {
            $keyword = $_REQUEST['keyword'];
        }

        $module_user = Yii::app()->getModule('user');
        $admin = $module_user->isAdmin();

        if ($admin == 1) {
            // administrator, see all stories of another
            $condition = " post_type = '$post_type' AND disp_flag = 1 ";
            if (trim($keyword) != '') {
                $keyword = Common::clean_text($keyword);
                $t_keys = Common::make_keywords($keyword);
                $condition .= " AND (post_title LIKE '%$keyword%' ";
                foreach ($t_keys as $key) {
                    $condition .= " OR post_title LIKE '%$key%' ";
                    $condition .= " OR quote_author LIKE '%$key%' ";
                }
                $condition .= ")";
            }
            $item_count = $model->count($condition);

            // the pagination itself
            $pages = new CPagination($item_count);
            $pages->setPageSize($page_size);
            if (trim($keyword) != '') {
                $pages->params = array('keyword' => $keyword);
            }

            $criteria = new CDbCriteria(array(
                'condition' => $condition,
                'order' => 'menu_order',
                'limit' => $pages->limit,
                'offset' => $pages->offset,
            ));

            $posts = $model->multilang()->findAll($criteria);
        } elseif ($admin == 2) {
            // normal admin, only see what they posted
            $condition = " post_type = '$post_type' AND disp_flag = 1 AND post_author = " . Yii::app()->user->user_id;
            if (trim($keyword) != '') {
                $t_keys = Common::make_keywords($keyword);
                $condition .= " AND (post_title LIKE '%$keyword%' ";
                foreach ($t_keys as $key) {
                    $condition .= " OR post_title LIKE '%$key%' ";
                }
                $condition .= ")";
            }
            $item_count = $model->count($condition);

            // the pagination itself
            $pages = new CPagination($item_count);
            $pages->setPageSize($page_size);
            if (trim($keyword) != '') {
                $pages->params = array('keyword' => $keyword);
            }

            $criteria = new CDbCriteria(array(
                'condition' => $condition,
                'order' => 'menu_order',
                'limit' => $pages->limit,
                'offset' => $pages->offset,
            ));

            $posts = $model->multilang()->findAll($criteria);
        }

        $this->render('book/index', array(
            'posts' => $posts,
            'item_count' => $item_count,
            'page_size' => $page_size,
            'pages' => $pages,
            'keyword' => $keyword,
        ));
    }
    
    public function actionBookHiddenList() {

        $model = new Post;
        $item_count = 0;
        $page_size = Yii::app()->params['pageSize'];
        $condition = '';
        $pages = NULL;
        $post_type = 'book';
        $keyword = '';

        $model->refresh_menu_order($post_type);

        if (isset($_REQUEST['keyword'])) {
            $keyword = $_REQUEST['keyword'];
        }

        $module_user = Yii::app()->getModule('user');
        $admin = $module_user->isAdmin();

        if ($admin == 1) {
            // administrator, see all stories of another
            $condition = " post_type = '$post_type' AND disp_flag = 0 ";
            if (trim($keyword) != '') {
                $keyword = Common::clean_text($keyword);
                $t_keys = Common::make_keywords($keyword);
                $condition .= " AND (post_title LIKE '%$keyword%' ";
                foreach ($t_keys as $key) {
                    $condition .= " OR post_title LIKE '%$key%' ";
                    $condition .= " OR quote_author LIKE '%$key%' ";
                }
                $condition .= ")";
            }
            $item_count = $model->count($condition);

            // the pagination itself
            $pages = new CPagination($item_count);
            $pages->setPageSize($page_size);
            if (trim($keyword) != '') {
                $pages->params = array('keyword' => $keyword);
            }

            $criteria = new CDbCriteria(array(
                'condition' => $condition,
                'order' => 'menu_order',
                'limit' => $pages->limit,
                'offset' => $pages->offset,
            ));

            $posts = $model->multilang()->findAll($criteria);
        } elseif ($admin == 2) {
            // normal admin, only see what they posted
            $condition = " post_type = '$post_type' AND disp_flag = 0 AND post_author = " . Yii::app()->user->user_id;
            if (trim($keyword) != '') {
                $t_keys = Common::make_keywords($keyword);
                $condition .= " AND (post_title LIKE '%$keyword%' ";
                foreach ($t_keys as $key) {
                    $condition .= " OR post_title LIKE '%$key%' ";
                }
                $condition .= ")";
            }
            $item_count = $model->count($condition);

            // the pagination itself
            $pages = new CPagination($item_count);
            $pages->setPageSize($page_size);
            if (trim($keyword) != '') {
                $pages->params = array('keyword' => $keyword);
            }

            $criteria = new CDbCriteria(array(
                'condition' => $condition,
                'order' => 'menu_order',
                'limit' => $pages->limit,
                'offset' => $pages->offset,
            ));

            $posts = $model->multilang()->findAll($criteria);
        }

        $this->render('book/index', array(
            'posts' => $posts,
            'item_count' => $item_count,
            'page_size' => $page_size,
            'pages' => $pages,
            'keyword' => $keyword,
        ));
    }

    public function actionUpdateBook($id) {

        $form_title = 'Update Book';
        $update = 1;

        $tags_arr = array();
        $tags_json = '[""]';
        $select_categories = array();

        $model = $this->loadModel($id, true);
        $model_term_relationships = new TermRelationships;

        // for upload
        $cf = Yii::app()->file;
        $upload_path = Yii::app()->params['set_book_path'];
        $cf->createDir(0755, $upload_path);
        //
        $upload_path_author = Yii::app()->params['set_author_path'];
        $cf->createDir(0755, $upload_path_author);
        //
        $upload = Yii::app()->upload;
        $upload->folder = $upload_path;

        if (!isset($_POST['Post']['category'])) {
            $hold_categories = array();
            $categories = $model_term_relationships->get_relate_terms((int) $id, 'category')->findAll();
            if ($categories != NULL) {
                foreach ($categories as $row) {
                    $select_categories[] = $row->term_taxonomy_id;
                }
            }
        } else {
            $select_categories = $_POST['Post']['category'];
        }

        if (!isset($_POST['Post']['tags'])) {
            $tags = $model_term_relationships->get_relate_terms((int) $id, 'tag')->findAll();
            if ($tags != NULL) {
                foreach ($tags as $row) {
                    $tags_arr[] = $row->termtaxonomy->terms['name'];
                }
                $tags_json = json_encode($tags_arr);
            }
        }

        if (isset($_POST['Post'])) {
            $model->attributes = $_POST['Post'];

            if ($model->validate()) {

                // upload image - update
                if (CUploadedFile::getInstance($model, 'image') != NULL) {
                    $upload->old_file = $model->image;
                    $upload->post = $model->image = CUploadedFile::getInstance($model, 'image');
                    $model->image = $upload->normal();
                }
                // upload author image - update
                $upload->folder = $upload_path_author;
                if (CUploadedFile::getInstance($model, 'feature_image') != NULL) {
                    $upload->old_file = $model->feature_image;
                    $upload->post = $model->feature_image = CUploadedFile::getInstance($model, 'feature_image');
                    $model->feature_image = $upload->normal();
                }

                $upload->folder = $upload_path;

                foreach (Yii::app()->params['translatedLanguages'] as $l => $lang) {
                    if ($l === Yii::app()->params['defaultLanguage']) {
                        // upload book cover - update
                        if (CUploadedFile::getInstance($model, 'cover') != NULL) {
                            $upload->old_file = $model->cover;
                            $upload->post = $model->cover = CUploadedFile::getInstance($model, 'cover');
                            $model->cover = $upload->normal();
                        }
                        // title, slug
                        $title = $_POST['Post']['post_title'];
                        $slug = $_POST['Post']['slug'];
                        if ($_POST['Post']['slug'] == '') {
                            // auto make slug from name
                            $model->slug = Slug::create($title);
                        } else {
                            // make slug from slug input
                            $model->slug = Slug::create($slug);
                        }
                        // convert title to alphabet
                        $model->post_title_clean = Slug::to_alphabet($title);
                    } else {
                        // upload image - update
                        $l_cover = 'cover_' . $l;
                        if (CUploadedFile::getInstance($model, $l_cover) != NULL) {
                            $upload->old_file = $model->{$l_cover};
                            $upload->post = $model->{$l_cover} = CUploadedFile::getInstance($model, $l_cover);
                            $model->{$l_cover} = $upload->normal();
                        }
                        // title, slug
                        $l_slug = 'slug_' . $l;
                        $l_title = 'post_title_' . $l;
                        $title = $_POST['Post'][$l_title];
                        $slug = $_POST['Post'][$l_slug];
                        if ($_POST['Post'][$l_slug] == '') {
                            // auto make slug from name
                            $model->{$l_slug} = Slug::create($title);
                        } else {
                            // make slug from slug input
                            $model->{$l_slug} = Slug::create($slug);
                        }
                        // convert title to alphabet
                        $l_post_title_clean = 'post_title_clean_' . $l;
                        $model->{$l_post_title_clean} = Slug::to_alphabet($title);
                    }
                }

                /*                 * *** */

                if ($model->save()) {

                    $model_term_relationships->object_id = $model->id;

                    //delete all relationships
                    $model_term_relationships->deleteAllByAttributes(array('object_id' => (int) $id));

                    //relations with category
                    if (isset($_POST['Post']['category'])) {
                        $categories_id = $_POST['Post']['category'];
                        if ($categories_id != NULL) {
                            foreach ($categories_id as $value) {
                                $model_term_relationships->term_taxonomy_id = $value;
                                $model_term_relationships->isNewRecord = true;
                                $model_term_relationships->save();
                            }
                        }
                    }

                    // relations with tags
                    if (isset($_POST['Post']['tags'])) {
                        $this->create_tags($_POST['Post']['tags']);

                        $tags_id = $this->get_tags($_POST['Post']['tags']);
                        $i = 0;
                        foreach ($tags_id as $value) {
                            $model_term_relationships->term_taxonomy_id = $value;
                            $model_term_relationships->term_order = $i++;
                            $model_term_relationships->isNewRecord = true;
                            $model_term_relationships->save();
                        }
                    }

                    // redirect
                    $this->redirect(array('updateBook', 'id' => $id));
                }
            }
        }

        $this->render('book/_form', array(
            'form_title' => $form_title,
            'update' => $update,
            'model' => $model,
            'tags_json' => (isset($_POST['Post']['tags'])) ? $_POST['Post']['tags'] : $tags_json,
            'select_categories' => $select_categories,
        ));
    }

    public function actionAddBook() {

        $form_title = 'Add New Book';
        $update = 0;

        $tags_json = '[""]';
        $select_categories = array();

        $model = new Post;
        $model_term_relationships = new TermRelationships;

        // for upload
        $cf = Yii::app()->file;
        $upload_path = Yii::app()->params['set_book_path'];
        $cf->createDir(0755, $upload_path);
        //
        $upload_path_author = Yii::app()->params['set_author_path'];
        $cf->createDir(0755, $upload_path_author);
        //
        $upload = Yii::app()->upload;
        $upload->folder = $upload_path;

        if (isset($_POST['Post'])) {

            $model->attributes = $_POST['Post'];

            $select_categories = isset($_POST['Post']['category']) ? $_POST['Post']['category'] : NULL;

            if ($model->validate()) {

                // upload image
                if (CUploadedFile::getInstance($model, 'image') != NULL) {
                    $upload->post = $model->image = CUploadedFile::getInstance($model, 'image');
                    $model->image = $upload->normal();
                }
                // upload author image - update
                $upload->folder = $upload_path_author;
                if (CUploadedFile::getInstance($model, 'feature_image') != NULL) {
                    $upload->post = $model->feature_image = CUploadedFile::getInstance($model, 'feature_image');
                    $model->feature_image = $upload->normal();
                }

                $upload->folder = $upload_path;

                foreach (Yii::app()->params['translatedLanguages'] as $l => $lang) {
                    if ($l === Yii::app()->params['defaultLanguage']) {
                        // upload book cover
                        if (CUploadedFile::getInstance($model, 'cover') != NULL) {
                            $upload->post = $model->cover = CUploadedFile::getInstance($model, 'cover');
                            $model->cover = $upload->normal();
                        }
                        // title, slug
                        $title = $_POST['Post']['post_title'];
                        $slug = $_POST['Post']['slug'];
                        if ($_POST['Post']['slug'] == '') {
                            // auto make slug from name
                            $model->slug = Slug::create($title);
                        } else {
                            // make slug from slug input
                            $model->slug = Slug::create($slug);
                        }
                        // convert title to alphabet
                        $model->post_title_clean = Slug::to_alphabet($title);
                    } else {
                        // upload book cover
                        $l_cover = 'cover_' . $l;
                        if (CUploadedFile::getInstance($model, $l_cover) != NULL) {
                            $upload->post = $model->{$l_cover} = CUploadedFile::getInstance($model, $l_cover);
                            $model->{$l_cover} = $upload->normal();
                        }
                        // title, slug
                        $l_slug = 'slug_' . $l;
                        $l_title = 'post_title_' . $l;
                        $title = $_POST['Post'][$l_title];
                        $slug = $_POST['Post'][$l_slug];
                        if ($_POST['Post'][$l_slug] == '') {
                            // auto make slug from name
                            $model->{$l_slug} = Slug::create($title);
                        } else {
                            // make slug from slug input
                            $model->{$l_slug} = Slug::create($slug);
                        }
                        // convert title to alphabet
                        $l_post_title_clean = 'post_title_clean_' . $l;
                        $model->{$l_post_title_clean} = Slug::to_alphabet($title);
                    }
                }

                $model->post_type = 'book';

                /*                 * * * */

                if ($model->save()) {

                    $model_term_relationships->object_id = $model->id;

                    $model->refresh_menu_order('book');
//                    $model->rearrange_menu_order('book');
                    //relations with category
                    if (isset($_POST['Post']['category'])) {
                        $categories_id = $_POST['Post']['category'];
                        if ($categories_id != NULL) {
                            foreach ($categories_id as $value) {
                                $model_term_relationships->term_taxonomy_id = $value;
                                $model_term_relationships->isNewRecord = true;
                                $model_term_relationships->save();
                            }
                        }
                    }

                    // relations with tags
                    if (isset($_POST['Post']['tags'])) {
                        $this->create_tags($_POST['Post']['tags']);

                        $tags_id = $this->get_tags($_POST['Post']['tags']);
                        $i = 0;
                        foreach ($tags_id as $value) {
                            $model_term_relationships->term_taxonomy_id = $value;
                            $model_term_relationships->term_order = $i++;
                            $model_term_relationships->isNewRecord = true;
                            $model_term_relationships->save();
                        }
                    }

                    // redirect
                    $this->redirect(array('updateBook', 'id' => $model->id));
                }
            }
        }

        $this->render('book/_form', array(
            'form_title' => $form_title,
            'update' => $update,
            'model' => $model,
            'tags_json' => (isset($_POST['Post']['tags'])) ? $_POST['Post']['tags'] : $tags_json,
            'select_categories' => $select_categories,
        ));
    }

    public function actionRemoveMedia() {
        
    }

    /* Book - End */

    /* Music - Begin */

    public function actionSortMusic() {
        parse_str($_POST['order'], $data);

        if (is_array($data)) {
            $id_arr = array();
            foreach ($data as $key => $values) {
                foreach ($values as $position => $id) {
                    $id_arr[] = $id;
                }
            }
            $menu_order_arr = array();
            foreach ($id_arr as $key => $id) {
                $results = Post::model()->get_menu_order_by_id($id);
                foreach ($results as $result) {
                    $menu_order_arr[] = $result->menu_order;
                }
            }
            sort($menu_order_arr);
            foreach ($data as $key => $values) {
                foreach ($values as $position => $id) {
                    Post::model()->update_menu_order($menu_order_arr[$position], $id);
                }
            }
        }
    }

    public function actionStatusMusic() {

        $id = $_POST['id'];
        $model = Post::model()->change_status($id, 'music');

        echo $model->disp_flag;
    }

    public function actionDeleteMusic() {

        $id = $_POST['id'];
        $post_type = 'music';

        $module_user = Yii::app()->getModule('user');
        $admin = $module_user->isAdmin();

        if ($admin == 1) {
            echo Post::model()->delete_post($id, $post_type);
        } elseif ($admin == 2) {
            echo Post::model()->delete_post($id, $post_type, Yii::app()->user->user_id);
        }
    }

    public function actionMusic() {

        $model = new Post;
        $item_count = 0;
        $page_size = Yii::app()->params['pageSize'];
        $condition = '';
        $pages = NULL;
        $post_type = 'music';
        $keyword = '';

        $model->refresh_menu_order($post_type);

        if (isset($_REQUEST['keyword'])) {
            $keyword = $_REQUEST['keyword'];
        }

        $module_user = Yii::app()->getModule('user');
        $admin = $module_user->isAdmin();

        if ($admin == 1) {
            // administrator, see all stories of another
            $condition = " post_type = '$post_type' AND disp_flag = 1 ";
            if (trim($keyword) != '') {
                $keyword = Common::clean_text($keyword);
                $t_keys = Common::make_keywords($keyword);
                $condition .= " AND (post_title LIKE '%$keyword%' ";
                foreach ($t_keys as $key) {
                    $condition .= " OR post_title LIKE '%$key%' ";
                    $condition .= " OR quote_author LIKE '%$key%' ";
                }
                $condition .= ")";
            }
            $item_count = $model->count($condition);

            // the pagination itself
            $pages = new CPagination($item_count);
            $pages->setPageSize($page_size);
            if (trim($keyword) != '') {
                $pages->params = array('keyword' => $keyword);
            }

            $criteria = new CDbCriteria(array(
                'condition' => $condition,
                'order' => 'menu_order',
                'limit' => $pages->limit,
                'offset' => $pages->offset,
            ));

            $posts = $model->multilang()->findAll($criteria);
        } elseif ($admin == 2) {
            // normal admin, only see what they posted
            $condition = " post_type = '$post_type' AND disp_flag = 1 AND post_author = " . Yii::app()->user->user_id;
            if (trim($keyword) != '') {
                $t_keys = Common::make_keywords($keyword);
                $condition .= " AND (post_title LIKE '%$keyword%' ";
                foreach ($t_keys as $key) {
                    $condition .= " OR post_title LIKE '%$key%' ";
                }
                $condition .= ")";
            }
            $item_count = $model->count($condition);

            // the pagination itself
            $pages = new CPagination($item_count);
            $pages->setPageSize($page_size);
            if (trim($keyword) != '') {
                $pages->params = array('keyword' => $keyword);
            }

            $criteria = new CDbCriteria(array(
                'condition' => $condition,
                'order' => 'menu_order',
                'limit' => $pages->limit,
                'offset' => $pages->offset,
            ));

            $posts = $model->multilang()->findAll($criteria);
        }

        $this->render('music/index', array(
            'posts' => $posts,
            'item_count' => $item_count,
            'page_size' => $page_size,
            'pages' => $pages,
            'keyword' => $keyword,
        ));
    }
    
    public function actionMusicHiddenList() {

        $model = new Post;
        $item_count = 0;
        $page_size = Yii::app()->params['pageSize'];
        $condition = '';
        $pages = NULL;
        $post_type = 'music';
        $keyword = '';

        $model->refresh_menu_order($post_type);

        if (isset($_REQUEST['keyword'])) {
            $keyword = $_REQUEST['keyword'];
        }

        $module_user = Yii::app()->getModule('user');
        $admin = $module_user->isAdmin();

        if ($admin == 1) {
            // administrator, see all stories of another
            $condition = " post_type = '$post_type' AND disp_flag = 0 ";
            if (trim($keyword) != '') {
                $keyword = Common::clean_text($keyword);
                $t_keys = Common::make_keywords($keyword);
                $condition .= " AND (post_title LIKE '%$keyword%' ";
                foreach ($t_keys as $key) {
                    $condition .= " OR post_title LIKE '%$key%' ";
                    $condition .= " OR quote_author LIKE '%$key%' ";
                }
                $condition .= ")";
            }
            $item_count = $model->count($condition);

            // the pagination itself
            $pages = new CPagination($item_count);
            $pages->setPageSize($page_size);
            if (trim($keyword) != '') {
                $pages->params = array('keyword' => $keyword);
            }

            $criteria = new CDbCriteria(array(
                'condition' => $condition,
                'order' => 'menu_order',
                'limit' => $pages->limit,
                'offset' => $pages->offset,
            ));

            $posts = $model->multilang()->findAll($criteria);
        } elseif ($admin == 2) {
            // normal admin, only see what they posted
            $condition = " post_type = '$post_type' AND disp_flag = 0 AND post_author = " . Yii::app()->user->user_id;
            if (trim($keyword) != '') {
                $t_keys = Common::make_keywords($keyword);
                $condition .= " AND (post_title LIKE '%$keyword%' ";
                foreach ($t_keys as $key) {
                    $condition .= " OR post_title LIKE '%$key%' ";
                }
                $condition .= ")";
            }
            $item_count = $model->count($condition);

            // the pagination itself
            $pages = new CPagination($item_count);
            $pages->setPageSize($page_size);
            if (trim($keyword) != '') {
                $pages->params = array('keyword' => $keyword);
            }

            $criteria = new CDbCriteria(array(
                'condition' => $condition,
                'order' => 'menu_order',
                'limit' => $pages->limit,
                'offset' => $pages->offset,
            ));

            $posts = $model->multilang()->findAll($criteria);
        }

        $this->render('music/index', array(
            'posts' => $posts,
            'item_count' => $item_count,
            'page_size' => $page_size,
            'pages' => $pages,
            'keyword' => $keyword,
        ));
    }

    public function actionUpdateMusic($id) {

        $form_title = 'Update Music';
        $update = 1;

        $tags_arr = array();
        $tags_json = '[""]';
        $select_categories = array();

        $model = $this->loadModel($id, true);
        $model_term_relationships = new TermRelationships;

        // for upload
        $cf = Yii::app()->file;
        $upload_path = Yii::app()->params['set_music_path'];
        $cf->createDir(0755, $upload_path);
        //
        $upload_path_author = Yii::app()->params['set_author_path'];
        $cf->createDir(0755, $upload_path_author);
        //
        $upload = Yii::app()->upload;
        $upload->folder = $upload_path;

        if (!isset($_POST['Post']['category'])) {
            $hold_categories = array();
            $categories = $model_term_relationships->get_relate_terms((int) $id, 'category')->findAll();
            if ($categories != NULL) {
                foreach ($categories as $row) {
                    $select_categories[] = $row->term_taxonomy_id;
                }
            }
        } else {
            $select_categories = $_POST['Post']['category'];
        }

        if (!isset($_POST['Post']['tags'])) {
            $tags = $model_term_relationships->get_relate_terms((int) $id, 'tag')->findAll();
            if ($tags != NULL) {
                foreach ($tags as $row) {
                    $tags_arr[] = $row->termtaxonomy->terms['name'];
                }
                $tags_json = json_encode($tags_arr);
            }
        }

        if (isset($_POST['Post'])) {
            $model->attributes = $_POST['Post'];

            if ($model->validate()) {

                // upload image - update
                if (CUploadedFile::getInstance($model, 'image') != NULL) {
                    $upload->old_file = $model->image;
                    $upload->post = $model->image = CUploadedFile::getInstance($model, 'image');
                    $model->image = $upload->normal();
                }
                // upload author image - update
                $upload->folder = $upload_path_author;
                if (CUploadedFile::getInstance($model, 'feature_image') != NULL) {
                    $upload->old_file = $model->feature_image;
                    $upload->post = $model->feature_image = CUploadedFile::getInstance($model, 'feature_image');
                    $model->feature_image = $upload->normal();
                }

                foreach (Yii::app()->params['translatedLanguages'] as $l => $lang) {
                    if ($l === Yii::app()->params['defaultLanguage']) {
                        // title, slug
                        $title = $_POST['Post']['post_title'];
                        $slug = $_POST['Post']['slug'];
                        if ($_POST['Post']['slug'] == '') {
                            // auto make slug from name
                            $model->slug = Slug::create($title);
                        } else {
                            // make slug from slug input
                            $model->slug = Slug::create($slug);
                        }
                        // convert title to alphabet
                        $model->post_title_clean = Slug::to_alphabet($title);
                    } else {
                        // title, slug
                        $l_slug = 'slug_' . $l;
                        $l_title = 'post_title_' . $l;
                        $title = $_POST['Post'][$l_title];
                        $slug = $_POST['Post'][$l_slug];
                        if ($_POST['Post'][$l_slug] == '') {
                            // auto make slug from name
                            $model->{$l_slug} = Slug::create($title);
                        } else {
                            // make slug from slug input
                            $model->{$l_slug} = Slug::create($slug);
                        }
                        // convert title to alphabet
                        $l_post_title_clean = 'post_title_clean_' . $l;
                        $model->{$l_post_title_clean} = Slug::to_alphabet($title);
                    }
                }

                /*                 * *** */

                if ($model->save()) {

                    $model_term_relationships->object_id = $model->id;

                    //delete all relationships
                    $model_term_relationships->deleteAllByAttributes(array('object_id' => (int) $id));

                    //relations with category
                    if (isset($_POST['Post']['category'])) {
                        $categories_id = $_POST['Post']['category'];
                        if ($categories_id != NULL) {
                            foreach ($categories_id as $value) {
                                $model_term_relationships->term_taxonomy_id = $value;
                                $model_term_relationships->isNewRecord = true;
                                $model_term_relationships->save();
                            }
                        }
                    }

                    // relations with tags
                    if (isset($_POST['Post']['tags'])) {
                        $this->create_tags($_POST['Post']['tags']);

                        $tags_id = $this->get_tags($_POST['Post']['tags']);
                        $i = 0;
                        foreach ($tags_id as $value) {
                            $model_term_relationships->term_taxonomy_id = $value;
                            $model_term_relationships->term_order = $i++;
                            $model_term_relationships->isNewRecord = true;
                            $model_term_relationships->save();
                        }
                    }

                    // redirect
                    $this->redirect(array('updateMusic', 'id' => $id));
                }
            }
        }

        $this->render('music/_form', array(
            'form_title' => $form_title,
            'update' => $update,
            'model' => $model,
            'tags_json' => (isset($_POST['Post']['tags'])) ? $_POST['Post']['tags'] : $tags_json,
            'select_categories' => $select_categories,
        ));
    }

    public function actionAddMusic() {

        $form_title = 'Add New Music';
        $update = 0;

        $tags_json = '[""]';
        $select_categories = array();

        $model = new Post;
        $model_term_relationships = new TermRelationships;

        // for upload
        $cf = Yii::app()->file;
        $upload_path = Yii::app()->params['set_music_path'];
        $cf->createDir(0755, $upload_path);
        //
        $upload_path_author = Yii::app()->params['set_author_path'];
        $cf->createDir(0755, $upload_path_author);
        //
        $upload = Yii::app()->upload;
        $upload->folder = $upload_path;

        if (isset($_POST['Post'])) {

            $model->attributes = $_POST['Post'];

            $select_categories = isset($_POST['Post']['category']) ? $_POST['Post']['category'] : NULL;

            if ($model->validate()) {

                // upload image
                if (CUploadedFile::getInstance($model, 'image') != NULL) {
                    $upload->post = $model->image = CUploadedFile::getInstance($model, 'image');
                    $model->image = $upload->normal();
                }
                // upload author image - update
                $upload->folder = $upload_path_author;
                if (CUploadedFile::getInstance($model, 'feature_image') != NULL) {
                    $upload->post = $model->feature_image = CUploadedFile::getInstance($model, 'feature_image');
                    $model->feature_image = $upload->normal();
                }

                foreach (Yii::app()->params['translatedLanguages'] as $l => $lang) {
                    if ($l === Yii::app()->params['defaultLanguage']) {
                        // title, slug
                        $title = $_POST['Post']['post_title'];
                        $slug = $_POST['Post']['slug'];
                        if ($_POST['Post']['slug'] == '') {
                            // auto make slug from name
                            $model->slug = Slug::create($title);
                        } else {
                            // make slug from slug input
                            $model->slug = Slug::create($slug);
                        }
                        // convert title to alphabet
                        $model->post_title_clean = Slug::to_alphabet($title);
                    } else {
                        // title, slug
                        $l_slug = 'slug_' . $l;
                        $l_title = 'post_title_' . $l;
                        $title = $_POST['Post'][$l_title];
                        $slug = $_POST['Post'][$l_slug];
                        if ($_POST['Post'][$l_slug] == '') {
                            // auto make slug from name
                            $model->{$l_slug} = Slug::create($title);
                        } else {
                            // make slug from slug input
                            $model->{$l_slug} = Slug::create($slug);
                        }
                        // convert title to alphabet
                        $l_post_title_clean = 'post_title_clean_' . $l;
                        $model->{$l_post_title_clean} = Slug::to_alphabet($title);
                    }
                }

                $model->post_type = 'music';

                /*                 * * * */

                if ($model->save()) {

                    $model_term_relationships->object_id = $model->id;

                    $model->refresh_menu_order('music');
//                    $model->rearrange_menu_order('music');
                    //relations with category
                    if (isset($_POST['Post']['category'])) {
                        $categories_id = $_POST['Post']['category'];
                        if ($categories_id != NULL) {
                            foreach ($categories_id as $value) {
                                $model_term_relationships->term_taxonomy_id = $value;
                                $model_term_relationships->isNewRecord = true;
                                $model_term_relationships->save();
                            }
                        }
                    }

                    // relations with tags
                    if (isset($_POST['Post']['tags'])) {
                        $this->create_tags($_POST['Post']['tags']);

                        $tags_id = $this->get_tags($_POST['Post']['tags']);
                        $i = 0;
                        foreach ($tags_id as $value) {
                            $model_term_relationships->term_taxonomy_id = $value;
                            $model_term_relationships->term_order = $i++;
                            $model_term_relationships->isNewRecord = true;
                            $model_term_relationships->save();
                        }
                    }

                    // redirect
                    $this->redirect(array('updateMusic', 'id' => $model->id));
                }
            }
        }

        $this->render('music/_form', array(
            'form_title' => $form_title,
            'update' => $update,
            'model' => $model,
            'tags_json' => (isset($_POST['Post']['tags'])) ? $_POST['Post']['tags'] : $tags_json,
            'select_categories' => $select_categories,
        ));
    }

    /* Music - End */

    public function actionOrderTop() {
        $id = $_POST['id'];
        $post_type = $_POST['post_type'];
        Post::model()->order_top($id, $post_type);
        echo 1;
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Post the loaded model
     * @throws CHttpException
     */
    public function loadModel($id, $ml = false) {
        if ($ml) {
            $model = Post::model()->multilang()->findByPk((int) $id);
        } else {
            $model = Post::model()->findByPk((int) $id);
        }
        if ($model === null)
            throw new CHttpException(404, 'The requested post does not exist.');
        return $model;
    }

    /**
     * This is the action to handle external exceptions.
     */
//    public function actionError() {
//        if ($error = Yii::app()->errorHandler->error) {
//            if (Yii::app()->request->isAjaxRequest)
//                echo $error['message'];
//            else
//                $this->render('error', $error);
//        }
//    }
}
