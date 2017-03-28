<?php
/**
 * Expressive routed middleware
 */

/** @var \Zend\Expressive\Application $app */
$app->get('/', \App\Action\HomePageAction::class, 'home');
$app->get('/api/ping', \App\Action\PingAction::class, 'api.ping');
$app->route('/rest', \App\Action\RestAction::class, ['GET', 'POST', 'PUT', 'DELETE'], 'rest');
