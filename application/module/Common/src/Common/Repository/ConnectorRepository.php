<?php
namespace Common\Repository;

use Doctrine\ORM\EntityRepository;

class ConnectorRepository extends EntityRepository
{

    /**
     * Initializes a new ConnectorRepository.
     *
     * @param EntityManager $em The EntityManager to use.
     * @param ClassMetadata $classMetadata The class descriptor.
     */
    public function __construct($em, \Doctrine\ORM\Mapping\ClassMetadata $class)
    {
        parent::__construct($em, $class);
    }
}