<?php
namespace Common\Controller\Plugin;

use Common\Service\AuthService;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

/**
 * Controller plugin for auth.
 */
class AuthPlugin extends AbstractPlugin
{
    private $options = array();

    /**
     * Auth plugin.
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
    
    public function clearIdentity()
    {
        return AuthService::getInstance()->clearIdentity();
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