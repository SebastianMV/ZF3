<?php
namespace Proveedor;

use Zend\ServiceManager\Factory\InvokableFactory;
//use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;

return [
    'controllers' => [
        'factories' => [
           // Controller\ProveedorController::class => InvokableFactory::class,            
            Controller\ProveedorController::class => function($container){
               return new Controller\ProveedorController($container);
            },
        ],
    ],
    'router' => [
        'routes' => [
            'proveedores' => [
                'type'    => Segment::class,
                'options' => [
                    // Change this to something specific to your module
                    'route'    => '/proveedor[/:action[/:id]]',
                    'defaults' => [
                        'controller'    => Controller\ProveedorController::class,
                        'action'        => 'read',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    // You can place additional routes that match under the
                    // route defined above here.
                ],
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'ZendSkeletonModule' => __DIR__ . '/../view',
        ],
    ],
     'doctrine' => [
        'driver' => [
            // defines an annotation driver with two paths, and names it `my_annotation_driver`
            'my_annotation_driver' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [
                    'module/Entities',
                  //  'another/path',
                ],
            ],

            // default metadata driver, aggregates all other drivers into a single one.
            // Override `orm_default` only if you know what you're doing
            'orm_default' => [
                'drivers' => [
                    // register `my_annotation_driver` for any entity under namespace `My\Namespace`
                    'My\Namespace' => 'my_annotation_driver',
                ],
            ],
        ],
    ],
];
