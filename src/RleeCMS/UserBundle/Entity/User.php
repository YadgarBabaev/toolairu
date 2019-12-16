<?php

namespace RleeCMS\UserBundle\Entity;


use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM,
   Symfony\Component\Validator\Constraints as Assert,
   Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 * @UniqueEntity("email")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="f_name", type="string", length=255)
     */
    protected $fName;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=2, nullable=true)
     */
    protected $gender;

    /**
     * @var boolean
     *
     * @ORM\Column(name="news", type="boolean")
     */
    protected $news;

    /**
     * @ORM\ManyToMany(targetEntity="RleeCMS\ShopBundle\Entity\Product", mappedBy="users")
     **/
    private $products;

    /**
     * @ORM\OneToOne(targetEntity="RleeCMS\UserBundle\Entity\LegalPerson", mappedBy="user")
     */
    private $legal_person;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return User
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
     * Set fName
     *
     * @param string $fName
     *
     * @return User
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
     * Set gender
     *
     * @param string $gender
     *
     * @return User
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    public function setEmail($email)
    {
        parent::setEmail($email);
        $this->setUsername($email);
        return $this;
    }



    /**
     * Set news
     *
     * @param boolean $news
     *
     * @return User
     */
    public function setNews($news)
    {
        $this->news = $news;

        return $this;
    }

    /**
     * Get news
     *
     * @return boolean
     */
    public function getNews()
    {
        return $this->news;
    }

    /**
     * Add product
     *
     * @param \RleeCMS\ShopBundle\Entity\Product $product
     *
     * @return User
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
     * Set legalPerson
     *
     * @param \RleeCMS\UserBundle\Entity\LegalPerson $legalPerson
     *
     * @return User
     */
    public function setLegalPerson(\RleeCMS\UserBundle\Entity\LegalPerson $legalPerson = null)
    {
        $this->legal_person = $legalPerson;
    
        return $this;
    }

    /**
     * Get legalPerson
     *
     * @return \RleeCMS\UserBundle\Entity\LegalPerson
     */
    public function getLegalPerson()
    {
        return $this->legal_person;
    }
}
