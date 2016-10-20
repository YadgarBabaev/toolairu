<?php

namespace RleeCMS\ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Refund
 *
 * @ORM\Table(name="refund")
 * @ORM\Entity(repositoryClass="RleeCMS\ShopBundle\Repository\RefundRepository")
 */
class Refund
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
     * @NotBlank()
     * @ORM\Column(name="userName", type="string", length=255)
     */
    private $userName;

    /**
     * @ORM\ManyToOne(targetEntity="RleeCMS\UserBundle\Entity\User")
     * @ORM\JoinColumn(referencedColumnName="id", nullable=true)
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="clientNumber", type="string", length=255, nullable=true)
     */
    private $clientNumber;

    /**
     * @var string
     * @NotBlank()
     * @ORM\Column(name="orderNumber", type="string", length=255, nullable=true)
     */
    private $orderNumber;

    /**
     * @var \DateTime
     * @NotBlank()
     * @ORM\Column(name="orderDate", type="datetime", nullable=true)
     */
    private $orderDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="shippingDate", type="datetime")
     */
    private $shippingDate;

    /**
     * @var string
     * @NotBlank()
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="reqvisit", type="string", length=255, nullable=true)
     */
    private $reqvisit;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="postAdress", type="string", length=255, nullable=true)
     */
    private $postAdress;

    /**
     * @var string
     * @NotBlank()
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set userName
     *
     * @param string $userName
     *
     * @return Refund
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * Get userName
     *
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Set clientNumber
     *
     * @param string $clientNumber
     *
     * @return Refund
     */
    public function setClientNumber($clientNumber)
    {
        $this->clientNumber = $clientNumber;

        return $this;
    }

    /**
     * Get clientNumber
     *
     * @return string
     */
    public function getClientNumber()
    {
        return $this->clientNumber;
    }

    /**
     * Set orderNumber
     *
     * @param string $orderNumber
     *
     * @return Refund
     */
    public function setOrderNumber($orderNumber)
    {
        $this->orderNumber = $orderNumber;

        return $this;
    }

    /**
     * Get orderNumber
     *
     * @return string
     */
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }

    /**
     * Set orderDate
     *
     * @param \DateTime $orderDate
     *
     * @return Refund
     */
    public function setOrderDate($orderDate)
    {
        $this->orderDate = $orderDate;

        return $this;
    }

    /**
     * Get orderDate
     *
     * @return \DateTime
     */
    public function getOrderDate()
    {
        return $this->orderDate;
    }

    /**
     * Set shippingDate
     *
     * @param \DateTime $shippingDate
     *
     * @return Refund
     */
    public function setShippingDate($shippingDate)
    {
        $this->shippingDate = $shippingDate;

        return $this;
    }

    /**
     * Get shippingDate
     *
     * @return \DateTime
     */
    public function getShippingDate()
    {
        return $this->shippingDate;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Refund
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
     * Set reqvisit
     *
     * @param string $reqvisit
     *
     * @return Refund
     */
    public function setReqvisit($reqvisit)
    {
        $this->reqvisit = $reqvisit;

        return $this;
    }

    /**
     * Get reqvisit
     *
     * @return string
     */
    public function getReqvisit()
    {
        return $this->reqvisit;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Refund
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
     * Set postAdress
     *
     * @param string $postAdress
     *
     * @return Refund
     */
    public function setPostAdress($postAdress)
    {
        $this->postAdress = $postAdress;

        return $this;
    }

    /**
     * Get postAdress
     *
     * @return string
     */
    public function getPostAdress()
    {
        return $this->postAdress;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Refund
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
     * Set user
     *
     * @param \RleeCMS\UserBundle\Entity\User $user
     *
     * @return Refund
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
