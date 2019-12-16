<?php

namespace RleeCMS\ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ShopByLook
 *
 * @ORM\Table(name="shop_shop_by_look")
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 */
class ShopByLook
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var integer
     * @ORM\Column(name="status", type="integer")
     * @Assert\NotBlank()
     */
    private $status;

    /**
     * @var integer
     * @ORM\Column(name="orderning", type="integer", nullable=true)
     */
    private $orderning;

    /**
     * @ORM\ManyToMany(targetEntity="Product", inversedBy="shopbylooks")
     * @ORM\JoinTable(name="shop_shop_by_look_product",
     *      joinColumns={@ORM\JoinColumn(name="shop_by_look_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="product_id",
     * referencedColumnName="id")}
     *      )
     **/
    protected $products;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=255, nullable=true)
     */
    private $logo;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="shopbylook")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=false)
     */
    private $category;


    /**
     * @Assert\Image(maxSize="10M")
     */
    private $image;
    private $image_temp;

    /**
     * Sets image
     *
     * @param UploadedFile $image
     */
    public function setImage(UploadedFile $image = null)
    {
        $this->image = $image;
        // check if we have an old image path
        if (isset($this->logo)) {
            // store the old name to delete after the update
            $this->image_temp = $this->logo;
            $this->logo = null;
        } else {
            $this->logo = 'initial';
        }
    }

    /**
     * Get image.
     *
     * @return UploadedFile
     */
    public function getImage()
    {
        return $this->image;
    }

    public function getAbsolutePath()
    {
        return null === $this->logo
            ? null
            : $this->getUploadRootDir() . '/' . $this->logo;
    }

    public function getWebPath()
    {
        return null === $this->logo
            ? null
            : $this->getUploadDir() . '/' . $this->logo;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return  $this->getUploadDir();
    }

    protected function getUploadDir()
    {
        return 'images/shop';
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->getImage()) {
            $imagename = sha1(uniqid(mt_rand(), true));
            $this->logo = $imagename . '.' . $this->getImage()->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null != $this->getImage()) {
            $this->getImage()->move($this->getUploadRootDir(), $this->logo);
            if (isset($this->image_temp)) {
                unlink($this->getUploadRootDir() . '/' . $this->image_temp);
                // clear the temp image path
                $this->image_temp = null;
            }
            $this->image = null;
        }
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($image = $this->getAbsolutePath()) {
            unlink($image);
        }
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
     * Set status
     *
     * @param integer $status
     *
     * @return ShopByLook
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set orderning
     *
     * @param integer $orderning
     *
     * @return ShopByLook
     */
    public function setOrderning($orderning)
    {
        $this->orderning = $orderning;

        return $this;
    }

    /**
     * Get orderning
     *
     * @return integer
     */
    public function getOrderning()
    {
        return $this->orderning;
    }

    /**
     * Set logo
     *
     * @param string $logo
     *
     * @return ShopByLook
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Add product
     *
     * @param \RleeCMS\ShopBundle\Entity\Product $product
     *
     * @return ShopByLook
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
     * Set name
     *
     * @param string $name
     *
     * @return ShopByLook
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

    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Set category
     *
     * @param \RleeCMS\ShopBundle\Entity\Category $category
     *
     * @return ShopByLook
     */
    public function setCategory(\RleeCMS\ShopBundle\Entity\Category $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \RleeCMS\ShopBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
}
