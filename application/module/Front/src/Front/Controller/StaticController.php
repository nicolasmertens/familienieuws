<?php

namespace Front\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class StaticController extends AbstractActionController {

    public function __construct()
    {
        
    }

    public function homeAction()
    {
        $config    = $this->getServiceLocator()->get('config');
        $config    = $config['connectors'];

        $requestIds = $this->params()->fromQuery('request_ids');

        if ($requestIds) {
            require_once './../application/lib/facebookwrapper.php';
            require_once './../application/lib/fbphotofeed.php';

            $facebookWrapper = new \FacebookWrapper(array(
                'appId'      => $config['facebook']['app_id'],
                'secret'     => $config['facebook']['app_secret'],
                'cookie'     => true,
                'fileUpload' => false, // optional
                'allowSignedRequest' => false // optional, but should be set to false for non-canvas apps
            ));
            $url = $facebookWrapper->getLoginUrl(array(
                'redirect_uri' => "http://www.familienieuws.eu/confirm",
                'scope'        => $config['facebook']['scope'],
                'response_type'=> 'token'
            ));
            return $this->redirect()->toUrl($url);
        } else {
            $this->layout('layout/front');

            return array(
                'config' => $config,
            );
        }
    }
    
    public function pricingAction()
    {
        return array();
    }
}