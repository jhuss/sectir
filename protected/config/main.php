<?php

require(dirname(__FILE__) . '/../../conf.php');

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
$arrayConfig = array(
	'basePath' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name' => $SITE_NAME,
	'theme' => 'default',
	'language' => 'es',

	// preloading 'log' component
	'preload' => array('log'),

	// autoloading model and component classes
	'import' => array(
		'application.models.*',
		'application.components.*',
	),
	'modules' => array(
		// uncomment the following to enable the Gii tool
		/*
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'Enter Your Password Here',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		*/
		'usr' => array(
			'userIdentityClass' => 'UserIdentity',
			'registrationEnabled' => true,
			'requireVerifiedEmail' => false,
			'pictureUploadRules' => array(
				array('file', 'allowEmpty' => true, 'types'=>'jpg, gif, png', 'maxSize'=>2*1024*1024, 'safe' => false, 'maxFiles' => 1),
			),
			'captcha' => array(
				//'captchaAction'=>'/usr/default/captcha'
			),
        ),
        'respuesta',
	),

	'aliases' => array(
		'vendor' => 'application.vendor',
	),

	// application components
	'components' => array(
		'sass' => array(
			// Path to the SassHandler class
			// You need the full path only if you don't use Composer's autoloader
			//'class' => 'vendor.artem-frolov.yii-sass.SassHandler',

			// Use the following if you use Composer's autoloader and Yii >= 1.1.15
			'class' => 'SassHandler',

			// Enable Compass support, defaults to false
			//'enableCompass' => true,

			'compilerOutputFormatting' => SassHandler::OUTPUT_FORMATTING_COMPRESSED
		),
		'clientScript' => array(
			'packages' => array(
				'angular' => array(
					'baseUrl' => '//ajax.googleapis.com/ajax/libs/angularjs/1.2.23/',
					'js' => array('angular.min.js'),
				),
				'angular-ui-bootstrap' => array(
					'baseUrl' => '//cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.10.0/',
					'js' => array('ui-bootstrap.min.js'),
				),
				'jquery' => array(
					'baseUrl' => '//ajax.googleapis.com/ajax/libs/jquery/1.11.1/',
					'js' => array('jquery.min.js'),
				),
				'jquery.ui' => array(
					'baseUrl' => '//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/',
					'js' => array('jquery-ui.min.js'),
					'css' => array('themes/smoothness/jquery-ui.css'),
				),
				'sugarjs' => array(
					'baseUrl' => '//cdnjs.cloudflare.com/ajax/libs/sugar/1.4.1/',
					'js' => array('sugar-full.min.js'),
                ),
                'sectir-input' => array(
                    'basePath' => "webroot.js.sectir-input",
                    'js' => array('sectir-input.min.js'),
                    'depends' => array("angular"),
                ),
			),
		),
		'user' => array(
			// enable cookie-based authentication
			'allowAutoLogin' => true,
			'loginUrl'=>array('usr/login'),
		),
		'authManager' => array(
			'class' => 'CDbAuthManager',
            'connectionID' => 'db',
            'assignmentTable' => "{{AuthAssignment}}",
            'itemChildTable' => "{{AuthItemChild}}",
            'itemTable' => "{{AuthItem}}"
		),
		'request' => array(
			'baseUrl' => $BASE_URL,
		),
		/*
		'urlManager' => array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
		// uncomment the following to use a MySQL database
		'db' => array(
			'connectionString' => 'mysql:host=' . $DB_HOST . ';dbname=' . $DB_NAME,
			'emulatePrepare' => true,
			'username' => $DB_USER,
			'password' => $DB_PASS,
			'charset' => 'utf8',
			'tablePrefix' => $DB_PREFIX
		),
		'errorHandler' => array(
			// use 'site/error' action to display errors
			'errorAction' => 'site/error',
		),
		'log' => _log(),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params' => array(
		'defaultTitle' => 'Sistema Estadístico en Ciencia, Tecnología e Innovación del Estado Trujillo',
		'adminUser' => $ADMIN_USER,
		'adminEmail' => 'webmaster@example.com',
	),
);

if($GII_ACTIVATED)
{
    $arrayConfig['modules']['gii'] = array(
            'class'=>'system.gii.GiiModule',
			'password'=>$GII_PASS,
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1')
    );
}

return $arrayConfig;

function _log() {
	$log = array();

	if (constant('YII_DEBUG')) {
		$log = array(
			'class' => 'CLogRouter',
			'routes' => array(
				array(
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning',
				),
				array(
					'class' => '\\SK\\Yii\\FirePHP\\LogRoute',
					'levels' => 'error, warning, info, trace',
				),
				array(
					'class' => '\\SK\\Yii\\FirePHP\\ProfileLogRoute',
					'report' => 'summary', // or "callstack"
				),
			),
		);
	} else {
		$log = array(
			'class' => 'CLogRouter',
			'routes' => array(
				array(
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		);
	}

	return $log;
}
