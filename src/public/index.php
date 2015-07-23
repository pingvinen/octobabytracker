<?php
require_once(dirname(__DIR__ ). '/config/base.php');
require_once(INC . '/config/config.php');

$container = new Container($config);

$app = new \Slim\Slim(array(
	'debug' => $config->debug
	// , 'view' => '....' // view is set by middleware
));

$app->add($container->getAjaxRequestMiddleware());
$app->add($container->getViewPickerMiddleware());

/**
 * @var $routeSetter RouteSetter
 */
$routeSetter = $container->getRouteSetter($app);
$routeSetter->addRoutes(INC.'/controllers');

$app->run();
