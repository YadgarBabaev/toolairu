<?php

namespace RleeCMS\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    Symfony\Component\Validator\Constraints as Assert;

/**
 * Orders
 *
 * @ORM\Table(name="ordering_products")
 * @ORM\Entity()
 */
class OrderingProducts
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
     * @ORM\ManyToOne(targetEntity="RleeCMS\ShopBundle\Entity\Product")
     * @ORM\JoinColumn(referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private $product;

    /**
     * @ORM\ManyToOne(targetEntity="RleeCMS\ShopBundle\Entity\Color")
     * @ORM\JoinColumn(referencedColumnName="id", nullable=true, onDelete="CASCADE")
     */
    private $color;

    /**
     * @ORM\ManyToOne(targetEntity="RleeCMS\ShopBundle\Entity\Size")
     * @ORM\JoinColumn(referencedColumnName="id", nullable=true, onDelete="CASCADE")
     */
    private $size;

    /**
     * @ORM\Column(type="integer", name="count", options={"default":1})
     */
    private $count;



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
     * Set count
     *
     * @param integer $count
     *
     * @return OrderingProducts
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return integer
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Set product
     *
     * @param \RleeCMS\ShopBundle\Entity\Product $product
     *
     * @return OrderingProducts
     */
    public function setProduct(\RleeCMS\ShopBundle\Entity\Product $product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \RleeCMS\ShopBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set color
     *
     * @param \RleeCMS\ShopBundle\Entity\Color $color
     *
     * @return OrderingProducts
     */
    public function setColor(\RleeCMS\ShopBundle\Entity\Color $color = null)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return \RleeCMS\ShopBundle\Entity\Color
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set size
     *
     * @param \RleeCMS\ShopBundle\Entity\Size $size
     *
     * @return OrderingProducts
     */
    public function setSize(\RleeCMS\ShopBundle\Entity\Size $size = null)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return \RleeCMS\ShopBundle\Entity\Size
     */
    public function getSize()
    {
        return $this->size;
    }
}
