<?php
namespace RleeCMS\CMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Pages
 *
 * @ORM\Table(name="CMS_Pages")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(
 *      fields={"alias"},
 *      errorPath="alias",
 *      message="Этот адрес уже используется"
 * )
 */
class Pages implements Translatable
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
     * Полное название страницы
     * @var string
     * 
     * @ORM\Column(name="fullName", type="string", length=255)
     * @Assert\NotBlank()
     * 
     */
    private $fullName;

    /**
     * Алиас страницы
     * @var string
     *
     * @ORM\Column(name="alias", type="string", length=255, unique=true)
     * @Assert\NotBlank()
     */
    private $alias;

    /**
     * Текст Содержание
     * @var string
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    private $content;

    /**
     * Статус страницы
     * @var integer
     * @ORM\Column(name="status", type="integer")
     * @Assert\NotBlank()
     * 
     */
    private $status;

    /**
     * Заголовок страницы
     * @var string
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     * 
     */
    private $title;

    /**
     * Описание страницы
     * @var string
     * @ORM\Column(name="description", type="text", nullable=true)
     *
     */
    private $description;

    /**
     * Ключевые слова
     * @var string
     * @ORM\Column(name="keywords", type="text", nullable=true)
     * 
     */
    private $keywords;

    /**
     * @ORM\ManyToOne(targetEntity="Pages", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="Pages", mappedBy="parent")
     * @ORM\OrderBy({"id" = "DESC"})
     */
    private $children;

    /**
     * @var \DataTime
     * @ORM\Column(name="created", type="datetime", nullable=true)
     *
     */
    private $created;

    /**
     * @var \DataTime
     * @ORM\Column(name="published", type="datetime")
     *
     */
    private $published;


    /**
     * @var \DataTime
     * @ORM\Column(name="update_date", type="datetime", nullable=true)
     *
     */
    private $updateDate;

    /**
     * @var string
     * @ORM\Column(name="params", type="array", nullable=true)
     * 
     */
    private $params;

    /**
     * @var array
     * @ORM\Column(name="images", type="array", nullable=true)
     */
    private $images;

    /**
     * @var array
     * @ORM\Column(name="main_images", type="array", nullable=true)
     */
    private $mainImages;

    /**
     * @return array
     */
    public function getMainImages()
    {
        return $this->mainImages;
    }

    /**
     * @param array $mainImages
     */
    public function setMainImages($mainImages)
    {
        $this->mainImages = $mainImages;
    }

    /**
     * @return null
     */
    public function getMainImage(){
        if(isset($this->mainImages[0])){
            return $this->mainImages[0];
        }else
            return null;
    }

    /**
     * @return array
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param array $images
     */
    public function setImages($images)
    {
        $this->images = $images;
    }



    function __toString()
    {
        return $this->getFullName();
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
     * Set fullName
     *
     * @param string $fullName
     *
     * @return Pages
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Get fullName
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Set alias
     *
     * @param string $alias
     *
     * @return Pages
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
     * Set content
     *
     * @param string $content
     *
     * @return Pages
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Pages
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
     * Set title
     *
     * @param string $title
     *
     * @return Pages
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
     * Set description
     *
     * @param string $description
     *
     * @return Pages
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
     * Set keywords
     *
     * @param string $keywords
     *
     * @return Pages
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;

        return $this;
    }

    /**
     * Get keywords
     *
     * @return string
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Pages
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set published
     *
     * @param \DateTime $published
     *
     * @return Pages
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return \DateTime
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Set updateDate
     *
     * @param \DateTime $updateDate
     *
     * @return Pages
     */
    public function setUpdateDate($updateDate)
    {
        $this->updateDate = $updateDate;

        return $this;
    }

    /**
     * Get updateDate
     *
     * @return \DateTime
     */
    public function getUpdateDate()
    {
        return $this->updateDate;
    }

    /**
     * Set params
     *
     * @param array $params
     *
     * @return Pages
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
     * Set parent
     *
     * @param \RleeCMS\CMSBundle\Entity\Pages $parent
     *
     * @return Pages
     */
    public function setParent(\RleeCMS\CMSBundle\Entity\Pages $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \RleeCMS\CMSBundle\Entity\Pages
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add child
     *
     * @param \RleeCMS\CMSBundle\Entity\Pages $child
     *
     * @return Pages
     */
    public function addChild(\RleeCMS\CMSBundle\Entity\Pages $child)
    {
        $this->children[] = $child;

        return $this;
    }

    /**
     * Remove child
     *
     * @param \RleeCMS\CMSBundle\Entity\Pages $child
     */
    public function removeChild(\RleeCMS\CMSBundle\Entity\Pages $child)
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
}
