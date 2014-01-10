<?php

namespace Front\Controller;

use Common\Entity\Connector,
    Common\Entity\Newspaper;

use Front\Form\SignupForm;

use Zend\Mvc\Controller\AbstractActionController;

class UserController extends AbstractActionController {

    /**
     *  stap 1 na inloggen op facebook form invullen met gegevens
     */
    public function signupAction()
    {
        $config    = $this->getServiceLocator()->get('config');
        $config    = $config['connectors']['facebook'];

        $request   = $this->getRequest();

        require_once './../application/lib/facebookwrapper.php';
        require_once './../application/lib/fbphotofeed.php';

        $facebookWrapper = new \FacebookWrapper(array(
            'appId'      => $config['app_id'],
            'secret'     => $config['app_secret'],
            'cookie'     => true,
            'fileUpload' => false, // optional
            'allowSignedRequest' => false // optional, but should be set to false for non-canvas apps
        ));
        $facebookWrapper->setAccessToken($this->params()->fromQuery('access_token'));

        $user        = $facebookWrapper->getUserData();

        $newspaper  = new Newspaper();
        $newspaper->setEmail($user['email']);

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
                          ->setUniqueId($user['id'])
                          ->setEmail($user['email'])
                          ->setFirstname($user['first_name'])
                          ->setLastname($user['last_name'])
                          ->setAccessToken($this->params()->fromQuery('access_token'));

                $this->EmPlugin()->getEntityManager()->persist($connector);
                $this->EmPlugin()->getEntityManager()->flush();

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

    /**
     * stap 2: inviteer familieleden
     */
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

            return $this->redirect()->toRoute('user/wildcard', 
                array(
                    'action'     => 'done'
                ), array(), false
            );
        }

        return array(
            'config'    => $config,
            'newspaper' => $newspaper
        );
    }
    
    /**
     * step 3: klaar met het aanmaken van het krantje en het inviteren van familieleden
     */
    public function doneAction()
    {
        
    }
    

    /**
     * familieleden die uitnodiging aanvaarden komen uiteindelijk hier terecht...
     * 1. we kunnen via php de access token niet uit de url halen... daarom renderen we eerst de view waarin wat javascript staat
     * 2. de javascript redirect terug naar confirm, in de url staat nu de access_token die we kunnen uitlezen
     * 3. we gaan de access_token opslaan in de database
     */
    public function confirmAction()
    {
        $config    = $this->getServiceLocator()->get('config');
        $config    = $config['connectors']['facebook'];

        if ($this->params()->fromQuery('access_token')) {
            $accessToken = $this->params()->fromQuery('access_token');

            require_once './../application/lib/facebookwrapper.php';
            require_once './../application/lib/fbphotofeed.php';

            $facebookWrapper = new \FacebookWrapper(array(
                'appId'      => $config['app_id'],
                'secret'     => $config['app_secret'],
                'cookie'     => true,
                'fileUpload' => false, // optional
                'allowSignedRequest' => false // optional, but should be set to false for non-canvas apps
            ));

            $facebookWrapper->setAccessToken($accessToken);
            $user = $facebookWrapper->getUserData();

            $connectorRepo = $this->EmPlugin()->getEntityManager()->getRepository('Common\Entity\Connector');
            $connectors    = $connectorRepo->findBy(array(
                'type'      => Connector::FEED_TYPE_FACEBOOK,
                'uniqueId'  => $user['id']
            ));

            foreach($connectors as $connector) {
                $facebookWrapper->deleteRequest($connector->getRequestId());

                $connector->setActive(true)
                          ->setUniqueId($user['id'])
                          ->setEmail($user['email'])
                          ->setFirstname($user['first_name'])
                          ->setLastname($user['last_name'])
                          ->setAccessToken($accessToken);
                $this->EmPlugin()->getEntityManager()->flush();
            }

            return $this->redirect()->toRoute('user/wildcard', 
                array(
                    'action'     => 'final',
                    'newspaperId'=> $connector->getNewspaper()->getId()
                ), array(), false
            );

        } else {
            return array(
                'config'    => $config,
            );
        }
    }
    
    /**
     * familielid heeft toegang gegeven tot zijn gegevens, krijgt een bevestigingspagina te zien
     */
    public function finalAction()
    {
        $newspaperId = $this->params()->fromRoute('newspaperId');
        
        $newspaperRepo = $this->EmPlugin()->getEntityManager()->getRepository('Common\Entity\Newspaper');
        $newspaper     = $newspaperRepo->find($newspaperId);
        
        return array(
            'newspaper' => $newspaper
        );
    }
}