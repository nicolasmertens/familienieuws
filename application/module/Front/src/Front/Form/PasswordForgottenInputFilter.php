<?php
namespace Front\Form;

use Zend\InputFilter\Factory as InputFactory,
    Zend\InputFilter\InputFilter,
    Zend\InputFilter\InputFilterAwareInterface,
    Zend\InputFilter\InputFilterInterface;

class PasswordForgottenInputFilter implements InputFilterAwareInterface
{

    /**
     * @var InputFilterInterface
     */
    private $inputFilter = null;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em = null;

    public function setEntityManager($em)
    {
        $this->em = $em;
        return $this;
    }

    private function getEntityManager()
    {
        return $this->em;
    }

    /**
     * Set input filter
     *
     * @param  InputFilterInterface $inputFilter
     *
     * @return InputFilterAwareInterface
     */
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        if (isset ($inputFilter)) {
            $this->inputFilter = $inputFilter;
        }
        return $this;
    }

    /**
     * Retrieve input filter
     *
     * @return InputFilterInterface
     */
    public function getInputFilter()
    {
        if ($this->inputFilter instanceof InputFilterInterface) {
            return $this->inputFilter;
        }
        
        $this->inputFilter = new InputFilter();
        $factory = new InputFactory();

        $this->inputFilter->add(
            $factory->createInput(
                array(
                    'name'       => 'email',
                    'required'   => true,
                    'filters'    => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim'),
                    ),
                    'validators' => array(
                        array(
                            'name'    => 'StringLength',
                            'options' => array(
                                'encoding' => 'UTF-8',
                                'min'      => 6,
                                'max'      => 100,
                            ),
                        ),
                        array(
                            'name'    => 'EmailAddress',
                        ),
                        array(
                            'name'          => '\Common\Validator\UserExists',
                            'options'       => array(
                                'entity_manager' => $this->getEntityManager(),
                                'messages'  => array(
                                    \Common\Validator\UserExists::ERROR_NO_OBJECT_FOUND => "Email Address Not Found"
                                )
                            ),
                        )
                    ),
                )
            )
        );
        
        return $this->inputFilter;
    }
}
