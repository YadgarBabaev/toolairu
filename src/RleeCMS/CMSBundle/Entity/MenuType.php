<?php

namespace RleeCMS\CMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MenuType
 *
 * @ORM\Table(name="CMS_Menu_Type")
 * @ORM\Entity
 */
class MenuType
{
    /**
     * @var integer
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
     * @ORM\OneToMany(targetEntity="Menu", mappedBy="menuType")
     */
    private $menu;

    /**
     * @ORM\ManyToOne(targetEntity="RleeCMS\ReferenceBundle\Entity\Status", inversedBy="id")
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id", onDelete="CASCADE", nullable=true)
     */
    private $status;

    public function __toString()
    {
        return $this->getName();
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->menu = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return MenuType
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
     * Add menu
     *
     * @param \RleeCMS\CMSBundle\Entity\Menu $menu
     *
     * @return MenuType
     */
    public function addMenu(\RleeCMS\CMSBundle\Entity\Menu $menu)
    {
        $this->menu[] = $menu;

        return $this;
    }

    /**
     * Remove menu
     *
     * @param \RleeCMS\CMSBundle\Entity\Menu $menu
     */
    public function removeMenu(\RleeCMS\CMSBundle\Entity\Menu $menu)
    {
        $this->menu->removeElement($menu);
    }

    /**
     * Get menu
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * Set status
     *
     * @param \RleeCMS\ReferenceBundle\Entity\Status $status
     *
     * @return MenuType
     */
    public function setStatus(\RleeCMS\ReferenceBundle\Entity\Status $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \RleeCMS\ReferenceBundle\Entity\Status
     */
    public function getStatus()
    {
        return $this->status;
    }
}
