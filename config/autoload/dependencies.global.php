<?php

use Zend\Expressive\Helper;

return [
    'dependencies' => [
        'invokables' => [
            Helper\ServerUrlHelper::class => Helper\ServerUrlHelper::class,
            App\Action\PingAction::class => App\Action\PingAction::class,
            App\Action\RestAction::class => App\Action\RestAction::class,
        ],
        'factories' => [
            Helper\UrlHelper::class => Helper\UrlHelperFactory::class,
            App\Action\HomePageAction::class => App\Action\HomePageFactory::class,
            Zend\Expressive\Application::class => Zend\Expressive\Container\ApplicationFactory::class,
        ]
    ]
];
