<?php

namespace RleeCMS\CMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Widget
 *
 * @ORM\Entity
 * @ORM\Table(name="CMS_Widget")
 * ORM\Entity(repositoryClass="WidgetRepository")
 */
class Widget
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var boolean
     * @ORM\Column(name="hideTitle", type="boolean", options={"default" = 1})
     */
    private $hideTitle;

    /**
     * @var string
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     * @ORM\Column(name="html", type="text", nullable=true)
     */
    private $html;

    /**
     * @var string
     * @ORM\Column(name="title_html", type="text", nullable=true)
     */
    private $titleHtml;

    /**
     * @var array
     * @ORM\Column(name="params", type="array")
     */
    private $params;

    /**
     * @var integer
     * @ORM\Column(name="orderning", type="integer", options={"default" = 0}, nullable=true)
     */
    private $orderning;

    /**
     * @var string
     * @ORM\Column(name="position", type="string", nullable=true)
     */
    private $position;

    /**
     * Статус страницы
     * @var boolean
     * @ORM\Column(name="status", type="boolean", options={"default" = 0})
     *
     */
    private $status;

    /**
     * @ORM\ManyToMany(targetEntity="RleeCMS\CMSBundle\Entity\Menu", inversedBy="widgets")
     * @ORM\JoinTable(name="CMS_widget_menu",
     *      joinColumns={@ORM\JoinColumn(name="widget_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="menu_id", referencedColumnName="id")}
     *      )
     */
    protected $menus;

    /**
     * @var string
     * @ORM\Column(name="class", type="string", nullable=true)
     */
    private $class;

    /**
     * @ORM\Column(name="youtube_src", type="string", length=400, nullable=true)
     */
    private $youtubeSrc;

    /**
     * @var string
     * @ORM\Column(name="menu_check", type="string", nullable=true)
     */
    private $menuCheck;

    /**
     * @return mixed
     */
    public function getYoutubeSrc()
    {
        return $this->youtubeSrc;
    }

    /**
     * @param mixed $youtubeSrc
     */
    public function setYoutubeSrc($youtubeSrc)
    {
        $this->youtubeSrc = $youtubeSrc;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->menus = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Widget
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
     * Set hideTitle
     *
     * @param boolean $hideTitle
     *
     * @return Widget
     */
    public function setHideTitle($hideTitle)
    {
        $this->hideTitle = $hideTitle;

        return $this;
    }

    /**
     * Get hideTitle
     *
     * @return boolean
     */
    public function getHideTitle()
    {
        return $this->hideTitle;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Widget
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
     * Set html
     *
     * @param string $html
     *
     * @return Widget
     */
    public function setHtml($html)
    {
        $this->html = $html;

        return $this;
    }

    /**
     * Get html
     *
     * @return string
     */
    public function getHtml()
    {
        return $this->html;
    }

    /**
     * Set params
     *
     * @param array $params
     *
     * @return Widget
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
     * Set orderning
     *
     * @param integer $orderning
     *
     * @return Widget
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
     * Set position
     *
     * @param string $position
     *
     * @return Widget
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set status
     *
     * @param boolean $status
     *
     * @return Widget
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set class
     *
     * @param string $class
     *
     * @return Widget
     */
    public function setClass($class)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Get class
     *
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set menuCheck
     *
     * @param string $menuCheck
     *
     * @return Widget
     */
    public function setMenuCheck($menuCheck)
    {
        $this->menuCheck = $menuCheck;

        return $this;
    }

    /**
     * Get menuCheck
     *
     * @return string
     */
    public function getMenuCheck()
    {
        return $this->menuCheck;
    }

    /**
     * Add menu
     *
     * @param \RleeCMS\CMSBundle\Entity\Menu $menu
     *
     * @return Widget
     */
    public function addMenu(\RleeCMS\CMSBundle\Entity\Menu $menu)
    {
        $this->menus[] = $menu;

        return $this;
    }

    /**
     * Remove menu
     *
     * @param \RleeCMS\CMSBundle\Entity\Menu $menu
     */
    public function removeMenu(\RleeCMS\CMSBundle\Entity\Menu $menu)
    {
        $this->menus->removeElement($menu);
    }

    /**
     * Get menus
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMenus()
    {
        return $this->menus;
    }

    /**
     * Set titleHtml
     *
     * @param string $titleHtml
     *
     * @return Widget
     */
    public function setTitleHtml($titleHtml)
    {
        $this->titleHtml = $titleHtml;

        return $this;
    }

    /**
     * Get titleHtml
     *
     * @return string
     */
    public function getTitleHtml()
    {
        return $this->titleHtml;
    }
}
