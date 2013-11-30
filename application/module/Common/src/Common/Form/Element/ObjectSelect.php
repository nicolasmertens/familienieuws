<?php
namespace Common\Form\Element;

use DoctrineModule\Form\Element\ObjectSelect AS DoctrineSelect;

/**
 * Bugfix class for DoctrineModule\Form\Element\ObjectSelect
 * setValue $value is a Proxy-class, this is not working line 243
 * some say it will be fixed in doctrine 2.4
 */
class ObjectSelect extends DoctrineSelect
{

    /**
     * {@inheritDoc}
     */
    public function setValue($value)
    {
        if (is_object($value) && in_array('Doctrine\ORM\Proxy\Proxy', class_implements($value))) {
            return parent::setValue($value->getId());
        } else {
            return parent::setValue($this->getProxy()->getValue($value));
        }
    }
}