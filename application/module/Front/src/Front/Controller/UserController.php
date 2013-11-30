<?php

namespace Front\Controller;

use Common\Entity\User,
    Common\Validator\UserExists;

use Front\Form\LoginForm,
    Front\Form\PasswordForgottenForm,
    Front\Form\PasswordResetForm,
    Front\Form\SignupForm;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\Validator\Identical;

class UserController extends AbstractActionController {

    public function __construct()
    {
        
    }

    public function signupAction()
    {
        if ($this->auth()->hasIdentity()) {
            return $this->redirect()->toRoute('root', array());
        }

        $request = $this->getRequest();

        $form = new SignupForm($this->EmPlugin()->getEntityManager(), $request->getRequestUri());
        $form->bind(new User());

        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $user = $form->getData();
                $user->setConfirmed(false);
                $user->setPassword(sha1($user->getPassword()));

                /** @var $userService UserService */
                $userService = $this->getServiceLocator()->get('UserService');

                // create registration link
                $registrationToken = $userService->createRegistrationToken($user->getEmail());
                $registrationLink = $request->getUri()->getScheme() . '://' . $request->getUri()->getHost() .
                        $this->url()->fromRoute('user', array('encryptedemail' => $registrationToken, 'action' => 'confirm'));

                // send the mail
                $mailService = $this->getServiceLocator()->get('MailService');
                $mailService->setVariables(array(
                    'email' => $user->getEmail(),
                    'registerLink' => $registrationLink,
                ));
                $mailService->setView('front/user/signup-mail.phtml');
                $mailService->sendMail("Your account is ready to be activated!", $user->getEmail());

                // save user
                $this->EmPlugin()->getEntityManager()->persist($user);
                $this->EmPlugin()->getEntityManager()->flush();

                $this->flashMessenger()->addSuccessMessage('Great! Check your inbox for a confirmation email to finish your signup.');
                return $this->redirect()->toRoute('user', array('action' => 'login'));
            }
        }

        $this->layout()->title = "signup";

        return array(
            'form' => $form,
            'actionFrom' => $this->params('actionFrom'),
        );
    }

    public function confirmAction()
    {
        if ($this->auth()->hasIdentity()) {
            return $this->redirect()->toRoute('root', array());
        }

        if (!$this->params('encryptedemail')) {
            $this->flashMessenger()->addErrorMessage('Invalid confirmation token!');
            return $this->redirect()->toRoute('root', array());
        }

        /** @var $userService UserService */
        $userService = $this->getServiceLocator()->get('UserService');
        $email = $userService->getEmailFromRegistrationToken($this->params('encryptedemail'));

        $user = $this->EmPlugin()
                     ->getEntityManager()
                     ->getRepository('Common\Entity\User')
                     ->findOneBy(array('email' => $email));

        if (is_null($user)) {
            $this->flashMessenger()->addErrorMessage('Invalid confirmation token!');
            return $this->redirect()->toRoute('root', array());
        }

        $user->setConfirmed(true);

        $this->EmPlugin()->getEntityManager()->persist($user);
        $this->EmPlugin()->getEntityManager()->flush();

        $this->flashMessenger()->addSuccessMessage('Your registration is completed!');
        return $this->redirect()->toRoute('user', array('action' => 'login'));
    }

    public function loginAction()
    {
        if ($this->auth()->hasIdentity()) {
            return $this->redirect()->toRoute('root', array());
        }

        $request = $this->getRequest();

        $form = new LoginForm($this->EmPlugin()->getEntityManager(), $request->getRequestUri());

        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $user         = $form->getData();

                $authService  = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
                $adapter      = $authService->getAdapter();

                $adapter->setIdentityValue($user['email']);
                $adapter->setCredentialValue($user['password']);
                $authResult   = $authService->authenticate();

                if ($authResult->isValid()) {
                    $time     = 1209600;
                    $identity = $authResult->getIdentity();

                    $authService->getStorage()->write($identity);

                    $sessionManager = new \Zend\Session\SessionManager();
                    $sessionManager->rememberMe($time);
                    
                    return $this->redirect()->toRoute('connector', array('action' => 'index'));
                } else {
                    $this->flashMessenger()->addErrorMessage("Supplied credential is invalid.");
                    return $this->redirect()->toRoute('user', array('action' => 'login'));
                }
            } else {
                $this->flashMessenger()->addErrorMessage("Supplied credential is invalid.");
                return $this->redirect()->toRoute('user', array('action' => 'login'));
            }
        }

        $this->layout()->title = "login";

        return array(
            'form' => $form
        );
    }

    public function logoutAction()
    {
        $this->auth()->clearIdentity();

        $sessionManager = new \Zend\Session\SessionManager();
        $sessionManager->forgetMe();

        return $this->redirect()->toRoute('root', array());
    }

    public function passwordforgottenAction()
    {
        $request= $this->getRequest();

        $form   = new PasswordForgottenForm($this->EmPlugin()->getEntityManager(), $request->getRequestUri());

        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $data = $form->getData();

                $user = $this->EmPlugin()
                             ->getEntityManager()
                             ->getRepository('Common\Entity\User')
                             ->findOneByEmail($data['email']);

                /** @var $userService UserService */
                $userService = $this->getServiceLocator()->get('UserService');

                // create reset link
                $resetLink
                    = $this->getRequest()->getUri()->getScheme() . '://' . $this->getRequest()->getUri()->getHost()
                    . $this->url()->fromRoute(
                        'user',
                        array(
                            'action'         => 'passwordreset',
                            'encryptedemail' => $userService->createPasswordResetToken($user)
                        )
                    );

                // send the mail
                $mailService = $this->getServiceLocator()->get('MailService');
                $mailService->setVariables(array('resetLink' => $resetLink));
                $mailService->setView('front/user/passwordforgotten-mail.phtml');
                $mailService->sendMail("Reset your password", $user->getEmail());

                // Route to login screen
                $this->flashMessenger()->addSuccessMessage('Great! Check your inbox for a  email to reset your password.');
                return $this->redirect()->toRoute('user', array('action' => 'login'));
            }
        }

        $this->layout()->title = "password forgotten";

        return array('form' => $form);
    }

    public function passwordresetAction()
    {
        if ($this->auth()->hasIdentity()) {
            return $this->redirect()->toRoute('root', array());
        }

        /** @var $userService UserService */
        $userService = $this->getServiceLocator()->get('UserService');

        // check security in url
        $passwordRecoveryString = $this->params()->fromRoute('encryptedemail', 0);
        $explode = explode('|', base64_decode($passwordRecoveryString));

        // check if user exists in our database
        $objectExists = new UserExists(array(
            'entity_manager' => $this->EmPlugin()->getEntityManager(),
            'messages'  => array(
                UserExists::ERROR_NO_OBJECT_FOUND => "Email Address Not Found"
            )
        ));

        if (!$objectExists->isValid($explode[0])) {
            return array('errors' => $objectExists->getMessages());
        }

        /** @var $user User */
        $user = $this->EmPlugin()
                     ->getEntityManager()
                     ->getRepository('Common\Entity\User')
                     ->findOneBy(array('email' => $explode[0]));

        // check if user matches with the token
        $identicalValidator = new Identical($passwordRecoveryString);
        $identicalValidator->setMessage('Email Address Not Found', Identical::NOT_SAME);
        $identicalValidator->setMessage('Email Address Not Found', Identical::MISSING_TOKEN);
        if (!$identicalValidator->isValid($userService->createPasswordResetToken($user))) {
            return array('errors' => $identicalValidator->getMessages());
        }

        $request = $this->getRequest();

        $form = new PasswordResetForm($this->EmPlugin()->getEntityManager(), $request->getRequestUri());

        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $data = $form->getData();

                $user->setPassword(sha1($data['password']));

                $this->EmPlugin()->getEntityManager()->persist($user);
                $this->EmPlugin()->getEntityManager()->flush();

                $this->flashMessenger()->addSuccessMessage('Great! Your password has been reset.');
                return $this->redirect()->toRoute('user', array('action' => 'login'));
            }
        }

        $this->layout()->title = "reset password";

        return array('form' => $form);
    }
}