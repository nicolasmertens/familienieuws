<?php
namespace Front\Form;

use Zend\InputFilter\Factory as InputFactory,
    Zend\InputFilter\InputFilter,
    Zend\InputFilter\InputFilterAwareInterface,
    Zend\InputFilter\InputFilterInterface;

class PasswordResetInputFilter implements InputFilterAwareInterface
{

    /**
     * @var InputFilterInterface
     */
    private $inputFilter = null;

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
     * Retrieve input filter for the registration form
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
                     'name'       => 'password',
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
                                 'min'      => 8,
                                 'max'      => 100,
                                 'messages' => array(
                                    \Zend\Validator\StringLength::INVALID  => "Your password should be at least 8 characters long",
                                    \Zend\Validator\StringLength::TOO_LONG => "Your password should be at least 8 characters long",
                                    \Zend\Validator\StringLength::TOO_SHORT => "Your password should be at least 8 characters long",
                                 ),
                             ),
                         ),
                     ),
                )
            )
        );

        $this->inputFilter->add(
            $factory->createInput(
                array(
                     'name'       => 'rePassword',
                     'required'   => true,
                     'filters'    => array(
                         array('name' => 'StripTags'),
                         array('name' => 'StringTrim'),
                     ),
                     'validators' => array(
                         array(
                             'name'    => 'Identical',
                             'options' => array(
                                 'token'    => 'password',
                                 'messages' => array(
                                     \Zend\Validator\Identical::NOT_SAME => 'Confirm password does not match'
                                 ),
                             ),
                         ),
                     ),
                )
            )
        );

        return $this->inputFilter;
    }
}