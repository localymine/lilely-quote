<?php

/**
 * This is the model class for table "post".
 *
 * The followings are the available columns in table 'post':
 * @property string $id
 * @property string $post_author
 * @property string $post_type
 * @property string $post_group
 * @property string $post_date
 * @property string $soundtrack
 * @property string $post_title
 * @property string $about
 * @property string $post_content
 * @property string $post_excerpt
 * @property string $post_youtube
 * @property string $quote_author
 * @property string $performer
 * @property string $image
 * @property string $feature_image
 * @property string $post_title_clean
 * @property string $post_modified
 * @property string $slug
 * @property integer $disp_flag
 * @property integer $visits
 * @property integer $last_visited
 * @property integer $menu_order
 */
class Post extends CActiveRecord {

    const STATUS_SHOW = 1;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'post';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('post_title', 'required'),
            array('disp_flag', 'numerical', 'integerOnly' => true),
            array('post_author', 'length', 'max' => 20),
            array('post_type', 'length', 'max' => 45),
            array('post_title_clean, post_youtube, about, from, slug', 'length', 'max' => 512),
            array('image, feature_image', 'file', 'types' => 'jpg, gif, png', 'maxSize' => 1024 * 1024 * 10, 'allowEmpty' => true, 'on' => 'insert'), // 10MB
            array('image, feature_image', 'file', 'types' => 'jpg, gif, png', 'maxSize' => 1024 * 1024 * 10, 'allowEmpty' => true, 'on' => 'update'),
            array('soundtrack', 'file', 'types' => 'mp3', 'maxSize' => 1024 * 1024 * 10, 'allowEmpty' => true, 'on' => 'insert'), // 10MB
            array('soundtrack', 'file', 'types' => 'mp3', 'maxSize' => 1024 * 1024 * 10, 'allowEmpty' => true, 'on' => 'update'),
            array('quote_author, performer', 'length', 'max' => 128),
            array('visits, menu_order', 'numerical'),
            array('post_content, post_group, post_date, post_excerpt, post_modified, last_visited', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, post_author, post_type, post_group, post_date, post_title, about, post_content, post_excerpt, post_youtube, image, feature_image, post_title_clean, post_modified, slug, disp_flag, visits', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'post_by' => array(self::BELONGS_TO, 'AProfiles', 'post_author'),
            'post_user' => array(self::BELONGS_TO, 'AUsers', 'post_author'),
            'pick_relate' => array(self::HAS_MANY, 'PickRelationships', 'term_id'),
            'read_later' => array(self::HAS_MANY, 'ReadLater', 'object_id', 'condition' => 'user_id = ' . Yii::app()->user->id),
            'read_later_user' => array(self::HAS_MANY, 'ReadLater', 'user_id'),
            'slide_ref' => array(self::HAS_MANY, 'Slide', 'post_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'post_author' => 'Post Author',
            'post_type' => 'Post Type',
            'post_group' => 'Post Group',
            'post_date' => 'Post Date',
            'soundtrack' => 'Soundtrack',
            'post_title' => 'Post Title',
            'about' => 'About',
            'from' => 'From',
            'post_content' => 'Post Content',
            'post_excerpt' => 'Post Excerpt',
            'post_youtube' => 'Youtube Url',
            'quote_author' => 'Quote Author',
            'performer' => 'Performer',
            'image' => 'Image',
            'feature_image' => 'Feature Image',
            'post_title_clean' => 'Post Title Clean',
            'post_modified' => 'Post Modified',
            'slug' => 'Slug',
            'disp_flag' => 'Disp Flag',
            'visits' => 'Visits',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('post_author', $this->post_author, true);
        $criteria->compare('post_type', $this->post_type, true);
        $criteria->compare('post_group', $this->post_group, true);
        $criteria->compare('post_date', $this->post_date, true);
        $criteria->compare('post_title', $this->post_title, true);
        $criteria->compare('about', $this->about, true);
        $criteria->compare('post_content', $this->post_content, true);
        $criteria->compare('post_excerpt', $this->post_excerpt, true);
        $criteria->compare('post_youtube', $this->post_youtube, true);
        $criteria->compare('image', $this->image, true);
        $criteria->compare('feature_image', $this->feature_image, true);
        $criteria->compare('post_title_clean', $this->post_title_clean, true);
        $criteria->compare('post_modified', $this->post_modified, true);
        $criteria->compare('slug', $this->slug, true);
        $criteria->compare('disp_flag', $this->disp_flag);
        $criteria->compare('visits', $this->visits);

        return new CActiveDataProvider($this, array(
//            'criteria' => $criteria,
            'criteria' => $this->ml->modifySearchCriteria($criteria),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Post the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function behaviors() {
        return array(
            'ml' => array(
                'class' => 'application.models.behaviors.MultilingualBehavior',
                'langClassName' => 'PostLang',
                'langTableName' => 'post_lang',
                'langForeignKey' => 'post_id',
                'langField' => 'lang_id',
                'localizedAttributes' => array('soundtrack', 'post_title', 'post_title_clean', 'about', 'from', 'post_content', 'post_excerpt', 'post_youtube', 'cover', 'slug'), //attributes of the model to be translated
                'localizedPrefix' => 'l_',
                'languages' => Yii::app()->params['translatedLanguages'], // array of your translated languages. Example : array('fr' => 'Fran�ais', 'en' => 'English')
                'defaultLanguage' => Yii::app()->params['defaultLanguage'], //your main language. Example : 'fr'
                'createScenario' => 'insert',
                'localizedRelation' => 'i18nPost',
                'multilangRelation' => 'multilangPost',
                'forceOverwrite' => false,
                'forceDelete' => true,
                'dynamicLangClass' => true, //Set to true if you don't want to create a 'PostLang.php' in your models folder
            ),
            'sluggable' => array(
                'class' => 'ext.behaviors.SluggableBehavior.SluggableBehavior',
                'columns' => array('post_title'),
                'unique' => true,
                'update' => false,
                'useInflector' => true,
            ),
        );
    }

    public static function item_alias($type, $code = NULL) {
        $_items = array(
        );

        if (isset($code))
            return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
        else
            return isset($_items) ? $_items[$type] : false;
    }

    public function scopes() {
        return array(
            'sort_by_date' => array(
                'order' => "post_date DESC",
            )
        );
    }

    public function get_post_type($post_id) {
        $this->getDbCriteria()->mergeWith(array(
            'condition' => "id = " . (int) $post_id,
            'select' => 'post_type'
        ));
        return $this;
    }

    public function get_quote($limit = 3, $current_page = 1) {
//        $offset = $limit * ($current_page - 1);
        $offset = $current_page;

        $this->getDbCriteria()->mergeWith(array(
            'condition' => "disp_flag = " . self::STATUS_SHOW . " AND post_type = 'quote' ",
//            'order' => 'post_date DESC',
            'order' => 'menu_order',
            'limit' => $limit,
            'offset' => $offset,
        ));

        return $this;
    }

    public function get_book($limit = 3, $current_page = 1) {
        $offset = $limit * ($current_page - 1);

        $this->getDbCriteria()->mergeWith(array(
            'condition' => "disp_flag = " . self::STATUS_SHOW . " AND post_type = 'book' ",
//            'order' => 'post_date DESC',
            'order' => 'menu_order',
            'limit' => $limit,
            'offset' => $offset,
        ));

        return $this;
    }

    public function get_music($limit = 3, $current_page = 1) {
//        $offset = $limit * ($current_page - 1);
        $offset = $current_page;

        $this->getDbCriteria()->mergeWith(array(
            'condition' => "disp_flag = " . self::STATUS_SHOW . " AND post_type = 'music' ",
//            'order' => 'post_date DESC',
            'order' => 'menu_order',
            'limit' => $limit,
            'offset' => $offset,
        ));

        return $this;
    }

    public function get_lastest($limit = 3, $current_page = 1) {
        $offset = $limit * ($current_page - 1);

        $rand = Yii::app()->user->getState('rand');

        $this->getDbCriteria()->mergeWith(array(
            'condition' => "disp_flag = " . self::STATUS_SHOW,
//            'order' => 'post_date DESC, visits DESC, RAND()',
            'order' => "RAND($rand), last_visited DESC, post_date DESC",
            'limit' => $limit,
            'offset' => $offset,
            'having' => 'last_visited < current_date + interval 7 day',
        ));

        return $this;
    }

    public function get_lastest_sidebar($id = 1, $limit = 3, $current_page = 1) {
        $offset = $limit * ($current_page - 1);

        $this->getDbCriteria()->mergeWith(array(
            'condition' => "disp_flag = " . self::STATUS_SHOW . " AND id < $id ",
            'order' => 'post_date DESC',
            'limit' => $limit,
            'offset' => $offset,
        ));

        return $this;
    }

    public function get_quote_of_day($limit = 3, $current_page = 1) {
        $offset = $limit * ($current_page - 1);

        $today = date('Y-m-d');

        $this->getDbCriteria()->mergeWith(array(
            'condition' => "disp_flag = " . self::STATUS_SHOW . " AND post_date LIKE '$today%' ",
            'order' => 'post_date DESC',
            'limit' => $limit,
            'offset' => $offset,
        ));

        return $this;
    }

    public function get_famous_quotes($limit = 3, $current_page = 1) {
        $offset = $limit * ($current_page - 1);

        $this->getDbCriteria()->mergeWith(array(
            'condition' => "disp_flag = " . self::STATUS_SHOW . " AND post_type ='quote' AND visits > 0 ",
            'order' => 'visits DESC, post_title',
            'limit' => $limit,
            'offset' => $offset,
        ));

        return $this;
    }

    public function get_best_book_of_month($limit = 3, $current_page = 1) {
        $offset = $limit * ($current_page - 1);

        $month = date('Y-m');

        $this->getDbCriteria()->mergeWith(array(
            'condition' => "disp_flag = " . self::STATUS_SHOW . " AND post_type ='book' AND post_date LIKE '$month%' AND visits > 0",
            'order' => 'visits DESC, post_title',
            'limit' => $limit,
            'offset' => $offset,
        ));

        return $this;
    }

    public function get_post_by_author($alphabet, $limit = 3, $current_page = 1) {

        $offset = $limit * ($current_page - 1);

        $alphabet = strtolower(trim($alphabet));
        if (strlen($alphabet) > 1) {
            $alphabet = 'a';
        }

        $this->getDbCriteria()->mergeWith(array(
            'condition' => "disp_flag = " . self::STATUS_SHOW . " AND LOWER(quote_author) LIKE '$alphabet%'",
            'order' => 'quote_author, visits DESC',
            'limit' => $limit,
            'offset' => $offset,
        ));

        return $this;
    }

    public function get_post_by_slug($slug, $post_type = 'quote') {

        $this->getDbCriteria()->mergeWith(array(
            'condition' => "disp_flag = " . self::STATUS_SHOW . " AND post_type = '$post_type' AND (slug = '$slug' OR l_slug = '$slug')",
        ));

        return $this;
    }

    public function get_post_by_term($id, $limit = 3, $current_page = 1) {

        $offset = $limit * ($current_page - 1);

        $this->getDbCriteria()->mergeWith(array(
            'condition' => "disp_flag = " . self::STATUS_SHOW . " AND term_taxonomy_id = " . (int) $id,
            'join' => "LEFT JOIN term_relationships ON id = object_id",
            'limit' => $limit,
            'offset' => $offset,
        ));

        return $this;
    }

    public function get_post_by_term_post_type($id, $post_type = 'quote', $limit = 3, $current_page = 1) {

        $offset = $limit * ($current_page - 1);

        $this->getDbCriteria()->mergeWith(array(
            'condition' => "post_type LIKE '$post_type' AND disp_flag = " . self::STATUS_SHOW . " AND term_taxonomy_id = " . (int) $id,
            'join' => "LEFT JOIN term_relationships ON id = object_id",
            'limit' => $limit,
            'offset' => $offset,
        ));

        return $this;
    }

    public function get_relation_post_by_term($term_id, $obj_id, $post_type = 'quote', $limit = 3, $current_page = 1) {

        $offset = $limit * ($current_page - 1);

        $this->getDbCriteria()->mergeWith(array(
            'condition' => "disp_flag = " . self::STATUS_SHOW . " AND term_taxonomy_id = " . (int) $term_id . " AND post_type LIKE '$post_type'" . " AND object_id != " . (int) $obj_id,
            'join' => "LEFT JOIN term_relationships ON id = object_id",
            'limit' => $limit,
            'offset' => $offset,
            'order' => 'RAND()',
        ));

        return $this;
    }

    public function get_post_random($obj_id, $post_type = 'quote', $limit = 3, $current_page = 1) {

        $offset = $limit * ($current_page - 1);

        $this->getDbCriteria()->mergeWith(array(
            'condition' => "disp_flag = " . self::STATUS_SHOW . " AND post_type LIKE '$post_type'" . " AND id != " . (int) $obj_id,
            'limit' => $limit,
            'offset' => $offset,
            'order' => 'RAND()',
        ));

        return $this;
    }

    /* ---------- Search Engine ---------------- */

    public function all_condition($keyword) {
        $condition = " disp_flag = " . self::STATUS_SHOW . " ";
        if (trim($keyword) != '') {
            $keyword = Common::clean_text($keyword);
            $keyword = trim(Slug::to_alphabet($keyword));
            $t_keys = Common::make_keywords($keyword);
            $condition .= " AND (post_title_clean LIKE '%$keyword%' ";
            foreach ($t_keys as $key) {
                $condition .= " OR post_title LIKE '%$key%' ";
                $condition .= " OR about LIKE '%$key%' ";
                $condition .= " OR post_content LIKE '%$key%' ";
                $condition .= " OR post_excerpt LIKE '%$key%' ";
                $condition .= " OR quote_author LIKE '%$key%' ";
            }
            $condition .= ")";
        }

        return $condition;
    }

    public function search_all_count($keyword) {
        $condition = $this->all_condition($keyword);

        $this->getDbCriteria()->mergeWith(array(
            'join' => 'LEFT JOIN term_relationships ON id = object_id',
            'condition' => $condition,
            'group' => 'id',
        ));

        return $this;
    }

    public function search_all($keyword, $limit = 10, $offset = 0) {
        $condition = $this->all_condition($keyword);

        $this->getDbCriteria()->mergeWith(array(
            'join' => 'LEFT JOIN term_relationships ON id = object_id',
            'condition' => $condition,
            'limit' => $limit,
            'offset' => $offset,
            'group' => 'id',
            'order' => 'visits DESC, post_date DESC',
        ));

        return $this;
    }

    /* ---------- // Search Engine ---------------- */

    public function beforeSave() {
        if ($this->isNewRecord) {
            $this->post_date = $this->post_modified = new CDbExpression('NOW()');
        } else {
            $this->post_modified = new CDbExpression('NOW()');
        }

        $this->post_author = Yii::app()->user->id;

        return TRUE;
    }

    public function change_status($id, $post_type) {

        $sql = " UPDATE post SET disp_flag = disp_flag XOR 1 WHERE post_type = '" . $post_type . "' AND id = '" . (int) $id . "'";
        Yii::app()->db->createCommand($sql)->execute();

        return Post::model()->findByPk((int) $id);
    }

    public function delete_post($id, $post_type, $post_author = '') {

        $result = 0;
        if ($post_author == '') {

            $connection = Yii::app()->db;
            $transaction = $connection->beginTransaction();

            $sql1 = 'DELETE FROM term_relationships WHERE object_id = ' . (int) $id;
            $sql2 = "DELETE p, l FROM post p LEFT JOIN post_lang l ON p.id = l.post_id WHERE post_type = '$post_type' AND p.id = " . (int) $id;

            try {

                $connection->createCommand($sql1)->execute();
                $connection->createCommand($sql2)->execute();

                $transaction->commit();
                $result = 1;
            } catch (Exception $e) {
                $transaction->rollback();
                $result = 0;
            }
        } else {

            $connection = Yii::app()->db;
            $transaction = $connection->beginTransaction();

            $sql1 = 'DELETE FROM term_relationships WHERE object_id = ' . (int) $id;
            $sql2 = "DELETE p, l FROM post p LEFT JOIN post_lang l ON p.id = l.post_id WHERE post_type = '$post_type' AND p.id = " . (int) $id . " AND post_author = " . $post_author;

            try {

                $connection->createCommand($sql1)->execute();
                $connection->createCommand($sql2)->execute();

                $transaction->commit();
                $result = 1;
            } catch (Exception $e) {
                $transaction->rollback();
                $result = 0;
            }
        }

        return $result;
    }

    /*
     * limit  as per_page
     * ofsset = per_page * (current_page - 1)
     */

    public function get_new_feed($limit, $current_page = 1) {

        $offset = $limit * ($current_page - 1);

        $criteria = new CDbCriteria(array(
            'order' => 'post_date DESC',
            'limit' => $limit,
            'offset' => $offset,
        ));

        $model = Post::model()->multilang()->findAll($criteria);

        return $model;
    }

    public function total_post_type() {

        $sql = "SELECT post_type, COUNT(*) AS total FROM post GROUP BY post_type";

        $connection = Yii::app()->db;
        $model = $connection->createCommand($sql)->queryAll();

        $sum = array();
        foreach ($model as $row) {
            $key = $row['post_type'];
            $sum[$key] = $row['total'];
        }

        return (object) $sum;
    }

    public function update_last_visited($id) {
        $post = Post::model()->findByPk((int) $id);
        $post->last_visited = new CDbExpression("NOW()");
        $post->update(array('last_visited'));
    }

    public function refresh_menu_order($post_type = 'quote') {

        $sql = "SELECT count(*) as cnt, max(menu_order) as max, min(menu_order) as min FROM post WHERE post_type = '$post_type'";

        $sql2 = "SELECT id FROM post WHERE post_type = '$post_type' ORDER BY menu_order ASC";

        $connection = Yii::app()->db;
        $result = $connection->createCommand($sql)->queryAll();

        if (count($result[0]) > 0 && $result[0]['cnt'] == $result[0]['max'] && $result[0]['min'] != 0) {
            return;
        }

        $result = $connection->createCommand($sql2)->queryAll();
        foreach ($result as $key => $value) {
            $key = $key + 1;
            $ID = $value['id'];
            $sql3 = "UPDATE post SET menu_order = $key WHERE id = $ID";
            $connection->createCommand($sql3)->execute();
        }
    }

    public function rearrange_menu_order($post_type = 'quote') {

        $sql = "SELECT count(*) AS cnt, max(menu_order) AS max, min(menu_order) AS min FROM post WHERE post_type = '$post_type'";
        $sql2 = "SELECT id FROM post WHERE post_type = '$post_type' ORDER BY post_date DESC";

        $connection = Yii::app()->db;
        $result = $connection->createCommand($sql)->queryAll();

        if ($result[0]['cnt'] > 0 && $result[0]['max'] == 0) {
            $result = $connection->createCommand($sql2)->queryAll();
            foreach ($result as $key => $value) {
                $key = $key + 1;
                $ID = $value['id'];
                $sql3 = "UPDATE post SET menu_order = $key WHERE id = $ID";
                $connection->createCommand($sql3)->execute();
            }
        }
    }

    public function get_menu_order_by_id($id) {

        $criteria = new CDbCriteria(array(
            'select' => 'menu_order',
            'condition' => "id = $id"
        ));
        $model = Post::model()->findAll($criteria);

        return $model;
    }

    public function update_menu_order($position, $id) {
        $connection = Yii::app()->db;
        $sql = "UPDATE post SET menu_order = $position WHERE id = $id";
        $connection->createCommand($sql)->execute();
    }
    
    public function order_top($id, $post_type){
        $connection = Yii::app()->db;
        $sql = "UPDATE post SET menu_order = 0 WHERE post_type = '$post_type' AND id = $id";
        $connection->createCommand($sql)->execute();
        
        $this->refresh_menu_order($post_type);
    }

}
