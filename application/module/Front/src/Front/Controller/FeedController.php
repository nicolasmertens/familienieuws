<?php

namespace Front\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class FeedController extends AbstractActionController {

    public function __construct()
    {
        
    }

    public function pageAction()
    {
        $config    = $this->getServiceLocator()->get('config');
        $config    = $config['connectors']['facebook'];

        print_r($config);

        return array(
            'config' => $config
        );
    }
}