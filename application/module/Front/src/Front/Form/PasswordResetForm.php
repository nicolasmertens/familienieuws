<?php
namespace Front\Form;

use Doctrine\ORM\EntityManager;

use Zend\Form\Form;

class PasswordResetForm extends Form
{

    public function __construct(EntityManager $em, $url)
    {
        parent::__construct('passwordresetform');

        $filters = new PasswordResetInputFilter();

        $this->setAttribute('method', 'post')
             ->setAttribute('action', $url)
             ->setInputFilter($filters->getInputFilter());

        $this->add(
            array(
                 'name'       => 'password',
                 'type'       => 'Zend\Form\Element\Password',
                 'attributes' => array(
                     'maxlength'   => '100',
                     'placeholder' => 'enter your new password',
                 )
            )
        );
        $this->add(
            array(
                'name'       => 'rePassword',
                'type'       => 'Zend\Form\Element\Password',
                'attributes' => array(
                    'maxlength'   => '100',
                    'placeholder' => 're-enter your new password',
                )
            )
        );
        $this->add(
            array(
                 'name'       => 'submit',
                 'attributes' => array(
                     'type'  => 'submit',
                     'value' => 'save new password',
                     'class' => 'button prefix',
                 ),
            )
        );
    }
}
