<?php

namespace XpatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


abstract class SimpleRef
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $name;

    /**
     * @ORM\Column(type="datetime", length=255, nullable=false)
     */
    protected $createDate;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $status;



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
     * Set nameRu
     *
     * @param string $nameRu
     *
     * @return SimpleRef
     */
    public function setName($nameRu)
    {
        $this->name = $nameRu;

        return $this;
    }

    /**
     * Get nameRu
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * Set createDate
     *
     * @param \DateTime $createDate
     *
     * @return SimpleRef
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;

        return $this;
    }

    /**
     * Get createDate
     *
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * Set status
     *
     * @param boolean $status
     *
     * @return SimpleRef
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



    public function __toString()
    {
        return $this->name;
    }

    public function statusString(){
        if($this->getStatus() == 1){
            return 'Активный';
        }
        return 'Неактивный';
    }

    public function __construct()
    {
        $this->createDate = new \DateTime('now');
    }
}
