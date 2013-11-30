<?php
namespace Front\Form;

use Doctrine\ORM\EntityManager;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject;

use Zend\Form\Form;

class LoginForm extends Form {

    public function __construct(EntityManager $em, $url)
    {
        parent::__construct('loginform');

        $filters = new LoginInputFilter();

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
                )
            )
        );

        $this->add(
            array(
                'name' => 'password',
                'type' => 'Zend\Form\Element\Password',
                'attributes' => array(
                    'placeholder' => 'enter your password',
                ),
            )
        );

        $this->add(
            array(
                'name' => 'submit',
                'attributes' => array(
                    'type'        => 'submit',
                    'value'       => 'login',
                    'class'       => 'button prefix',
                ),
            )
        );
    }

}