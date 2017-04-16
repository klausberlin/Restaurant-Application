<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Application;
use Application\Factory\Controller\IndexControllerFactory;
use Zend\Authentication\AuthenticationService;
use Application\Factory\Controller\DashboardControllerFactory;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;


return [

    'router' => [
        'routes' => [

            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],

            'dashboard' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/dashboard[/:action]',
                    'defaults' => [
                        'controller' => Controller\DashboardController::class,
                        'action' => 'index',
                    ],
                ],
            ],

            'waitress' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/waitress[/:action]',
                    'defaults' => [
                        'controller' => Controller\WaitressController::class,
                        'action' => 'index',
                    ],
                ],
            ],

            'kitchen' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/kitchen[/:action]',
                    'defaults' => [
                        'controller' => Controller\KitchenController::class,
                        'action' => 'index',
                    ],
                ],
            ],

            'kitchen-rest' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/kitchen-rest[/:id]',
                    'defaults' => [
                        'controller' => Controller\KitchenRestController::class,
                    ],
                ],
            ],

            'application' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/application[/:action]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],

        ],
    ],
    'service_manager' => [
        'factories' => [
            AuthenticationService::class => Application\Factory\Adapter\AuthenticationServiceFactory::class,
            Application\Model\UserModel::class => Application\Factory\Model\DbDataFactory::class,
        ],
        'aliases' => [
            Model\UserInterface::class => Model\UserModel::class,
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => IndexControllerFactory::class,
            Controller\DashboardController::class => DashboardControllerFactory::class,
            Controller\KitchenRestController::class => Application\Factory\Controller\KitchenRestFactory::class,
            Controller\WaitressController::class => InvokableFactory::class,
            Controller\KitchenController::class => InvokableFactory::class,
        ],
    ],


    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        //Configure for restful-services
        'strategies'               => [
            'ViewJsonStrategy'
        ],
    ],
];
