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
        $config    = $this->getServiceLocator()->get('config');
        $config    = $config['connectors']['facebook'];

        $request   = $this->getRequest();

        require_once './lib/facebookwrapper.php';
        require_once './lib/fbphotofeed.php';

        $facebookWrapper = new \FacebookWrapper(array(
            'appId'      => $config['app_id'],
            'secret'     => $config['app_secret'],
            'cookie'     => true,
            'fileUpload' => false, // optional
            'allowSignedRequest' => false // optional, but should be set to false for non-canvas apps
        ));

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
            //return $this->redirect()->toRoute('root');
        }

        return array(
            'config'    => $config,
            'newspaper' => $newspaper
        );
    }
    
    public function confirmAction()
    {        
        $config    = $this->getServiceLocator()->get('config');
        $config    = $config['connectors']['facebook'];

        require_once './../application/lib/facebookwrapper.php';
        require_once './../application/lib/fbphotofeed.php';

        $facebookWrapper = new \FacebookWrapper(array(
            'appId'      => $config['app_id'],
            'secret'     => $config['app_secret'],
            'cookie'     => true,
            'fileUpload' => false, // optional
            'allowSignedRequest' => false // optional, but should be set to false for non-canvas apps
        ));
        if ($this->params()->fromQuery('state')) {
            var_dump($facebookWrapper->getAccessToken());
            var_dump($facebookWrapper->getUserData());
            var_dump('test');die;
        }
        if (!$this->params()->fromQuery('access_token')) {
            $url = $facebookWrapper->getLoginStatusUrl(array('response_type' => 'token'));
            header('Location: ' . $url);
            exit;
        }
        $user        = $facebookWrapper->getUserData();

        $connectorRepo = $this->EmPlugin()->getEntityManager()->getRepository('Common\Entity\Connector');
        $connectors    = $connectorRepo->findBy(array(
            'type'      => Connector::FEED_TYPE_FACEBOOK,
            'uniqueId'  => $user['id']
        ));
        
        foreach($connectors as $connector) {
            $connector->setActive(true)
                      ->setUniqueId($user['id'])
                      ->setEmail($user['email'])
                      ->setFirstname($user['first_name'])
                      ->setLastname($user['last_name'])
                      ->setAccessToken($accessToken);
            $this->EmPlugin()->getEntityManager()->flush();
        }

        return $this->redirect()->toRoute('root');
    }
}