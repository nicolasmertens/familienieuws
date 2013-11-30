<?php
namespace Common\Entity;

use Common\Entity\Connector;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Entity(repositoryClass="Common\Repository\UserRepository")
 * @ORM\Table(name="user")
 */
class User
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", length=11);
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     * @var string
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     * @var string
     */
    protected $password;

    /**
     * @ORM\Column(type="boolean", options={"default" = false}, nullable=false)
     * @var boolean
     */
    protected $confirmed;

    /**
     * @ORM\OneToMany(targetEntity="Common\Entity\Connector", cascade={"persist"}, mappedBy="user")
     * @var Connector[]
     */
    protected $connectors = array();

    protected $rePassword;

    public function __construct()
    {
        $this->connectors   = new ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getRePassword()
    {
        return $this->rePassword;
    }

    /**
     * @param string $password
     */
    public function setRePassword($rePassword)
    {
        $this->rePassword = $rePassword;
    }

    /**
     * @return boolean
     */
    public function isConfirmed()
    {
        return $this->confirmed;
    }

    /**
     * @param boolean $confirmed
     */
    public function setConfirmed($confirmed = false)
    {
        $this->confirmed = $confirmed;
    }

    /**
     * @return Connector[]
     */
    public function getConnectors()
    {
        return $this->connectors;
    }

    /**
     * @param array $data
     */
    public function populate($data = array())
    {
        $this->id       = isset($data['id'])       ? $data['id']       : $this->id;
        $this->email    = isset($data['email'])    ? $data['email']    : $this->email;
        $this->password = isset($data['password']) ? $data['password'] : $this->password;
        $this->rePassword = isset($data['rePassword']) ? $data['rePassword'] : $this->rePassword;
        $this->confirmed= isset($data['confirmed'])? $data['confirmed'] : $this->confirmed;
    }
}