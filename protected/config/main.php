<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Live Lilely',
    'charset' => 'UTF-8',
    'defaultController' => 'home',
    'sourceLanguage' => 'en',
    'language' => 'vi',
    'theme' => 'classic',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.extensions.*',
        'application.extensions.YiiMailer',
        'application.modules.menu.models.*',
        'application.modules.menu.components.*',
        'application.modules.backend.models.*',
        'application.modules.backend.components.*',
        'application.modules.user.models.*',
        'application.modules.user.components.*',
    ),
    'modules' => array(
//        'backend' => array(
//            'ipFilters' => array('127.0.0.1'), //Allow from
//        ),
        // uncomment the following to enable the Gii tool
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'admin',
        // If removed, Gii defaults to localhost only. Edit carefully to taste.
//            'ipFilters' => array('127.0.0.1', '::1'),
        ),
        'menu',
        'user' => array(
            'tableUsers' => 'users',
            'tableProfiles' => 'profiles',
            'tableProfileFields' => 'profiles_fields',
//            encrypting method (php hash function)
            'hash' => 'md5',
//            send activation email
            'sendActivationMail' => true,
//            allow access for non-activated users
            'loginNotActiv' => false,
//            activate user on registration (only sendActivationMail = false)
            'activeAfterRegister' => false,
//            automatically login from registration
            'autoLogin' => true,
//            registration path
            'registrationUrl' => array('/user/registration'),
//            recovery password path
            'recoveryUrl' => array('/user/recovery'),
//            login form path
            'loginUrl' => array('/user/login'),
//            page after login
            'returnUrl' => array('/user/profile'),
//            page after logout
            'returnLogoutUrl' => array('/user/login'),
        ),
        'backend' => array(
//            login form path
            'loginUrl' => array('/user/login'),
        ),
        'uploader' => array(
            'userModel' => 'user', //change to the model that has the pix column
            'userPixColumn' => 'image', //column to save the filename
            'folder' => 'avatars', //the dest folder(should be in the same folder level as protected folder)
        ),
    ),
    // application components
    'components' => array(
        'session' => array(
            'autoStart' => true,
            'timeout' => 86400, // 24 hours, 3 hours = 10800
        ),
        'user' => array(
            // enable cookie-based authentication
            'class' => 'WebUser',
            'allowAutoLogin' => true,
            'autoRenewCookie' => true,
            'authTimeout' => 31557600,
//            'returnUrl' => array('/user/profile'),
            'loginUrl' => array('/account/login'),
//            'loginUrl' => array('/backend/site/login'),
        ),
        'request' => array(
            'class' => 'ext.localeurls.LocaleHttpRequest',
            'languages' => array('vi' => 'Vietnamese', 'en' => 'English', 'es' => 'Español'),
            // advance
            'detectLanguage' => true,
            'languageCookieLifetime' => 31536000,
            'persistLanguage' => true,
            'redirectDefault' => false,
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'class' => 'ext.localeurls.LocaleUrlManager',
            'languageParam' => 'language', // advance
            'urlFormat' => 'path', // use "path" format, e.g. "post/show?id=4" rather than "r=post/show&id=4"
            'rules' => array(
                // custom rules
                'book/<slug:[a-zA-Z0-9-]+>/' => 'book/show',
                'quote/<slug:[a-zA-Z0-9-]+>/' => 'quote/show',
                'music/<slug:[a-zA-Z0-9-]+>/' => 'music/show',
                'authors/<alphabet:[a-zA-Z0-9-]+>/' => 'authors',
                '<type:[a-zA-Z0-9-]+>/topic/<slug:[a-zA-Z0-9-]+>/' => 'topic',
                'topic/<slug:[a-zA-Z0-9-]+>/' => 'topic',
                'category/<slug:[a-zA-Z0-9-]+>/' => 'category',
                'quote-of-day' => 'quoteOfDay',
                'famous-quotes' => 'famousQuotes',
                'best-book-in-month' => 'bestBookInMonth',
                
                '<_c:(home|quote|book|music|topic|category)>' => '<_c>/index',
                
                // default controller url setup     
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
//                'backend/<controller:\w+>'=>'<controller>backend/index',
//                'backend/<controller:\w+>/<id:\d+>'=>'<controller>backend/view',
//                'backend/<controller:\w+>/<id:\d+>/<action:\w+>'=>'<controller>backend/<action>',
//                'backend/<controller:\w+>/<action:\w+>'=>'<controller>backend/<action>',
                '<module:\w+>/<controller:\w+>/<id:\d+>' => '<module>/<controller>/view',
                '<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<module>/<controller>/<action>',
                '<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>'
            ),
            'showScriptName' => false, // do not show "index.php" in URLs
            'appendParams' => false, // do not append parameters as name/value pairs (DO NOT CHANGE THIS)
//            'urlSuffix' => '.html',
        ),
        // connection MySQL database
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=db_lilely_quote',
            'schemaCachingDuration' => 3600,
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'tablePrefix' => '',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'file' => array(
            'class' => 'application.extensions.file.CFile',
        ),
        'upload' => array(
            'class' => 'application.extensions.Upload',
        ),
        'curl' => array(
            'class' => 'application.extensions.curl.Curl',
            'options' => array(/* additional curl options */),
        ),
        'setting' => array('class' => 'WebSetting'),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
                // uncomment the following to show log messages on web pages
//                array(
//                    'class'=>'CWebLogRoute',
//                ),
                array(
                    'class' => 'CFileLogRoute',
                    'logFile' => 'trace.log',
                    'levels' => 'trace',
                    'categories' => 'application.*',
                ),
            /*
              array (
              'class'=>'CFileLogRoute',
              'logFile' => 'system.log',
              'categories'=>'system.db.*',
              ),
             */
            ),
        ),
//        'dbcache' => array(
//            'class' => 'system.caching.CDbCache',
//            'servers'=>array(
//                array(
//                    'host'=>'localhost',
//                    'port'=>22,
//                ),
//            ),
//        ),
//        'cache' => array(
//            'class' => 'system.caching.CFileCache',
//        ),
//        'memcache'=>array(
//            'class'=>'system.caching.CMemCache',
//        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // use for backend dashboard
        'ga_email' => '',
        'ga_password' => '',
        'ga_profile_id' => '',
        'ga_request_url' => '',
        /* ------------------------------------------------------------------ */
        'adminEmail' => 'webmaster@example.com',
        'siteUrl' => 'http://lilely-quote.localhost',
        /* ------------------------------------------------------------------ */
        'translatedLanguages' => array('en' => 'English', 'vi' => 'Vietnamese', 'es' => 'Español'),
        'defaultLanguage' => 'en',
        'pageSize' => 100,
        /* ------------------------------------------------------------------ */
        'show_in' => array(
            'original' => 'Original',
            'faq' => 'FAQ',
        ),
        /* ------------------------------------------------------------------ */
        // -- mail setting -- //
        'sender' => 'Lilely Quote',
        'from' => 'admin@lilely.com',
        // -- / mail setting -- //
        /* ------------------------------------------------------------------ */
        'set_mail_path' => 'http://localhost/lilely/images/mail/',
        'set_image_path' => 'images/',
        'set_avatars_path' => 'avatars/',
        'set_slide_path' => 'images/slide/',
        'set_author_path' => 'images/author/',
        'set_quote_path' => 'images/quote/',
        'set_quote_sound_path' => 'media/quote/',
        'set_media_home_path' => 'media/home/',
        'set_book_path' => 'images/book/',
        'set_music_path' => 'images/music/',
        'set_photos_path' => 'photos/',
    ),
);
