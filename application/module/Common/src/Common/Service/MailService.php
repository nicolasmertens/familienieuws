<?php
namespace Common\Service;

use Common\Service\MailService\EmailList,
    Common\Service\MailService\EmailAddress;

use Zend\Mail\Message,
	Zend\ServiceManager\ServiceManager;

class MailService
{

    protected $serviceManager;

    /** @var $transport */
    protected $transport;

    /** @var array */
    protected $mailServiceConfig;

    /**
     * Mail view
     * @var string 
     */
    protected $view = '';

    /**
     * Mail layout
     * @var string
     */
    protected $layout = 'layout/mail';

    /**
     * The view variables
     * @var array
     */
    protected $variables = array();

    /**
     * Constructor
     */
    public function __construct()
    {
    }

    public function setMailTransport($transport = null)
    {
		$this->transport = $transport;
		
		return $this;
    }

    private function getMailTransport()
    {
        if (null == $this->transport) {
            $this->setMailTransport();
        }
        return $this->transport;
    }

    /**
     * @param ServiceManager $serviceManager 
     */
    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;

        return $this;
    }

    /**
     * @return ServiceManager 
     */
    private function getServiceManager()
    {
        return $this->serviceManager;
    }

    /**
     * @param array $variables 
     */
    public function setVariables(array $variables = array())
    {
        $this->variables = $variables;
        
        return $this;
    }

    /**
     * @return array
     */
    private function getVariables()
    {
        return $this->variables;
    }

    /**
     * @param string $layout
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;
        
        return $this;
    }

    /**
     * @return string
     */
    private function getLayout()
    {
        return $this->layout;
    }

    /**
     * @param string $view 
     */
    public function setView($view)
    {
        $this->view = $view;
        
        return $this;
    }

    /**
     * @return string
     */
    private function getView()
    {
        return $this->view;
    }

    /**
     * @param array $config
     */
    public function setConfig(array $config = null)
    {
        if ($config == null) {
            $this->mailServiceConfig = array();
        } else {
            $this->mailServiceConfig = $config;
        }
        
        return $this;
    }

    /**
     * @return array
     */
    private function getConfig()
    {
        if ($this->mailServiceConfig == null) {
            $this->setConfig();
        }
        return $this->mailServiceConfig;
    }

    /**
     * @param      $subject
     * @param      $toEmailAddresses
     * @param      $emailBody
     * @param null $fromEmailAddresses
     *
     * @return bool
     */
    public function sendMail($subject, $toEmailAddresses, $fromEmailAddresses = null)
    { 
        // Content
        $emailBody = $this->render();

        // Check for "From" address
        $addresses = $this->resolveEmailAddresses($fromEmailAddresses, true);
        if ($addresses == null || count($addresses->getEmailList()) != 1) {
            return false;
        } else {
            /** @var EmailAddress $fromEmailAddress */
            $fromEmailAddress = current($addresses->getEmailList());
        }

        // Check for "To" addresses
        $addresses = $this->resolveEmailAddresses($toEmailAddresses);
        if ($addresses == null || count($addresses->getEmailList()) === 0) {
            return false;
        }

        // Send
        $transport = $this->getMailTransport();
        foreach ($addresses->getEmailList() as $address) {
			$message = new Message();
			$message->addTo($address->getEmail(), $address->getName())
			        ->addFrom($fromEmailAddress->getEmail(), $fromEmailAddress->getName())
			        ->setSubject($subject)
			        ->setBody($emailBody);
            $transport->send($message);
        }

        return true;
    }

    /**
     * Renders the view and the layout
     * @return string
     */
    private function render()
    {
        $renderer = $this->getServiceManager()->get('ViewRenderer');  

        if ($this->getVariables()) {
            $renderer->setVars($this->getVariables());
        }
        $content  = $renderer->render($this->getView(), null); 

        $renderer->setVars(array(
            'content' => $content
        ));
        $content  = $renderer->render($this->getLayout(), null); 

        return $content;
    }

    /**
     *
     * @param string  $addresses
     * @param boolean $useDefault
     *
     * @return NULL|EmailList
     */
    private function resolveEmailAddresses($addresses, $useDefault = false)
    {
        $result = null;

        $config = $this->getConfig();

        if ($addresses != null) {
            if (isset($config[$addresses])) {
                $result = new EmailList($config[$addresses]);
            } else {
                $result = new EmailList($addresses);
            }
        }

        if ($useDefault === true && ($result == null || count($result->getEmailList()) === 0)) {
            $fromName = '"Support"';
            $result = new EmailList($fromName . " " . $config['from-default-email']);
        }

        return $result;
    }
}