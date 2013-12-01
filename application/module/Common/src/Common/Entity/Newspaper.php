<?php
namespace Common\Entity;

use Common\Entity\Connector;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Entity(repositoryClass="Common\Repository\NewspaperRepository")
 * @ORM\Table(name="newspaper")
 */
class Newspaper
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
    protected $name;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     * @var string
     */
    protected $email;
    
    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     * @var string
     */
    protected $zipcode;
    
    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     * @var string
     */
    protected $city;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     * @var string
     */
    protected $street;

    /**
     * @ORM\Column(type="string", length=10, nullable=false)
     * @var string
     */
    protected $number;

    /**
     * @ORM\OneToMany(targetEntity="Common\Entity\Connector", cascade={"persist"}, mappedBy="newspaper")
     * @var Connector[]
     */
    protected $connectors = array();

    public function __construct()
    {
        $this->connectors = new ArrayCollection();
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
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

    public function getZipcode()
    {
        return $this->zipcode;
    }
    
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
        return $this;
    }
    
    public function getCity()
    {
        return $this->city;
    }
    
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }
    
    public function getStreet()
    {
        return $this->street;
    }
    
    public function setStreet($street)
    {
        $this->street = $street;
        return $this;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function setNumber($number)
    {
        $this->number = $number;
    }
    
    public function getConnectors()
    {
        return $this->connectors;
    }
}