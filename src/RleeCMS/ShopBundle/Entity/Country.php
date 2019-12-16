<?php

namespace RleeCMS\ShopBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;

use Doctrine\ORM\Mapping as ORM;

/**
 * Country
 *
 * @Gedmo\Tree(type="nested")
 * @ORM\Table(name="shop_setting_country")
 * @ORM\Entity()
 */
class Country
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
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="CASCADE", nullable=true)
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="Country", mappedBy="parent")
     * @ORM\OrderBy({"orderning" = "ASC"})
     */
    private $children;

    /**
     * @ORM\OneToMany(targetEntity="Store", mappedBy="country")
     */
    private $stores;

    /**
     *
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    protected $procent;

    public function __toString()
    {
        $prefix = "";
        for ($i=1; $i<= $this->lvl; $i++){
            $prefix .= "-- ";
        }
        return $prefix . $this->name;
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
     * @return Country
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
     * Set status
     *
     * @param integer $status
     *
     * @return Country
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
     * @return Country
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
     * @return Country
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
     * @return Country
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
     * @return Country
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
     * @return Country
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
     * @param \RleeCMS\ShopBundle\Entity\Country $parent
     *
     * @return Country
     */
    public function setParent(\RleeCMS\ShopBundle\Entity\Country $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \RleeCMS\ShopBundle\Entity\Country
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add child
     *
     * @param \RleeCMS\ShopBundle\Entity\Country $child
     *
     * @return Country
     */
    public function addChild(\RleeCMS\ShopBundle\Entity\Country $child)
    {
        $this->children[] = $child;

        return $this;
    }

    /**
     * Remove child
     *
     * @param \RleeCMS\ShopBundle\Entity\Country $child
     */
    public function removeChild(\RleeCMS\ShopBundle\Entity\Country $child)
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
     * Set procent
     *
     * @param string $procent
     *
     * @return Country
     */
    public function setProcent($procent)
    {
        $this->procent = $procent;

        return $this;
    }

    /**
     * Get procent
     *
     * @return string
     */
    public function getProcent()
    {
        return $this->procent;
    }

    /**
     * Add store
     *
     * @param \RleeCMS\ShopBundle\Entity\Store $store
     *
     * @return Country
     */
    public function addStore(\RleeCMS\ShopBundle\Entity\Store $store)
    {
        $this->stores[] = $store;

        return $this;
    }

    /**
     * Remove store
     *
     * @param \RleeCMS\ShopBundle\Entity\Store $store
     */
    public function removeStore(\RleeCMS\ShopBundle\Entity\Store $store)
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
