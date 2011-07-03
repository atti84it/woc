<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'Web of Crowds',
    'theme'=>'freshy2',

    // preloading 'log' component
    'preload'=>array('log'),

    // autoloading model and component classes
    'import'=>array(
        'application.models.*',
        'application.components.*',
        'application.modules.woc.models.*'
    ),

    'modules'=>array(
        // uncomment the following to enable the Gii tool
        
        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'admin',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters'=>array('127.0.0.1','::1'),
        ),
        
        'woc',
        
    ),

    // application components
    'components'=>array(
        'user'=>array(
            // enable cookie-based authentication
            'allowAutoLogin'=>true,
        ),
        
        'urlManager'=>array(
            'showScriptName'=>false,
            'urlFormat'=>'path',
            'rules'=>array(
                '<module:\w+>/<controller:\w+>/<id:\d+>'=>'<module>/<controller>/view',
                '<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<module>/<controller>/<action>',
                           
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                
                '<module:\w+>/<controller:\w+>/<action:\w+>'=>'<module>/<controller>/<action>', 
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            ),
        ),
        
        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=woc',
            'emulatePrepare' => true,
            'username' => 'woc',
            'password' => 'woc',
            'charset' => 'utf8',
        ),
        
        'errorHandler'=>array(
            // use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning',
                ),
                // uncomment the following to show log messages on web pages
                /*
                array(
                    'class'=>'CWebLogRoute',
                ),
                */
            ),
        ),
    ),

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params'=>array(
        // this is used in contact page
        'adminEmail'=>'webmaster@example.com',
    ),
);
