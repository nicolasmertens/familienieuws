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
            'Front\Controller\Feed'      => 'Front\Controller\FeedController',
            'Front\Controller\Static'    => 'Front\Controller\StaticController',
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
            'user'          => array(
                'type'    => 'segment',
                'options' => array(
                    'route'       => '/:action',
                    'constraints' => array(
                        'action'     => 'signup|invite|confirm',
                    ),
                    'defaults'    => array(
                        'controller' => 'Front\Controller\User',
                        'action'     => 'login',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'wildcard' => array(
                        'type' => 'Wildcard'
                    )
                )
            ),
            /*'userconfirm'       => array(
                'type'    => 'regex',
                'options' => array(
                    'regex'       => '/signup#([0-9a-zA-Z]*)&expires_in=5168',
                    'defaults'    => array(
                        'controller' => 'Front\Controller\User',
                        'action'     => 'confirm',
                    ),
                    'spec' => '/blog/%accessToken%',
                ),
            ),*/
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
            ),
            'feed'        => array(
                'type'    => 'segment',
                'options' => array(
                    'route'       => '/feed/:action',
                    'constraints' => array(
                        'action'     => 'page|pdf',
                    ),
                    'defaults'    => array(
                        'controller' => 'Front\Controller\Feed',
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