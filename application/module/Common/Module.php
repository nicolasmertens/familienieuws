<?php

namespace Common;

use Common\Service\AuthService,
    Common\Service\MailService,
    Common\Service\UserService,
    Common\View\Helper;

use Zend\Crypt\Symmetric\Mcrypt,
    Zend\Mail\Transport\Smtp as SmtpTransport,
    Zend\Mail\Transport\SmtpOptions,
    Zend\Mvc\MvcEvent,
    Zend\Validator\AbstractValidator;

class Module {

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'formErrorMessage' => function() {
                    return new Helper\FormErrorMessage();
                },
                'auth' => function() {
                    return new Helper\Auth();
                },
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $this->setAuth($e);
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'MailService' => function ($serviceManager) {
                    $config = $serviceManager->get('config');
                    $options = new SmtpOptions(array(
                        'name' => 'relay.belgacom.net',
                        'host' => 'relay.belgacom.net',
                    ));

                    $transport = new SmtpTransport();
                    $transport->setOptions($options);

                    $mailService = new MailService();
                    $mailService->setConfig($config['mail-service'])
                            ->setServiceManager($serviceManager)
                            ->setMailTransport($transport);
                    return $mailService;
                },
                'UserService' => function ($serviceManager) {
                    $userService = new UserService();
                    $userService->setServiceLocator($serviceManager);
                    $config = $serviceManager->get('config');
                    $mcrypt = new Mcrypt(
                            array(
                        'algo' => 'aes',
                        'mode' => 'cfb',
                        'key' => $config['security']['key'],
                        'salt' => $config['security']['salt']
                            )
                    );
                    $userService->setMcrypt($mcrypt);
                    return $userService;
                }
            )
        );
    }

    public function setAuth(MvcEvent $e)
    {
        AuthService::init($e->getApplication()->getServiceManager());
    }
}