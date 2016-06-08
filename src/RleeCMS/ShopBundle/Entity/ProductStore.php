<?php

namespace RleeCMS\ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Product
 *
 * @ORM\Table(name="shop_product_stroe")
 * @ORM\Entity(repositoryClass="RleeCMS\ShopBundle\Repository\ProductStoreRepository")
 */
class ProductStore
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
     * @ORM\ManyToOne(targetEntity="Size")
     * @ORM\JoinColumn(name="size_id", referencedColumnName="id")
     **/
    private $size;

    /**
     * @ORM\ManyToOne(targetEntity="Color")
     * @ORM\JoinColumn(name="color_id", referencedColumnName="id")
     **/
    private $color;

    /**
     * @ORM\ManyToOne(targetEntity="Product")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    private $product;

    /**
     * @ORM\ManyToOne(targetEntity="Store")
     * @ORM\JoinColumn(name="store_id", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    private $store;

    /**
     * @var integer
     *
     * @ORM\Column(name="count", type="integer", length=255)
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
     * Set size
     *
     * @param \RleeCMS\ShopBundle\Entity\Size $size
     *
     * @return ProductStore
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

    /**
     * Set color
     *
     * @param \RleeCMS\ShopBundle\Entity\Color $color
     *
     * @return ProductStore
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
     * Set product
     *
     * @param \RleeCMS\ShopBundle\Entity\Product $product
     *
     * @return ProductStore
     */
    public function setProduct(\RleeCMS\ShopBundle\Entity\Product $product = null)
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
     * Set store
     *
     * @param \RleeCMS\ShopBundle\Entity\Store $store
     *
     * @return ProductStore
     */
    public function setStore(\RleeCMS\ShopBundle\Entity\Store $store = null)
    {
        $this->store = $store;

        return $this;
    }

    /**
     * Get store
     *
     * @return \RleeCMS\ShopBundle\Entity\Store
     */
    public function getStore()
    {
        return $this->store;
    }

    /**
     * Set count
     *
     * @param integer $count
     *
     * @return ProductStore
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
}
