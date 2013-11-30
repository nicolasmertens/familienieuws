<?php
namespace Common\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class EntityManagerPlugin extends AbstractPlugin
{

    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $em = null;

    public function getEntityManager()
    {
        if (null === $this->em) {
            $this->em = $this->getController()->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }
}
