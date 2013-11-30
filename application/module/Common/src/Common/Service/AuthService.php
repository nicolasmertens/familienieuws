<?php
namespace Common\Service;

use Acl\Model\Resource,
    Acl\Model\Role,
    Acl\Service\Acl;

use Common\Entity\User;

use Zend\ServiceManager\ServiceManager;

class AuthService
{

    /**
     * @var Acl
     */
    private $acl  = null;

    /**
     * @var Zend\Authentication\AuthenticationService 
     */
    private $auth = null;

    private static $instance;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if(!isset(self::$instance)) {
            self::$instance = new AuthService();
        }

        return self::$instance;
    }

    public static function init(ServiceManager $sm)
    {
        self::getInstance();

        self::$instance->setAuth($sm->get('Zend\Authentication\AuthenticationService'));
    //    self::$instance->setAcl($sm->get('alc_acl'));
    }

    /**
     * @param Acl $acl 
     */
    private function setAcl(Acl $acl)
    {
        $this->acl = $acl;
    }
    
    private function setAuth($auth)
    {
        $this->auth = $auth;
    }

    /**
     * @return User
     */
    public function getIdentity()
    {
        return $this->auth->getIdentity();
    }

    /**
     * @return boolean 
     */
    public function hasIdentity()
    {
        return $this->auth->hasIdentity();
    }
    
    public function clearIdentity()
    {
        $this->auth->clearIdentity();
        $this->acl = null;
    }

    /**
     * @return enum
     */
    public function getRole()
    {
        return 'GUEST';
        if ($this->hasIdentity()) {
            return $this->auth->getIdentity()->getUserBrandAssociations()->get(0)->getAclRole(true);
        } else {
            return 'GUEST';
        }
    }

    /**
     * @param enum $role
     * @return boolean 
     */
    public function hasRole($role)
    {
        if ($this->getRole() == $role) {
            return true;
        } else {
            return false;
        }
    }

    public function isAllowed($options) {
        $resource = new Resource();
        $role     = new Role();

        if (isset($options['controller'])) {
            $resource->setController($options['controller']);
        }
        if (isset($options['action'])) {
            $resource->setAction($options['action']);
        }
        if (isset($options['resource'])) {
            $resources = explode("::", $options['resource']);
            if (isset($resources[0])) {
                $resource->setController($resources[0]);
            }
            if (isset($resources[1])) {
                $resource->setAction($resources[1]);
            }
        }
        if (isset($options['privilege'])) {
            $privilege = $options['privilege'];
        } else {
            $privilege = "GET";
        }

        $role->setName($this->getRole());

        if(! $this->acl->isAllowed($role, $resource, $privilege)) {
            return false;
        } else {
            return true;
        }
    }
}