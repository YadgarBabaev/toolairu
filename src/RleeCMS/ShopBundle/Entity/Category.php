<?php

namespace RleeCMS\ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Category
 *
 * @Gedmo\Tree(type="nested")
 * @ORM\Table(name="shop_category")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity()
 */
class Category
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
     * Алиас каталога
     * @var string
     *
     * @ORM\Column(name="alias", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $alias;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_tag_title", type="string", length=255)
     */
    private $metaTagTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_tag_description", type="text", nullable=true)
     */
    private $metaTagDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_tag_keywords", type="text", nullable=true)
     */
    private $metaTagKeywords;

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
     * @Gedmo\TreeLeft
     * @ORM\Column(name="lft", type="integer")
     */
    private $lft;

    /**
     * @Gedmo\TreeRight
     * @ORM\Column(name="rgt", type="integer")
     */
    private $rgt;

    /**
     * @Gedmo\TreeLevel
     * @ORM\Column(name="lvl", type="integer")
     */
    private $lvl;

    /**
     * @Gedmo\TreeRoot
     * @ORM\Column(name="root", type="integer", nullable=true)
     */
    private $root;

    /**
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="CASCADE", nullable=true)
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="Category", mappedBy="parent")
     * @ORM\OrderBy({"orderning" = "ASC"})
     */
    private $children;

    /**
     * @ORM\ManyToMany(targetEntity="Product", mappedBy="categories")
     **/
    private $products;

    /**
     * @ORM\OneToMany(targetEntity="Product", mappedBy="category")
     */
    private $productsOnly;

    /**
     * @ORM\OneToMany(targetEntity="SliderImage", mappedBy="category")
     */
    private $sliderimages;

    /**
     * @ORM\OneToMany(targetEntity="ShopByLook", mappedBy="category")
     */
    private $shopbylook;

    /**
     * @var boolean
     * @ORM\Column(name="sale", type="boolean", options={"default"=false})
     */
    private $sale;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=255, nullable=true)
     */
    private $logo;

    /**
     * @var string
     *
     * @ORM\Column(name="b2b", type="string", length=255, nullable=true)
     */
    private $b2b;
    
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
     * Set logo
     *
     * @param string $logo
     *
     * @return Category
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

    public function __toString()
    {
        return $this->getName();
    }

    public function getLavelName()
    {
        $lvl = '';
        for ($i = 0; $i < $this->getLvl(); $i++) {
            $lvl .= ' -';
        }
        return $lvl . $this->getName();
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return Category
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
     * Set alias
     *
     * @param string $alias
     *
     * @return Category
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get alias
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Category
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set metaTagTitle
     *
     * @param string $metaTagTitle
     *
     * @return Category
     */
    public function setMetaTagTitle($metaTagTitle)
    {
        $this->metaTagTitle = $metaTagTitle;

        return $this;
    }

    /**
     * Get metaTagTitle
     *
     * @return string
     */
    public function getMetaTagTitle()
    {
        return $this->metaTagTitle;
    }

    /**
     * Set metaTagDescription
     *
     * @param string $metaTagDescription
     *
     * @return Category
     */
    public function setMetaTagDescription($metaTagDescription)
    {
        $this->metaTagDescription = $metaTagDescription;

        return $this;
    }

    /**
     * Get metaTagDescription
     *
     * @return string
     */
    public function getMetaTagDescription()
    {
        return $this->metaTagDescription;
    }

    /**
     * Set metaTagKeywords
     *
     * @param string $metaTagKeywords
     *
     * @return Category
     */
    public function setMetaTagKeywords($metaTagKeywords)
    {
        $this->metaTagKeywords = $metaTagKeywords;

        return $this;
    }

    /**
     * Get metaTagKeywords
     *
     * @return string
     */
    public function getMetaTagKeywords()
    {
        return $this->metaTagKeywords;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Category
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
     * @return Category
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
     * Set lft
     *
     * @param integer $lft
     *
     * @return Category
     */
    public function setLft($lft)
    {
        $this->lft = $lft;

        return $this;
    }

    /**
     * Get lft
     *
     * @return integer
     */
    public function getLft()
    {
        return $this->lft;
    }

    /**
     * Set rgt
     *
     * @param integer $rgt
     *
     * @return Category
     */
    public function setRgt($rgt)
    {
        $this->rgt = $rgt;

        return $this;
    }

    /**
     * Get rgt
     *
     * @return integer
     */
    public function getRgt()
    {
        return $this->rgt;
    }

    /**
     * Set lvl
     *
     * @param integer $lvl
     *
     * @return Category
     */
    public function setLvl($lvl)
    {
        $this->lvl = $lvl;

        return $this;
    }

    /**
     * Get lvl
     *
     * @return integer
     */
    public function getLvl()
    {
        return $this->lvl;
    }

    /**
     * Set root
     *
     * @param integer $root
     *
     * @return Category
     */
    public function setRoot($root)
    {
        $this->root = $root;

        return $this;
    }

    /**
     * Get root
     *
     * @return integer
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * Set parent
     *
     * @param \RleeCMS\ShopBundle\Entity\Category $parent
     *
     * @return Category
     */
    public function setParent(\RleeCMS\ShopBundle\Entity\Category $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \RleeCMS\ShopBundle\Entity\Category
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add child
     *
     * @param \RleeCMS\ShopBundle\Entity\Category $child
     *
     * @return Category
     */
    public function addChild(\RleeCMS\ShopBundle\Entity\Category $child)
    {
        $this->children[] = $child;

        return $this;
    }

    /**
     * Remove child
     *
     * @param \RleeCMS\ShopBundle\Entity\Category $child
     */
    public function removeChild(\RleeCMS\ShopBundle\Entity\Category $child)
    {
        $this->children->removeElement($child);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Add product
     *
     * @param \RleeCMS\ShopBundle\Entity\Product $product
     *
     * @return Category
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
     * Add sliderimage
     *
     * @param \RleeCMS\ShopBundle\Entity\SliderImage $sliderimage
     *
     * @return Category
     */
    public function addSliderimage(\RleeCMS\ShopBundle\Entity\SliderImage $sliderimage)
    {
        $this->sliderimages[] = $sliderimage;

        return $this;
    }

    /**
     * Remove sliderimage
     *
     * @param \RleeCMS\ShopBundle\Entity\SliderImage $sliderimage
     */
    public function removeSliderimage(\RleeCMS\ShopBundle\Entity\SliderImage $sliderimage)
    {
        $this->sliderimages->removeElement($sliderimage);
    }

    /**
     * Get sliderimages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSliderimages()
    {
        return $this->sliderimages;
    }

    /**
     * Add productsOnly
     *
     * @param \RleeCMS\ShopBundle\Entity\Product $productsOnly
     *
     * @return Category
     */
    public function addProductsOnly(\RleeCMS\ShopBundle\Entity\Product $productsOnly)
    {
        $this->productsOnly[] = $productsOnly;

        return $this;
    }

    /**
     * Remove productsOnly
     *
     * @param \RleeCMS\ShopBundle\Entity\Product $productsOnly
     */
    public function removeProductsOnly(\RleeCMS\ShopBundle\Entity\Product $productsOnly)
    {
        $this->productsOnly->removeElement($productsOnly);
    }

    /**
     * Get productsOnly
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProductsOnly()
    {
        return $this->productsOnly;
    }

    /**
     * Add shopbylook
     *
     * @param \RleeCMS\ShopBundle\Entity\ShopByLook $shopbylook
     *
     * @return Category
     */
    public function addShopbylook(\RleeCMS\ShopBundle\Entity\ShopByLook $shopbylook)
    {
        $this->shopbylook[] = $shopbylook;

        return $this;
    }

    /**
     * Remove shopbylook
     *
     * @param \RleeCMS\ShopBundle\Entity\ShopByLook $shopbylook
     */
    public function removeShopbylook(\RleeCMS\ShopBundle\Entity\ShopByLook $shopbylook)
    {
        $this->shopbylook->removeElement($shopbylook);
    }

    /**
     * Get shopbylook
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getShopbylook()
    {
        return $this->shopbylook;
    }

    /**
     * Set sale
     *
     * @param boolean $sale
     *
     * @return Category
     */
    public function setSale($sale)
    {
        $this->sale = $sale;

        return $this;
    }

    /**
     * Get sale
     *
     * @return boolean
     */
    public function getSale()
    {
        return $this->sale;
    }

    /**
     * Set b2b
     *
     * @param string $b2b
     *
     * @return Category
     */
    public function setB2b($b2b)
    {
        $this->b2b = $b2b;

        return $this;
    }

    /**
     * Get b2b
     *
     * @return string
     */
    public function getB2b()
    {
        return $this->b2b;
    }
}
