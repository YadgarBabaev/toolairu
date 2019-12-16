<?php

namespace RleeCMS\ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Currency
 *
 * @ORM\Table(name="shop_setting_currency")
 * @ORM\Entity()
 */
class Currency
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
     *
     * @ORM\Column(name="iso_name", type="string", length=5)
     */
    private $isoName;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="symbol", type="string", length=5, nullable=true)
     */
    private $symbol;

    /**
     * @var string
     *
     * @ORM\Column(name="morph1", type="string", length=25)
     */
    private $morph1;

    /**
     * @var string
     *
     * @ORM\Column(name="morph2", type="string", length=25)
     */
    private $morph2;

    /**
     * @var string
     *
     * @ORM\Column(name="morph5", type="string", length=25)
     */
    private $morph5;

    /**
     * @var string
     *
     * @ORM\Column(name="subunit_morph1", type="string", length=25)
     */
    private $subunitMorph1;

    /**
     * @var string
     *
     * @ORM\Column(name="subunit_morph2", type="string", length=25)
     */
    private $subunitMorph2;

    /**
     * @var string
     *
     * @ORM\Column(name="subunit_morph5", type="string", length=25)
     */
    private $subunitMorph5;

    /**
     * @var string
     *
     * @ORM\Column(name="short_sign", type="string", length=25, nullable=true)
     */
    private $shortSign;

    /**
     * @var boolean
     * @ORM\Column(name="main", type="boolean", options={"default"=false})
     */
    private $main;

    /**
     * @var float
     *
     * @ORM\Column(name="rate", type="float", nullable=true)
     */
    private $rate;

    /**
     * @var boolean
     * @ORM\Column(name="status", type="boolean")
     * @Assert\NotBlank()
     */
    private $status;

    /**
     * @var \DateTime
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;


    /**
     * Currency constructor.
     */
    public function __construct()
    {
        $this->setCreated(new \DateTime());
    }

    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set isoName
     *
     * @param string $isoName
     *
     * @return Currency
     */
    public function setIsoName($isoName)
    {
        $this->isoName = $isoName;

        return $this;
    }

    /**
     * Get isoName
     *
     * @return string
     */
    public function getIsoName()
    {
        return $this->isoName;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Currency
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set symbol
     *
     * @param string $symbol
     *
     * @return Currency
     */
    public function setSymbol($symbol)
    {
        $this->symbol = $symbol;

        return $this;
    }

    /**
     * Get symbol
     *
     * @return string
     */
    public function getSymbol()
    {
        return $this->symbol;
    }

    /**
     * Set morph1
     *
     * @param string $morph1
     *
     * @return Currency
     */
    public function setMorph1($morph1)
    {
        $this->morph1 = $morph1;

        return $this;
    }

    /**
     * Get morph1
     *
     * @return string
     */
    public function getMorph1()
    {
        return $this->morph1;
    }

    /**
     * Set morph2
     *
     * @param string $morph2
     *
     * @return Currency
     */
    public function setMorph2($morph2)
    {
        $this->morph2 = $morph2;

        return $this;
    }

    /**
     * Get morph2
     *
     * @return string
     */
    public function getMorph2()
    {
        return $this->morph2;
    }

    /**
     * Set morph5
     *
     * @param string $morph5
     *
     * @return Currency
     */
    public function setMorph5($morph5)
    {
        $this->morph5 = $morph5;

        return $this;
    }

    /**
     * Get morph5
     *
     * @return string
     */
    public function getMorph5()
    {
        return $this->morph5;
    }

    /**
     * Set subunitMorph1
     *
     * @param string $subunitMorph1
     *
     * @return Currency
     */
    public function setSubunitMorph1($subunitMorph1)
    {
        $this->subunitMorph1 = $subunitMorph1;

        return $this;
    }

    /**
     * Get subunitMorph1
     *
     * @return string
     */
    public function getSubunitMorph1()
    {
        return $this->subunitMorph1;
    }

    /**
     * Set subunitMorph2
     *
     * @param string $subunitMorph2
     *
     * @return Currency
     */
    public function setSubunitMorph2($subunitMorph2)
    {
        $this->subunitMorph2 = $subunitMorph2;

        return $this;
    }

    /**
     * Get subunitMorph2
     *
     * @return string
     */
    public function getSubunitMorph2()
    {
        return $this->subunitMorph2;
    }

    /**
     * Set subunitMorph5
     *
     * @param string $subunitMorph5
     *
     * @return Currency
     */
    public function setSubunitMorph5($subunitMorph5)
    {
        $this->subunitMorph5 = $subunitMorph5;

        return $this;
    }

    /**
     * Get subunitMorph5
     *
     * @return string
     */
    public function getSubunitMorph5()
    {
        return $this->subunitMorph5;
    }

    /**
     * Set shortSign
     *
     * @param string $shortSign
     *
     * @return Currency
     */
    public function setShortSign($shortSign)
    {
        $this->shortSign = $shortSign;

        return $this;
    }

    /**
     * Get shortSign
     *
     * @return string
     */
    public function getShortSign()
    {
        return $this->shortSign;
    }

    /**
     * Set main
     *
     * @param boolean $main
     *
     * @return Currency
     */
    public function setMain($main)
    {
        $this->main = $main;

        return $this;
    }

    /**
     * Get main
     *
     * @return boolean
     */
    public function getMain()
    {
        return $this->main;
    }

    /**
     * Set rate
     *
     * @param float $rate
     *
     * @return Currency
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     *
     * @return float
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set status
     *
     * @param boolean $status
     *
     * @return Currency
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Currency
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }
}
