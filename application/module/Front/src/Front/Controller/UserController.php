<?php

namespace Front\Controller;

use Common\Entity\Connector,
    Common\Entity\Newspaper;

use Front\Form\SignupForm;

use Zend\Mvc\Controller\AbstractActionController;

class UserController extends AbstractActionController {

    public function __construct()
    {
        
    }

    public function signupAction()
    {
        $config  = $this->getServiceLocator()->get('config');
        $config  = $config['connectors']['facebook'];

        $request = $this->getRequest();

        $oauth   = new \Common\Service\Connector\SocialApi();

        $oauth->provider      = "Facebook";
        $oauth->client_id     = $config['app_id'];
        $oauth->client_secret = $config['app_secret'];
        $oauth->scope         = $config['scope'];
        $oauth->redirect_uri  = $config['callback_url'];
        $oauth->Initialize();
        $oauth->accessToken = $this->params()->fromQuery('access_token', false);

        $response   = $oauth->curl_request("https://graph.connect.facebook.com/me/?", "GET", array(
            'client_id'     => $oauth->client_id,
            'client_secret' => $oauth->client_secret,
            'oauth_token'   => $oauth->accessToken,
        ));
        $response   = json_decode($response);

        $newspaper = new Newspaper();
        $newspaper->setEmail($response->email);

        $form = new SignupForm($this->EmPlugin()->getEntityManager(), $request->getRequestUri());
        $form->bind($newspaper);

        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $newspaper = $form->getData();
                
                // save newspaper
                $this->EmPlugin()->getEntityManager()->persist($newspaper);
                $this->EmPlugin()->getEntityManager()->flush();
                
                // save connector
                $connector = new Connector();
                $connector->setNewspaper($newspaper)
                          ->setType(Connector::FEED_TYPE_FACEBOOK)
                          ->setActive(true)
                          ->setUniqueId($response->id);
                
                $this->EmPlugin()->getEntityManager()->persist($connector);
                $this->EmPlugin()->getEntityManager()->flush();

                $this->flashMessenger()->addSuccessMessage('Uw nieuwskrant werd aangemaakt.');
                return $this->redirect()->toRoute('user/wildcard', 
                    array(
                        'action'     => 'invite',
                        'newspaperId' => $newspaper->getId()
                    ), array(), false
                );
            }
        }

        return array(
            'form' => $form,
        );
    }
    
    public function inviteAction()
    {
        $config  = $this->getServiceLocator()->get('config');
        $config  = $config['connectors'];

        $newspaperId = $this->params()->fromRoute('newspaperId', false);
        $ids         = $this->params()->fromQuery('to', false);
        $requestId   = $this->params()->fromQuery('request', false);

        /* @var $tagRepo \Doctrine\ORM\EntityRepository */
        $newspaperRepo = $this->EmPlugin()->getEntityManager()->getRepository('Common\Entity\Newspaper');
        $newspaper     = $newspaperRepo->findOneById($newspaperId);

        if (!$newspaper) {
            $this->flashMessenger()->addErrorMessage('Oeps, er ging iets verkeerd.');
            return $this->redirect()->toRoute('root');
        }

        if ($requestId && $ids) {
            foreach ($ids as $id) {
                $connectorRepo = $this->EmPlugin()->getEntityManager()->getRepository('Common\Entity\Connector');
                $connector     = $connectorRepo->findOneBy(array(
                    'type'      => Connector::FEED_TYPE_FACEBOOK,
                    'uniqueId'  => $id,
                    'requestId' => $requestId,
                    'newspaper' => $newspaper->getId(),
                ));

                if (!$connector) {
                    $connector = new Connector();
                    $connector->setNewspaper($newspaper)
                              ->setType(Connector::FEED_TYPE_FACEBOOK)
                              ->setUniqueId($id)
                              ->setRequestId($requestId)
                              ->setActive(false);
                    $this->EmPlugin()->getEntityManager()->persist($connector);
                    $this->EmPlugin()->getEntityManager()->flush();
                }
            }

            $this->flashMessenger()->addSuccessMessage('Uw krantje werd aangemaakt.');
            return $this->redirect()->toRoute('root');
        }

        return array(
            'config'    => $config,
            'newspaper' => $newspaper
        );
    }
    
    public function confirmAction()
    {
        $config  = $this->getServiceLocator()->get('config');
        $config  = $config['connectors']['facebook'];

            $oauth   = new \Common\Service\Connector\SocialApi();

            $oauth->provider      = "Facebook";
            $oauth->client_id     = $config['app_id'];
            $oauth->client_secret = $config['app_secret'];
            $oauth->scope         = "email,publish_stream,status_update,friends_online_presence,user_birthday,user_location,user_work_history";
            $oauth->redirect_uri  = "http://www.familienieuws.eu/confirm";
            $oauth->code          = $this->params()->fromQuery('code');
            $oauth->Initialize();

            $oauth->accessToken = $oauth->getAccessToken();

        $response   = $oauth->curl_request("https://graph.connect.facebook.com/me/?", "GET", array(
            'client_id'     => $oauth->client_id,
            'client_secret' => $oauth->client_secret,
            'oauth_token'   => $oauth->accessToken,
        ));
        $response   = json_decode($response);
        var_dump($response);die;

        $requestIds = $this->params()->fromRoute('requestIds');
        $requestIds = explode(",", $requestIds);

        foreach($requestIds as $requestId) {
            $oauth   = new \Common\Service\Connector\SocialApi();

            $oauth->provider      = "Facebook";
            $oauth->client_id     = $config['app_id'];
            $oauth->client_secret = $config['app_secret'];
            $oauth->scope         = "email,publish_stream,status_update,friends_online_presence,user_birthday,user_location,user_work_history";
            $oauth->redirect_uri  = $config['callback_url'];
            $oauth->code          = 
            $oauth->Initialize();

            $response   = $oauth->curl_request("https://graph.facebook.com/me/apprequests", "GET", array(
                'client_id'     => $oauth->client_id,
                'client_secret' => $oauth->client_secret,
                'oauth_token'   => $oauth->accessToken,
            ));
            var_dump($response);
            $response   = json_decode($response);
            die;

            $connectorRepo = $this->EmPlugin()->getEntityManager()->getRepository('Common\Entity\Connector');
            $connector     = $connectorRepo->findOneBy(array('requestId' => $requestId));

            if (is_null($connector)) {
                $this->flashMessenger()->addErrorMessage('Oeps, aanvraag niet gevonden.');
                return $this->redirect()->toRoute('root');
            }

            $connector->setActive(true);
            $this->EmPlugin()->getEntityManager()->flush();
        }

        return array(
            'config' => $config
        );
        //$this->flashMessenger()->addSuccessMessage('Uw aanvraag werd succesvol afgerond.');
        //return $this->redirect()->toRoute('root');
    }
}