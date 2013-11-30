<?php
namespace Common\Service\MailService;

class EmailAddress
{

    private $name;

    private $email;

    /**
     * The string should can formed 3 ways:
     * <ul>
     * <li> "some name" <email@host.com> </li>
     * <li> <email@host.com> </li>
     * <li> email@host.com </li>
     * </ul>
     *
     * @param $emailAddressString
     *
     * @return EmailAddress|null
     */
    public static function FromString($emailAddressString)
    {
        $result = null;
        $email = null;

        if (is_string($emailAddressString)) {

            $name = self::getStringBetween('"', '"', $emailAddressString);
            if ($name == null) {
                $name = '';
            }
            $email = self::extractValidEmailAddress(
                self::getStringBetween('<', '>', $emailAddressString)
            );

            if ($name == null && $email == null) {
                $email = self::extractValidEmailAddress($emailAddressString);
            }

            if ($email != null) {
                $result = new EmailAddress($name, $email);
            }
        }

        return $result;
    }

    /**
     * @return null|string
     */
    public function toString()
    {
        if (strlen($this->name) && strlen($this->email)) {
            $result = '"' . $this->name . '" <' . $this->email . '>';
        } elseif (strlen($this->email)) {
            $result = $this->email;
        } else {
            $result = null;
        }

        return $result;
    }

    /**
     * @param $emailAddressString
     *
     * @return null
     */
    private static function extractValidEmailAddress($emailAddressString)
    {
        $email = null;

        $nrOfMatches = preg_match(
            '<^([a-z0-9+.&_$!#%~\'*/=?{|}`\^\-]+@(([a-z0-9][a-z0-9\-]*)*[a-z0-9]\.)+[a-z]{2,6})?$>i',
            trim($emailAddressString), $matches
        );
        if ($nrOfMatches > 0) {
            $email = $matches[0];
        }

        return $email;
    }

    /**
     * @param $startChar
     * @param $endChar
     * @param $str
     *
     * @return null
     */
    private static function getStringBetween($startChar, $endChar, $str)
    {
        if (preg_match_all('/' . $startChar . '(.*?)' . $endChar . '/', $str, $result)) {
            return $result[1][0];
        }
        return null;
    }

    /**
     * @param $name
     * @param $email
     */
    public function __construct($name, $email)
    {
        if (is_numeric($name)) {
            $this->name = '';
        } else {
            $this->name = $name;
        }
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }


}