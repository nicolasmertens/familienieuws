<?php
namespace Common\Repository;

use Doctrine\ORM\EntityRepository;

class NewspaperRepository extends EntityRepository
{

    /**
     * Initializes a new NewspaperRepository.
     *
     * @param EntityManager $em The EntityManager to use.
     * @param ClassMetadata $classMetadata The class descriptor.
     */
    public function __construct($em, \Doctrine\ORM\Mapping\ClassMetadata $class)
    {
        parent::__construct($em, $class);
    }
}