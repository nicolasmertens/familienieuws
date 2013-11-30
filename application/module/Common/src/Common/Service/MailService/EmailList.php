<?php
namespace Common\Service\MailService;

class EmailList
{

    private $list;

    /**
     * "some name"<email@host.com>;...
     *
     * @param $emailAdressesString
     */
    public function __construct($emailAdressesString)
    {
        //"some name"<email@host.com>;...
        $this->list = array();
        $emailAdresses = explode(';', $emailAdressesString);

        foreach($emailAdresses as $emailAddressString)
        {
            $email = EmailAddress::FromString($emailAddressString);
            if(!is_null($email)) {
                $this->list[] = $email;
            }
        }
    }

    public function getEmailList()
    {
        return $this->list;
    }
}