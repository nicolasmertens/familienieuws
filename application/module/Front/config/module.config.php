<?php
namespace Front;

return array(
    'doctrine'           => array(
        'authentication' => array(
            'orm_default' => array(
                'object_manager'      => 'Doctrine\ORM\EntityManager',
                'identity_class'      => 'Common\Entity\User',
                'identity_property'   => 'email',
                'credential_property' => 'password',
                'credential_callable' => function(\Common\Entity\User $user, $passwordGiven) {
                    if ($user->getPassword() == sha1($passwordGiven) && $user->isConfirmed() == 1) {
                        return true;
                    } else {
                        return false;
                    }
                },
            ),
        ),
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default'             => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        )
    ),

    'controllers' => array(
        'invokables' => array(
            'Front\Controller\Connector' => 'Front\Controller\ConnectorController',
            'Front\Controller\User'      => 'Front\Controller\UserController',
        ),
    ),

    'service_manager'    => array(
        'factories' => array(),
    ),

    'router'             => array(
        'routes' => array(
            'root'          => array(
                'type'    => 'segment',
                'options' => array(
                    'route'       => '[/]',
                    'defaults'    => array(
                        'controller' => 'Front\Controller\Static',
                        'action'     => 'home',
                    ),
                ),
            ),
            'connector'     => array(
                'type'    => 'segment',
                'options' => array(
                    'route'     => '/connector/:action',
                    'constraints' => array(
                        'action'     => 'index|close|delete|twitter|foursquare|facebook|instagram',
                    ),
                    'defaults'    => array(
                        'controller' => 'Front\Controller\Connector',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'wildcard' => array(
                        'type' => 'Wildcard'
                    )
                )
            ),
            'user'          => array(
                'type'    => 'segment',
                'options' => array(
                    'route'       => '/:action[/:encryptedemail]',
                    'constraints' => array(
                        'action'     => 'signup|signedup|login|logout|passwordforgotten|confirm|passwordreset',
                    ),
                    'defaults'    => array(
                        'controller' => 'Front\Controller\User',
                        'action'     => 'login',
                    ),
                ),
            ),
            'static'        => array(
                'type'    => 'segment',
                'options' => array(
                    'route'       => '/:action',
                    'constraints' => array(
                        'action'     => 'pricing',
                    ),
                    'defaults'    => array(
                        'controller' => 'Front\Controller\Static',
                    ),
                ),
            )
        )
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        ),
        'strategies'          => array(
            'ViewJsonStrategy',
        ),
    ),
);