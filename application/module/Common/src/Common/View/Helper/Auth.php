<?php
namespace Common\View\Helper;

use Common\Service\AuthService;

use Zend\View\Helper\AbstractHelper;

/**
 * View helper for auth.
 */
class Auth extends AbstractHelper
{
    private $options = array();

    /**
     * Translate a message.
     *
     * @param  string $controller
     * @param  string $action
     * @param  string $privilige
     * @return bool
     * @throws Exception\RuntimeException
     */
    public function __invoke($options = array())
    {
        $this->options = $options;

        return $this;
    }
    
    public function isAllowed()
    {
        return AuthService::getInstance()->isAllowed($this->options);
    }
    
    public function hasIdentity()
    {
        return AuthService::getInstance()->hasIdentity();
    }
    
    public function getIdentity()
    {
        return AuthService::getInstance()->getIdentity();
    }

    public function getRole()
    {
        return AuthService::getInstance()->getRole();
    }

    public function hasRole($role)
    {
        return AuthService::getInstance()->hasRole($role);
    }
}