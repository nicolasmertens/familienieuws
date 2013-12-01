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
            return $this->redirect()->toUrl("https://www.facebook.com/dialog/oauth?client_id=" . $config['facebook']['app_id'] . "&scope=email,publish_stream,status_update,friends_online_presence,user_birthday,user_location,user_work_history&redirect_uri=http://www.familienieuws.eu/confirm");
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