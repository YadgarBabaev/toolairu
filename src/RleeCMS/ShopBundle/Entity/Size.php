<?php

namespace RleeCMS\ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Size
 *
 * @ORM\Table(name="shop_size")
 * @ORM\Entity()
 */
class Size
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
     * @ORM\Column(name="size", type="string")
     */
    private $size;

    /**
     * @var string
     *
     * @ORM\Column(name="marking", type="string", length=255, nullable=true)
     */
    private $marking;

    /**
     * @var float
     *
     * @ORM\Column(name="height", type="float", nullable=true)
     */
    private $height;

    /**
     * @var float
     *
     * @ORM\Column(name="bust", type="float", nullable=true)
     */
    private $bust;

    /**
     * @var float
     *
     * @ORM\Column(name="waist", type="float", nullable=true)
     */
    private $waist;

    /**
     * @var float
     *
     * @ORM\Column(name="hips", type="float", nullable=true)
     */
    private $hips;

    /**
     * @var float
     *
     * @ORM\Column(name="front_waist_length", type="float", nullable=true)
     */
    private $front_waist_length;

    /**
     * @var float
     *
     * @ORM\Column(name="bust_depth", type="float", nullable=true)
     */
    private $bust_depth;

    /**
     * @var float
     *
     * @ORM\Column(name="back_length", type="float", nullable=true)
     */
    private $back_length;

    /**
     * @var float
     *
     * @ORM\Column(name="back_width", type="float", nullable=true)
     */
    private $back_width;

    /**
     * @var float
     *
     * @ORM\Column(name="shoulder_width", type="float", nullable=true)
     */
    private $shoulder_width;

    /**
     * @var float
     *
     * @ORM\Column(name="hand_length", type="float", nullable=true)
     */
    private $hand_length;

    /**
     * @ORM\ManyToMany(targetEntity="Product", mappedBy="categories")
     **/
    private $products;

    public function __toString()
    {
        return $this->getSize();
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set size
     *
     * @param string $size
     *
     * @return Size
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set marking
     *
     * @param string $marking
     *
     * @return Size
     */
    public function setMarking($marking)
    {
        $this->marking = $marking;

        return $this;
    }

    /**
     * Get marking
     *
     * @return string
     */
    public function getMarking()
    {
        return $this->marking;
    }

    /**
     * Set bust
     *
     * @param float $bust
     *
     * @return Size
     */
    public function setBust($bust)
    {
        $this->bust = $bust;

        return $this;
    }

    /**
     * Get bust
     *
     * @return float
     */
    public function getBust()
    {
        return $this->bust;
    }

    /**
     * Set waist
     *
     * @param float $waist
     *
     * @return Size
     */
    public function setWaist($waist)
    {
        $this->waist = $waist;

        return $this;
    }

    /**
     * Get waist
     *
     * @return float
     */
    public function getWaist()
    {
        return $this->waist;
    }

    /**
     * Set hips
     *
     * @param float $hips
     *
     * @return Size
     */
    public function setHips($hips)
    {
        $this->hips = $hips;

        return $this;
    }

    /**
     * Get hips
     *
     * @return float
     */
    public function getHips()
    {
        return $this->hips;
    }

    /**
     * Set frontWaistLength
     *
     * @param float $frontWaistLength
     *
     * @return Size
     */
    public function setFrontWaistLength($frontWaistLength)
    {
        $this->front_waist_length = $frontWaistLength;

        return $this;
    }

    /**
     * Get frontWaistLength
     *
     * @return float
     */
    public function getFrontWaistLength()
    {
        return $this->front_waist_length;
    }

    /**
     * Set bustDepth
     *
     * @param float $bustDepth
     *
     * @return Size
     */
    public function setBustDepth($bustDepth)
    {
        $this->bust_depth = $bustDepth;

        return $this;
    }

    /**
     * Get bustDepth
     *
     * @return float
     */
    public function getBustDepth()
    {
        return $this->bust_depth;
    }

    /**
     * Set backLength
     *
     * @param float $backLength
     *
     * @return Size
     */
    public function setBackLength($backLength)
    {
        $this->back_length = $backLength;

        return $this;
    }

    /**
     * Get backLength
     *
     * @return float
     */
    public function getBackLength()
    {
        return $this->back_length;
    }

    /**
     * Set backWidth
     *
     * @param float $backWidth
     *
     * @return Size
     */
    public function setBackWidth($backWidth)
    {
        $this->back_width = $backWidth;

        return $this;
    }

    /**
     * Get backWidth
     *
     * @return float
     */
    public function getBackWidth()
    {
        return $this->back_width;
    }

    /**
     * Set shoulderWidth
     *
     * @param float $shoulderWidth
     *
     * @return Size
     */
    public function setShoulderWidth($shoulderWidth)
    {
        $this->shoulder_width = $shoulderWidth;

        return $this;
    }

    /**
     * Get shoulderWidth
     *
     * @return float
     */
    public function getShoulderWidth()
    {
        return $this->shoulder_width;
    }

    /**
     * Set handLength
     *
     * @param float $handLength
     *
     * @return Size
     */
    public function setHandLength($handLength)
    {
        $this->hand_length = $handLength;

        return $this;
    }

    /**
     * Get handLength
     *
     * @return float
     */
    public function getHandLength()
    {
        return $this->hand_length;
    }

    /**
     * Add product
     *
     * @param \RleeCMS\ShopBundle\Entity\Product $product
     *
     * @return Size
     */
    public function addProduct(\RleeCMS\ShopBundle\Entity\Product $product)
    {
        $this->products[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \RleeCMS\ShopBundle\Entity\Product $product
     */
    public function removeProduct(\RleeCMS\ShopBundle\Entity\Product $product)
    {
        $this->products->removeElement($product);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Set height
     *
     * @param float $height
     *
     * @return Size
     */
    public function setHeight($height)
    {
        $this->height = $height;
    
        return $this;
    }

    /**
     * Get height
     *
     * @return float
     */
    public function getHeight()
    {
        return $this->height;
    }
}
