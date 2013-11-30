<?php
namespace Common\View\Helper;

use Zend\View\Helper\AbstractHelper;

/**
 * Helper for getting the first error in form->getMessages()
 */
class FormErrorMessage extends AbstractHelper
{

    public function __invoke(array $errors, $elementName = null, $errorNr = 0)
    {
        if (!is_array($errors) || empty($errors)) { // no errors in this form
            return "";
        }

        if (is_null($elementName)) {
            $elementError = current($errors);
        } else {
            if (!isset($errors[$elementName])) { // no errors for this element
                return "";
            }
            $elementError = $errors[$elementName];
        }

        if (!is_array($elementError)) {
            return $elementError;
        }

        if (!is_string($errorNr)) {
            $elementError = array_values($elementError);
        }

        if (!isset($elementError[$errorNr])) { // error not found for this element
            return "";
        }

        return $elementError[$errorNr];
    }
}