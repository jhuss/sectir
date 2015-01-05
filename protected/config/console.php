<?php

require(dirname(__FILE__) . '/../../conf.php');

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name' => $SITE_NAME,

	'commandMap' => array(
		'usr' => array(
			'class' => 'application.commands.SectirUsrCommand',
        ),
        'migrate' => array(
            'class' => 'application.vendor.yiisoft.yii.framework.cli.commands.MigrateCommand',
            'migrationTable' => "{{migration}}",
        ),
	),

	// preloading 'log' component
	'preload' => array('log'),

	'import' => array(
		'application.models.*',
        'application.components.*',
        'application.vendor.*',     
	),

	// application components
	'components' => array(
		// uncomment the following to use a MySQL database
		'db' => array(
			'connectionString' => 'mysql:host=' . $DB_HOST . ';dbname=' . $DB_NAME,
			'emulatePrepare' => true,
			'username' => $DB_USER,
			'password' => $DB_PASS,
			'charset' => 'utf8',
			'tablePrefix' => $DB_PREFIX
		),
		'authManager' => array(
			'class' => 'CDbAuthManager',
            'connectionID' => 'db', 
            'assignmentTable' => "{{AuthAssignment}}",
            'itemChildTable' => "{{AuthItemChild}}",
            'itemTable' => "{{AuthItem}}",
			'defaultRoles' => array('usr.manage', $ADMIN_USER),
		),
		'log' => array(
			'class' => 'CLogRouter',
			'routes' => array(
				array(
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning',
				),
			),
		),
	),
);
