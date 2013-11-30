<?php
namespace Common\Entity;

use Common\Entity\User;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Entity(repositoryClass="Common\Repository\ConnectorRepository")
 * @ORM\Table(name="connector")
 */
class Connector
{
    const FEED_TYPE_TWITTER    = 'TWITTER';
    const FEED_TYPE_FACEBOOK   = 'FACEBOOK';
    const FEED_TYPE_FOURSQUARE = 'FOURSQUARE';
    const FEED_TYPE_INSTAGRAM  = 'INSTAGRAM';

    private static $feedTypeString = array(
        self::FEED_TYPE_TWITTER    => 'Twitter',
        self::FEED_TYPE_FACEBOOK   => 'Facebook',
        self::FEED_TYPE_FOURSQUARE => 'Foursquare',
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
     * @ORM\Column(type="string", nullable=false, columnDefinition="ENUM('TWITTER', 'FOURSQUARE', 'FACEBOOK', 'INSTAGRAM')", name="type")
     * @var string $type
     */
    protected $type;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     * @var string
     */
    protected $name;

    /**
     * @ORM\Column(name="value", type="text", nullable=false)
     * @var string $value
     */
    protected $value;

    /**
     * @ORM\ManyToOne(targetEntity="Common\Entity\User", inversedBy="connectors", cascade={"persist"}, fetch="LAZY")
     * @ORM\JoinColumn(nullable=false, name="user_id", referencedColumnName="id")
     * @var User
     **/
    protected $user;

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Connector
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string $value
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return Connector
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param \Common\Entity\User $user
     * @return Connector
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;
        return $this;
    }

}