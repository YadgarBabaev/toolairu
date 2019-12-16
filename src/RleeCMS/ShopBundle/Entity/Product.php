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
 * @ORM\Table(name="shop_product")
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 */
class Product
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
     * Алиас страницы
     * @var string
     *
     * @ORM\Column(name="alias", type="string", length=255, unique=true)
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
     * @var string
     *
     * @ORM\Column(name="tags", type="string", length=255, nullable=true)
     */
    private $tags;

    /**
     * @var string
     *
     * @ORM\Column(name="composition", type="string", length=255, nullable=true)
     */
    private $composition;

    /**
     * @var string
     *
     * @ORM\Column(name="style", type="string", length=255, nullable=true)
     */
    private $style;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=true)
     */
    private $type;

    /**
     *
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    protected $price;

    /**
     *
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    protected $priceDiscount;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    protected $priceB2B;

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
     * @var array
     * @ORM\Column(name="images", type="array", nullable=true)
     */
    private $images;

    /**
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="products")
     * @ORM\JoinTable(name="shop_product_category",
     *      joinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="category_id",
     * referencedColumnName="id")}
     *      )
     **/
    protected $categories;

    /**
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="categoryB2B_id", referencedColumnName="id")
     */
    private $categoryB2B;

    /**
     * @ORM\ManyToMany(targetEntity="Size", inversedBy="products")
     * @ORM\JoinTable(name="shop_product_size",
     *      joinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="size_id",
     * referencedColumnName="id")}
     *      )
     **/
    private $sizes;

    /**
     * @ORM\ManyToMany(targetEntity="Filters")
     * @ORM\JoinTable(name="shop_product_filter",
     *      joinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="filter_id",
     * referencedColumnName="id")}
     *      )
     **/
    private $filters;


    /**
     * @ORM\ManyToMany(targetEntity="Color", inversedBy="products", cascade={"persist"})
     * @ORM\JoinTable(name="shop_product_color",
     *      joinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="color_id",
     * referencedColumnName="id")}
     *      )
     **/
    private $colors;

    /**
     * @ORM\OneToMany(targetEntity="SliderImage", mappedBy="product")
     */
    private $sliderimages;

    /**
     * @ORM\ManyToMany(targetEntity="ShopByLook", mappedBy="products")
     **/
    private $shopbylooks;

    /**
     * @ORM\OneToMany(targetEntity="ProductStore", mappedBy="product")
     */
    private $stores;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=255, nullable=true)
     */
    private $logo;

    /**
     * @ORM\ManyToMany(targetEntity="RleeCMS\UserBundle\Entity\User")
     * @ORM\JoinTable(name="shop_product_user",
     *      joinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="user_id",
     * referencedColumnName="id")}
     *      )
     **/
    private $users;

    /**
     * @ORM\Column(name="note", type="string", nullable=true)
     */
    private $note;

    /**
     * @Assert\Image(maxSize="10M")
     */
    private $image;
    private $image_temp;

    /**
     * @return mixed
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param mixed $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }



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
     * @return Product
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
     * Set description
     *
     * @param string $description
     *
     * @return Product
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
     * @return Product
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
     * @return Product
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
     * @return Product
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
     * Set tags
     *
     * @param string $tags
     *
     * @return Product
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get tags
     *
     * @return string
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set style
     *
     * @param string $style
     *
     * @return Product
     */
    public function setStyle($style)
    {
        $this->style = $style;

        return $this;
    }

    /**
     * Get style
     *
     * @return string
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Product
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

    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Set alias
     *
     * @param string $alias
     *
     * @return Product
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
     * Set composition
     *
     * @param string $composition
     *
     * @return Product
     */
    public function setComposition($composition)
    {
        $this->composition = $composition;

        return $this;
    }

    /**
     * Get composition
     *
     * @return string
     */
    public function getComposition()
    {
        return $this->composition;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set orderning
     *
     * @param integer $orderning
     *
     * @return Product
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
     * Constructor
     */
    public function __construct()
    {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sizes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->colors = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add category
     *
     * @param \RleeCMS\ShopBundle\Entity\Category $category
     *
     * @return Product
     */
    public function addCategory(\RleeCMS\ShopBundle\Entity\Category $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \RleeCMS\ShopBundle\Entity\Category $category
     */
    public function removeCategory(\RleeCMS\ShopBundle\Entity\Category $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Add size
     *
     * @param \RleeCMS\ShopBundle\Entity\Size $size
     *
     * @return Product
     */
    public function addSize(\RleeCMS\ShopBundle\Entity\Size $size)
    {
        $this->sizes[] = $size;

        return $this;
    }

    /**
     * Remove size
     *
     * @param \RleeCMS\ShopBundle\Entity\Size $size
     */
    public function removeSize(\RleeCMS\ShopBundle\Entity\Size $size)
    {
        $this->sizes->removeElement($size);
    }

    /**
     * Get sizes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSizes()
    {
        return $this->sizes;
    }

    /**
     * Add color
     *
     * @param \RleeCMS\ShopBundle\Entity\Color $color
     *
     * @return Product
     */
    public function addColor(\RleeCMS\ShopBundle\Entity\Color $color)
    {
        $this->colors[] = $color;

        return $this;
    }

    /**
     * Remove color
     *
     * @param \RleeCMS\ShopBundle\Entity\Color $color
     */
    public function removeColor(\RleeCMS\ShopBundle\Entity\Color $color)
    {
        $this->colors->removeElement($color);
    }

    /**
     * Get colors
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getColors()
    {
        return $this->colors;
    }

    /**
     * Set images
     *
     * @param array $images
     *
     * @return Product
     */
    public function setImages($images)
    {
        $this->images = $images;

        return $this;
    }

    /**
     * Get images
     *
     * @return array
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Add sliderimage
     *
     * @param \RleeCMS\ShopBundle\Entity\SliderImage $sliderimage
     *
     * @return Product
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
     * Set category
     *
     * @param \RleeCMS\ShopBundle\Entity\Category $category
     *
     * @return Product
     */
    public function setCategory(\RleeCMS\ShopBundle\Entity\Category $category = null)
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

    /**
     * Add filter
     *
     * @param \RleeCMS\ShopBundle\Entity\Filters $filter
     *
     * @return Product
     */
    public function addFilter(\RleeCMS\ShopBundle\Entity\Filters $filter)
    {
        $this->filters[] = $filter;

        return $this;
    }

    /**
     * Remove filter
     *
     * @param \RleeCMS\ShopBundle\Entity\Filters $filter
     */
    public function removeFilter(\RleeCMS\ShopBundle\Entity\Filters $filter)
    {
        $this->filters->removeElement($filter);
    }

    /**
     * Get filters
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * Add shopbylook
     *
     * @param \RleeCMS\ShopBundle\Entity\ShopByLook $shopbylook
     *
     * @return Product
     */
    public function addShopbylook(\RleeCMS\ShopBundle\Entity\ShopByLook $shopbylook)
    {
        $this->shopbylooks[] = $shopbylook;

        return $this;
    }

    /**
     * Remove shopbylook
     *
     * @param \RleeCMS\ShopBundle\Entity\ShopByLook $shopbylook
     */
    public function removeShopbylook(\RleeCMS\ShopBundle\Entity\ShopByLook $shopbylook)
    {
        $this->shopbylooks->removeElement($shopbylook);
    }

    /**
     * Get shopbylooks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getShopbylooks()
    {
        return $this->shopbylooks;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Product
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set priceDiscount
     *
     * @param string $priceDiscount
     *
     * @return Product
     */
    public function setPriceDiscount($priceDiscount)
    {
        $this->priceDiscount = $priceDiscount;

        return $this;
    }

    /**
     * Get priceDiscount
     *
     * @return string
     */
    public function getPriceDiscount()
    {
        return $this->priceDiscount;
    }

    /**
     * Set priceB2B
     *
     * @param string $priceB2B
     *
     * @return Product
     */
    public function setPriceB2B($priceB2B)
    {
        $this->priceB2B = $priceB2B;

        return $this;
    }

    /**
     * Get priceB2B
     *
     * @return string
     */
    public function getPriceB2B()
    {
        return $this->priceB2B;
    }

    /**
     * Set categoryB2B
     *
     * @param \RleeCMS\ShopBundle\Entity\Category $categoryB2B
     *
     * @return Product
     */
    public function setCategoryB2B(\RleeCMS\ShopBundle\Entity\Category $categoryB2B = null)
    {
        $this->categoryB2B = $categoryB2B;

        return $this;
    }

    /**
     * Get categoryB2B
     *
     * @return \RleeCMS\ShopBundle\Entity\Category
     */
    public function getCategoryB2B()
    {
        return $this->categoryB2B;
    }

    /**
     * Add user
     *
     * @param \RleeCMS\UserBundle\Entity\User $user
     *
     * @return Product
     */
    public function addUser(\RleeCMS\UserBundle\Entity\User $user)
    {
        $this->users[] = $user;
    
        return $this;
    }

    /**
     * Remove user
     *
     * @param \RleeCMS\UserBundle\Entity\User $user
     */
    public function removeUser(\RleeCMS\UserBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Add store
     *
     * @param \RleeCMS\ShopBundle\Entity\ProductStore $store
     *
     * @return Product
     */
    public function addStore(\RleeCMS\ShopBundle\Entity\ProductStore $store)
    {
        $this->stores[] = $store;
    
        return $this;
    }

    /**
     * Remove store
     *
     * @param \RleeCMS\ShopBundle\Entity\ProductStore $store
     */
    public function removeStore(\RleeCMS\ShopBundle\Entity\ProductStore $store)
    {
        $this->stores->removeElement($store);
    }

    /**
     * Get stores
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStores()
    {
        return $this->stores;
    }
}
