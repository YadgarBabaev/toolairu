<?php

namespace RleeCMS\CMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Translatable\Translatable;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Menu
 *
 * @Gedmo\Tree(type="nested")
 * @ORM\Table(name="CMS_Menu")
 * @UniqueEntity("home")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Gedmo\Tree\Entity\Repository\NestedTreeRepository")
 *
 */
class Menu
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
     * ID страницы
     * @ORM\ManyToOne(targetEntity="RleeCMS\CMSBundle\Entity\Pages")
     * @ORM\JoinColumn(name="page_id", referencedColumnName="id", nullable=true)
     */
    private $page;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100)
     */
    private $title;

    /**
     * @Gedmo\Slug(handlers={
     *      @Gedmo\SlugHandler(class="Gedmo\Sluggable\Handler\TreeSlugHandler", options={
     *          @Gedmo\SlugHandlerOption(name="parentRelationField", value="parent"),
     *          @Gedmo\SlugHandlerOption(name="separator", value="/")
     *      })
     * }, fields={"title"})
     * @ORM\Column(length=128, unique=true)
     */
    protected $alias;

    /**
     * Тип  меню
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * Порядковый номер
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
     * @ORM\ManyToOne(targetEntity="Menu", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="CASCADE", nullable=true)
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="Menu", mappedBy="parent")
     * @ORM\OrderBy({"orderning" = "ASC"})
     */
    private $children;

    /**
     * @ORM\ManyToOne(targetEntity="MenuType", inversedBy="menu")
     * @ORM\JoinColumn(name="menuType", referencedColumnName="id")
     */
    protected $menuType;

    /**
     * Статус страницы
     * @var integer
     * @ORM\Column(name="status", type="integer")
     * @Assert\NotBlank()
     */
    private $status;

    /**
     * @var string
     * @ORM\Column(name="params", type="array", nullable=true)
     */
    private $params;

    /**
     * @var string
     * @ORM\Column(name="home", type="boolean", nullable=true)
     */
    private $home;

    /**
     * @ORM\ManyToMany(targetEntity="RleeCMS\CMSBundle\Entity\Widget", mappedBy="menus")
     */
    protected $widgets;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", nullable=true)
     */
    private $url;



    public function __toString()
    {
        $prefix = "";
        for ($i=1; $i<= $this->lvl; $i++){
            $prefix .= "---- ";
        }
        return $prefix . $this->title;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
        $this->widgets = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     *
     * @return Menu
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set alias
     *
     * @param string $alias
     *
     * @return Menu
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
     * Set type
     *
     * @param string $type
     *
     * @return Menu
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
     * Set orderning
     *
     * @param integer $orderning
     *
     * @return Menu
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
     * @return Menu
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
     * @return Menu
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
     * @return Menu
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
     * @return Menu
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
     * Set status
     *
     * @param integer $status
     *
     * @return Menu
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
     * Set params
     *
     * @param array $params
     *
     * @return Menu
     */
    public function setParams($params)
    {
        $this->params = $params;

        return $this;
    }

    /**
     * Get params
     *
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Set home
     *
     * @param boolean $home
     *
     * @return Menu
     */
    public function setHome($home)
    {
        $this->home = $home;

        return $this;
    }

    /**
     * Get home
     *
     * @return boolean
     */
    public function getHome()
    {
        return $this->home;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Menu
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set page
     *
     * @param \RleeCMS\CMSBundle\Entity\Pages $page
     *
     * @return Menu
     */
    public function setPage(\RleeCMS\CMSBundle\Entity\Pages $page = null)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return \RleeCMS\CMSBundle\Entity\Pages
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set parent
     *
     * @param \RleeCMS\CMSBundle\Entity\Menu $parent
     *
     * @return Menu
     */
    public function setParent(\RleeCMS\CMSBundle\Entity\Menu $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \RleeCMS\CMSBundle\Entity\Menu
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add child
     *
     * @param \RleeCMS\CMSBundle\Entity\Menu $child
     *
     * @return Menu
     */
    public function addChild(\RleeCMS\CMSBundle\Entity\Menu $child)
    {
        $this->children[] = $child;

        return $this;
    }

    /**
     * Remove child
     *
     * @param \RleeCMS\CMSBundle\Entity\Menu $child
     */
    public function removeChild(\RleeCMS\CMSBundle\Entity\Menu $child)
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
     * Set menuType
     *
     * @param \RleeCMS\CMSBundle\Entity\MenuType $menuType
     *
     * @return Menu
     */
    public function setMenuType(\RleeCMS\CMSBundle\Entity\MenuType $menuType = null)
    {
        $this->menuType = $menuType;

        return $this;
    }

    /**
     * Get menuType
     *
     * @return \RleeCMS\CMSBundle\Entity\MenuType
     */
    public function getMenuType()
    {
        return $this->menuType;
    }

    /**
     * Add widget
     *
     * @param \RleeCMS\CMSBundle\Entity\Widget $widget
     *
     * @return Menu
     */
    public function addWidget(\RleeCMS\CMSBundle\Entity\Widget $widget)
    {
        $this->widgets[] = $widget;

        return $this;
    }

    /**
     * Remove widget
     *
     * @param \RleeCMS\CMSBundle\Entity\Widget $widget
     */
    public function removeWidget(\RleeCMS\CMSBundle\Entity\Widget $widget)
    {
        $this->widgets->removeElement($widget);
    }

    /**
     * Get widgets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWidgets()
    {
        return $this->widgets;
    }
}
