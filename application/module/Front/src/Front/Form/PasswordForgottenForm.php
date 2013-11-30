<?php
namespace Front\Form;

use Doctrine\ORM\EntityManager;

use Zend\Form\Form;

class PasswordForgottenForm extends Form
{

    public function __construct(EntityManager $em, $url)
    {
        parent::__construct('passwordforgottenform');

        $filters = new PasswordForgottenInputFilter();

        $this->setAttribute('method', 'post')
             ->setAttribute('action', $url)
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
                 'name'       => 'submit',
                 'attributes' => array(
                     'type'  => 'submit',
                     'value' => 'send my password',
                     'class' => 'button prefix',
                 ),
            )
        );
    }
}
