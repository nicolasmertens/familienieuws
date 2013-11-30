<?php
namespace Common\Service;

use Common\Entity\User;

use Zend\Crypt\Symmetric\Mcrypt,
    Zend\Validator\EmailAddress;

class UserService
{
    /** @var \Doctrine\ORM\EntityManager $em */
    protected $em = null;

    /** @var \Front\Authentication\OpenIdStorage $openIdStorage */
    protected $openIdStorage = null;

    protected $mcrypt = null;

    protected $serviceLocator = null;

    public function __construct()
    {
    }

    public function setEntityManager($em)
    {
        $this->em = $em;
    }

    protected function getEntityManager()
    {
        if ($this->em == null) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }

    public function setMcrypt(Mcrypt $mcrypt)
    {
        $this->mcrypt = $mcrypt;
    }

    protected function getMcrypt()
    {
        return $this->mcrypt;
    }

    public function setServiceLocator($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    protected function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    protected function base64url_encode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    protected function base64url_decode($data)
    {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }



    public function createRegistrationToken($email)
    {
        $token = $this->base64url_encode($this->getMcrypt()->encrypt($email));
        return $token;
    }

    public function getEmailFromRegistrationToken($encryptedMail)
    {
        $email = null;
        if (isset($encryptedMail)) {
            $urlDecodedmail    = urldecode($encryptedMail);
            $base64Decodedmail = $this->base64url_decode($urlDecodedmail);
            $email             = $this->getMcrypt()->decrypt($base64Decodedmail);
            $emailValidator    = new EmailAddress();
            if ($emailValidator->isValid($email) === false) {
                $mail = null;
            }
        }

        return $email;
    }

    public function createPasswordResetToken(User $user)
    {
        $token = $this->base64url_encode(
            $user->getEmail() . '|' . md5($user->getEmail() . $user->getPassword())
        );
        return $token;
    }
}