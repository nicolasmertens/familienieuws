<?php
namespace Common\Validator;

use Doctrine\ORM\EntityManager;

use Zend\Validator\AbstractValidator,
    Zend\Validator\Exception,
    Zend\Stdlib\ArrayUtils;

class UserExists extends AbstractValidator
{

    /**
     * Error constants
     */
    const ERROR_NO_OBJECT_FOUND = 'noObjectFound';

    /**
     * @var array Message templates
     */
    protected $messageTemplates
        = array(
            self::ERROR_NO_OBJECT_FOUND => "No object matching '%value%' was found",
        );

    /**
     * EntityManager
     *
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var Brand
     */
    protected $brand = null;

    /**
     * Constructor
     *
     * @param array $options required keys are `object_repository`, which must be an instance of
     *                       Doctrine\Common\Persistence\ObjectRepository, and `fields`, with either
     *                       a string or an array of strings representing the fields to be matched by the validator.
     *
     * @throws \Zend\Validator\Exception\InvalidArgumentException
     */
    public function __construct(array $options)
    {
        if (!isset($options['entity_manager']) || !$options['entity_manager'] instanceof EntityManager) {
            if (!array_key_exists('entity_manager', $options)) {
                $provided = 'nothing';
            } else {
                if (is_object($options['entity_manager'])) {
                    $provided = get_class($options['entity_manager']);
                } else {
                    $provided = getType($options['entity_manager']);
                }
            }

            throw new Exception\InvalidArgumentException(sprintf(
                'Option "entity_manager" is required and must be an instance of'
                    . ' Doctrine\ORM\EntityManager, %s given',
                $provided
            ));
        }
        $this->entityManager = $options['entity_manager'];

        parent::__construct($options);
    }

    /**
     * {@inheritDoc}
     */
    public function isValid($value)
    {
        $match = $this->entityManager
                      ->getRepository('Common\Entity\User')
                      ->findOneByEmail($value, $this->brand);

        if (is_object($match)) {
            return true;
        }

        $this->error(self::ERROR_NO_OBJECT_FOUND, $value);

        return false;
    }
}
