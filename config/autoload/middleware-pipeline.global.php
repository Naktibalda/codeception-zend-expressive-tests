<?php

use Zend\Expressive\Helper;

return [

    'dependencies' => [
        'factories' => [
            Helper\ServerUrlMiddleware::class => Helper\ServerUrlMiddlewareFactory::class,
        ],
    ],

    'middleware_pipeline' => [
        // An array of middleware to pipe to the application.
        // Each item is of the following structure:
        // [
        //     // Required:
        //     'middleware' => 'Name or array of names of middleware services and/or callables',
        //     // Optional:
        //     'path'  => '/path/to/match',
        //     'error' => true,
        // ],
        [
            'middleware' => [
                Helper\ServerUrlMiddleware::class,
            ],
            'priority' => PHP_INT_MAX,
        ],

        // The following is an entry for:
        // - routing middleware
        // - middleware that reacts to the routing results
        // - dispatch middleware
        [
            'middleware' => [
                Zend\Expressive\Container\ApplicationFactory::ROUTING_MIDDLEWARE,
//                    Helper\UrlHelperMiddleware::class,
                Zend\Expressive\Container\ApplicationFactory::DISPATCH_MIDDLEWARE,
            ],
            'priority' => 1,
        ]

        // The following is an entry for the dispatch middleware:

        // Place error handling middleware after the routing and dispatch
        // middleware, with negative priority.
        // [
        //     'middleware' => [
        //     ],
        //     'priority' => -1000,
        // ],
    ],
];
