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
                ->setAttribute('style', 'width:170px;')
                ->setHydrator(new DoctrineObject($em, 'Common\Entity\Newspaper'))
                ->setInputFilter($filters->setEntityManager($em)->getInputFilter());

        $this->add(
            array(
                'type' => 'Zend\Form\Element\Text',
                'name' => 'name',
                'options' => array(
                    'label' => 'Naam grootouder(s): *',
                ),
                'attributes' => array(
                    'maxlength' => 50,
                    'size'      => 50,                    
                )
            )
        );

        $this->add(
            array(
                'type' => 'Zend\Form\Element\Text',
                'name' => 'street',
                'options' => array(
                    'label' => 'Straat: *',
                ),
                'attributes' => array(
                    'maxlength' => 50,
                    'size'      => 50,                    
                )
            )
        );

        $this->add(
            array(
                'type' => 'Zend\Form\Element\Text',
                'name' => 'number',
                'options' => array(
                    'label' => 'Huisnummer: *',
                ),
                'attributes' => array(
                    'maxlength' => 50,
                    'size'      => 50,                    
                )
            )
        );
        
        $this->add(
            array(
                'type' => 'Zend\Form\Element\Text',
                'name' => 'zipcode',
                'options' => array(
                    'label' => 'Postcode: *',
                ),
                'attributes' => array(
                    'maxlength' => 50,
                    'size'      => 50,                    
                )
            )
        );

        $this->add(
            array(
                'type' => 'Zend\Form\Element\Text',
                'name' => 'city',
                'options' => array(
                    'label' => 'Gemeente: *',
                ),
                'attributes' => array(
                    'maxlength' => 50,
                    'size'      => 50,                    
                )
            )
        );

        $this->add(
            array(
                'name' => 'email',
                'type' => 'Zend\Form\Element\Email',
                'options' => array(
                    'label' => 'Email: *',
                ),
                'attributes' => array(
                    'maxlength'   => 50,
                    'size'        => 50,
                ),
            )
        );

        $this->add(
            array(
                'name' => 'submit',
                'attributes' => array(
                    'type'        => 'submit',
                    'value'       => 'registreer',
                    'class'       => 'button large default',
                ),
            )
        );
    }

}