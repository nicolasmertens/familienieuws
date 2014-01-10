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

        /**
         * geïnviteerde familieleden die op bevestigen klikken in facebook zenden een request_ids mee ... 
         * deze gaan we dadelijk terugsturen naar facebook om een access_token op te vragen
         * facebook stuurt ze onmiddellijk terug naar de invite_confirm url (http://onzesite/confirm)
         */
        if ($this->params()->fromQuery('request_ids')) {
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
                'redirect_uri' => $config['facebook']['callback_url_invite_confirm'],
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
}