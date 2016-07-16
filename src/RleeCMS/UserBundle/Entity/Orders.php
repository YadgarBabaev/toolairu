<?php

namespace RleeCMS\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    Symfony\Component\Validator\Constraints as Assert;

/**
 * Orders
 *
 * @ORM\Table(name="orders")
 * @ORM\Entity()
 */
class Orders
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
     * @Assert\NotBlank()
     * @Assert\Email()
     * @ORM\Column(type="string", length=255, name="email", nullable=false)
     */
    private $email;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255, name="f_name", nullable=false)
     */
    private $fName;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, name="l_name", nullable=true)
     */
    private $lName;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, name="address", nullable=true)
     */
    private $address;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, name="house_number", nullable=true)
     */
    private $houseNumber;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, name="city", nullable=true)
     */
    private $city;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, name="country", nullable=true)
     */
    private $country;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, name="state", nullable=true)
     */
    private $state;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, name="p_index", nullable=true)
     */
    private $pIndex;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, name="phone", nullable=true)
     */
    private $phone;

    /**
     * @ORM\ManyToOne(targetEntity="RleeCMS\ReferenceBundle\Entity\ShippingMethods")
     * @ORM\JoinColumn(referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $shippingMethod;

    /**
     * @ORM\ManyToOne(targetEntity="RleeCMS\UserBundle\Entity\User")
     * @ORM\JoinColumn(referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $user;


    /**
     * @ORM\ManyToMany(targetEntity="RleeCMS\UserBundle\Entity\OrderingProducts")
     * @ORM\JoinTable(name="orders_products",
     *      joinColumns={@ORM\JoinColumn(name="order_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id", unique=false)}
     *      )
     */
    private $products;

    /**
     * @ORM\ManyToOne(targetEntity="RleeCMS\ReferenceBundle\Entity\OrderStatus")
     * @ORM\JoinColumn(referencedColumnName="id", onDelete="SET NULL", nullable=true)
     */
    private $status;


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
     * Set email
     *
     * @param string $email
     *
     * @return Orders
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set fName
     *
     * @param string $fName
     *
     * @return Orders
     */
    public function setFName($fName)
    {
        $this->fName = $fName;

        return $this;
    }

    /**
     * Get fName
     *
     * @return string
     */
    public function getFName()
    {
        return $this->fName;
    }

    /**
     * Set lName
     *
     * @param string $lName
     *
     * @return Orders
     */
    public function setLName($lName)
    {
        $this->lName = $lName;

        return $this;
    }

    /**
     * Get lName
     *
     * @return string
     */
    public function getLName()
    {
        return $this->lName;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Orders
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set houseNumber
     *
     * @param string $houseNumber
     *
     * @return Orders
     */
    public function setHouseNumber($houseNumber)
    {
        $this->houseNumber = $houseNumber;

        return $this;
    }

    /**
     * Get houseNumber
     *
     * @return string
     */
    public function getHouseNumber()
    {
        return $this->houseNumber;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Orders
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Orders
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return Orders
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set pIndex
     *
     * @param string $pIndex
     *
     * @return Orders
     */
    public function setPIndex($pIndex)
    {
        $this->pIndex = $pIndex;

        return $this;
    }

    /**
     * Get pIndex
     *
     * @return string
     */
    public function getPIndex()
    {
        return $this->pIndex;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Orders
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set shippingMethod
     *
     * @param \RleeCMS\ReferenceBundle\Entity\ShippingMethods $shippingMethod
     *
     * @return Orders
     */
    public function setShippingMethod(\RleeCMS\ReferenceBundle\Entity\ShippingMethods $shippingMethod = null)
    {
        $this->shippingMethod = $shippingMethod;

        return $this;
    }

    /**
     * Get shippingMethod
     *
     * @return \RleeCMS\ReferenceBundle\Entity\ShippingMethods
     */
    public function getShippingMethod()
    {
        return $this->shippingMethod;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add product
     *
     * @param \RleeCMS\UserBundle\Entity\OrderingProducts $product
     *
     * @return Orders
     */
    public function addProduct(\RleeCMS\UserBundle\Entity\OrderingProducts $product)
    {
        $this->products[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \RleeCMS\UserBundle\Entity\OrderingProducts $product
     */
    public function removeProduct(\RleeCMS\UserBundle\Entity\OrderingProducts $product)
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
     * Set status
     *
     * @param \RleeCMS\ReferenceBundle\Entity\OrderStatus $status
     *
     * @return Orders
     */
    public function setStatus(\RleeCMS\ReferenceBundle\Entity\OrderStatus $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \RleeCMS\ReferenceBundle\Entity\OrderStatus
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set user
     *
     * @param \RleeCMS\UserBundle\Entity\User $user
     *
     * @return Orders
     */
    public function setUser(\RleeCMS\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \RleeCMS\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
