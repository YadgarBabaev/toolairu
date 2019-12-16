<?php

namespace RleeCMS\ReferenceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShippingMethod
 * @ORM\Entity()
 * @ORM\Table(name="shipping_method")
 */
class ShippingMethods
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @ORM\Column(name="type", type="integer", nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(name="coast", type="float", nullable=true)
     */
    private $coast;

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getCoast()
    {
        return $this->coast;
    }

    /**
     * @param mixed $coast
     */
    public function setCoast($coast)
    {
        $this->coast = $coast;
    }



    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

}

