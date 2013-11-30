<?php

namespace Front\Form;

use Doctrine\ORM\EntityManager;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject;

use Front\Form\SignupInputFilter;

use Zend\Form\Form;

class SignupForm extends Form {

    public function __construct(EntityManager $em, $url)
    {
        parent::__construct('signupform');

        $filters = new SignupInputFilter();

        $this->setAttribute('method', 'post')
                ->setAttribute('action', $url)
                ->setHydrator(new DoctrineObject($em, 'Common\Entity\User'))
                ->setInputFilter($filters->setEntityManager($em)->getInputFilter());

        $this->add(
            array(
                'name' => 'email',
                'type' => 'Zend\Form\Element\Email',
                'attributes' => array(
                    'placeholder' => 'enter your email address',
                ),
            )
        );

        $this->add(
            array(
                'name' => 'password',
                'type' => 'Zend\Form\Element\Password',
                'attributes' => array(
                    'maxlength'   => '100',
                    'placeholder' => 'enter your password',
                ),
            )
        );
        $this->add(
            array(
                'name' => 'rePassword',
                'type' => 'Zend\Form\Element\Password',
                'attributes' => array(
                    'maxlength'   => '100',
                    'placeholder' => 're-enter your password',
                ),
            )
        );

        $this->add(
            array(
                'name' => 'submit',
                'attributes' => array(
                    'type'        => 'submit',
                    'value'       => 'sign up for free',
                    'class'       => 'button prefix',
                ),
            )
        );
    }

}