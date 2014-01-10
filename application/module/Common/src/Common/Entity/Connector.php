<?php
namespace Common\Entity;

use Common\Entity\Newspaper;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Entity(repositoryClass="Common\Repository\ConnectorRepository")
 * @ORM\Table(name="connector")
 */
class Connector
{
    const FEED_TYPE_FACEBOOK   = 'FACEBOOK';
    const FEED_TYPE_INSTAGRAM  = 'INSTAGRAM';

    private static $feedTypeString = array(
        self::FEED_TYPE_FACEBOOK   => 'Facebook',
        self::FEED_TYPE_INSTAGRAM  => 'Instagram',
    );

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", length=11);
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    protected $id;

    /**
     * @ORM\Column(type="string", nullable=false, columnDefinition="ENUM('FACEBOOK', 'INSTAGRAM')", name="type")
     * @var string $type
     */
    protected $type;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @var string
     */
    protected $requestId;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     * @var string
     */
    protected $uniqueId;

    /**
     * @ORM\Column(type="string", length=400, nullable=true)
     * @var string
     */
    protected $accessToken;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @var string
     */
    protected $firstname;
    
    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @var string
     */
    protected $lastname;
    
    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @var string
     */
    protected $email;

    /**
     * @ORM\Column(type="boolean", options={"default" = false}, nullable=false)
     * @var boolean $active
     */
    protected $active = false;

    /**
     * @ORM\ManyToOne(targetEntity="Common\Entity\Newspaper", inversedBy="connectors", cascade={"persist"}, fetch="LAZY")
     * @ORM\JoinColumn(nullable=false, name="newspaper_id", referencedColumnName="id")
     * @var Newspaper
     **/
    protected $newspaper;

    public function __construct()
    {
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
    public function getType($value = true)
    {
        if ($value === true) {
            return $this->type;
        } else {
            if (!is_null($this->type) && isset(self::$feedTypeString[$this->type])) {
                return self::$feedTypeString[$this->type];
            } else {
                return null;
            }
        }
    }

    public static function getTypes()
    {
        return self::$feedTypeString;
    }

    /**
     * 
     * @param string $type
     * @return Connector
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getRequestId()
    {
        return $this->requestId;
    }

    /**
     * @param string $requestId
     * @return Connector
     */
    public function setRequestId($requestId)
    {
        $this->requestId = $requestId;
        return $this;
    }

    /**
     * @return string $value
     */
    public function getUniqueId()
    {
        return $this->uniqueId;
    }

    /**
     * @param string $uniqueid
     * @return Connector
     */
    public function setUniqueId($uniqueId)
    {
        $this->uniqueId = $uniqueId;
        return $this;
    }

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param string $accessToken
     * @return Connector
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     * @return Connector
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     * @return Connector
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
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
     * @return Connector
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * 
     * @param boolean $active
     * @return Connector
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @return boolean $active
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @return Newspaper
     */
    public function getNewspaper()
    {
        return $this->newspaper;
    }

    /**
     * @param \Common\Entity\Connector $connector
     * @return Connector
     */
    public function setNewspaper(Newspaper $newspaper = null)
    {
        $this->newspaper = $newspaper;
        return $this;
    }
}