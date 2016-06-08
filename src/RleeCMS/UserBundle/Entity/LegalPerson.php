<?php

namespace RleeCMS\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
   Symfony\Component\Validator\Constraints as Assert,
   Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="legal_person")
 */
class LegalPerson
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     *
     * @var string
     */
    private $password;

    /**
     * Plain password. Used for model validation. Must not be persisted.
     * @var string
     */
    private $plainPassword;

    /**
     * @var boolean
     *
     */
    private $news;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="company_name", type="string", length=255)
     */
    private $companyName;

    /**
     * @ORM\Column(name="company_type", type="string", length=255,nullable=true)
     */
    private $companyType;

    /**
     * @ORM\Column(name="position", type="string", length=255,nullable=true)
     */
    private $position;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="fio", type="string", length=255,nullable=true)
     */
    private $fio;

    /**
     * @ORM\Column(name="inn", type="string", length=255,nullable=true)
     */
    private $inn;

    /**
     * @ORM\Column(name="director_fio", type="string", length=255,nullable=true)
     */
    private $directorFio;

    /**
     * @ORM\Column(name="country", type="string", length=255,nullable=true)
     */
    private $country;

    /**
     * @ORM\Column(name="p_index", type="string", length=255,nullable=true)
     */
    private $pIndex;

    /**
     * @ORM\Column(name="city", type="string", length=255,nullable=true)
     */
    private $city;

    /**
     * @ORM\Column(name="street", type="string", length=255,nullable=true)
     */
    private $street;

    /**
     * @ORM\Column(name="house_number", type="string", length=255,nullable=true)
     */
    private $houseNumber;

    /**
     * @ORM\Column(name="requisite1", type="string", length=255,nullable=true)
     */
    private $requisite1;

    /**
     * @ORM\Column(name="requisite2", type="string", length=255,nullable=true)
     */
    private $requisite2;

    /**
     * @ORM\Column(name="fact_country", type="string", length=255,nullable=true)
     */
    private $factCountry;

    /**
     * @ORM\Column(name="fact_p_index", type="string", length=255,nullable=true)
     */
    private $factPIndex;

    /**
     * @ORM\Column(name="fact_city", type="string", length=255,nullable=true)
     */
    private $factCity;

    /**
     * @ORM\Column(name="fact_street", type="string", length=255,nullable=true)
     */
    private $factStreet;

    /**
     * @ORM\Column(name="fact_house_number", type="string", length=255,nullable=true)
     */
    private $factHouseNumber;


    /**
     * @ORM\Column(name="phoneNumber", type="string", length=255,nullable=true)
     */
    private $phoneNumber;

    /**
     * @ORM\Column(name="mobile_number", type="string", length=255,nullable=true)
     */
    private $mobileNumber;

    /**
     * @ORM\Column(name="whats_app", type="string", length=255,nullable=true)
     */
    private $whatsApp;

    /**
     * @ORM\Column(name="email1", type="text", length=255,nullable=true)
     */
    private $email1;

    /**
     * @ORM\Column(name="email2", type="text", length=255,nullable=true)
     */
    private $email2;

    /**
     * @ORM\Column(name="site", type="text", length=255,nullable=true)
     */
    private $site;

    /**
     * @ORM\OneToOne(targetEntity="RleeCMS\UserBundle\Entity\User", inversedBy="legal_person")
     * @ORM\JoinColumn(referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private $user;


    private $roles;

    /**
     * @return mixed
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param mixed $roles
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
    }





    public function __construct()
    {
       return $this->companyName;
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
     * Set companyName
     *
     * @param string $companyName
     *
     * @return LegalPerson
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * Get companyName
     *
     * @return string
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Set companyType
     *
     * @param string $companyType
     *
     * @return LegalPerson
     */
    public function setCompanyType($companyType)
    {
        $this->companyType = $companyType;

        return $this;
    }

    /**
     * Get companyType
     *
     * @return string
     */
    public function getCompanyType()
    {
        return $this->companyType;
    }

    /**
     * Set position
     *
     * @param string $position
     *
     * @return LegalPerson
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
     * Set fio
     *
     * @param string $fio
     *
     * @return LegalPerson
     */
    public function setFio($fio)
    {
        $this->fio = $fio;

        return $this;
    }

    /**
     * Get fio
     *
     * @return string
     */
    public function getFio()
    {
        return $this->fio;
    }

    /**
     * Set inn
     *
     * @param string $inn
     *
     * @return LegalPerson
     */
    public function setInn($inn)
    {
        $this->inn = $inn;

        return $this;
    }

    /**
     * Get inn
     *
     * @return string
     */
    public function getInn()
    {
        return $this->inn;
    }

    /**
     * Set directorFio
     *
     * @param string $directorFio
     *
     * @return LegalPerson
     */
    public function setDirectorFio($directorFio)
    {
        $this->directorFio = $directorFio;

        return $this;
    }

    /**
     * Get directorFio
     *
     * @return string
     */
    public function getDirectorFio()
    {
        return $this->directorFio;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return LegalPerson
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
     * Set pIndex
     *
     * @param string $pIndex
     *
     * @return LegalPerson
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
     * Set city
     *
     * @param string $city
     *
     * @return LegalPerson
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
     * Set street
     *
     * @param string $street
     *
     * @return LegalPerson
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set houseNumber
     *
     * @param string $houseNumber
     *
     * @return LegalPerson
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
     * Set requisite1
     *
     * @param string $requisite1
     *
     * @return LegalPerson
     */
    public function setRequisite1($requisite1)
    {
        $this->requisite1 = $requisite1;

        return $this;
    }

    /**
     * Get requisite1
     *
     * @return string
     */
    public function getRequisite1()
    {
        return $this->requisite1;
    }

    /**
     * Set requisite2
     *
     * @param string $requisite2
     *
     * @return LegalPerson
     */
    public function setRequisite2($requisite2)
    {
        $this->requisite2 = $requisite2;

        return $this;
    }

    /**
     * Get requisite2
     *
     * @return string
     */
    public function getRequisite2()
    {
        return $this->requisite2;
    }

    /**
     * Set factCountry
     *
     * @param string $factCountry
     *
     * @return LegalPerson
     */
    public function setFactCountry($factCountry)
    {
        $this->factCountry = $factCountry;

        return $this;
    }

    /**
     * Get factCountry
     *
     * @return string
     */
    public function getFactCountry()
    {
        return $this->factCountry;
    }

    /**
     * Set factPIndex
     *
     * @param string $factPIndex
     *
     * @return LegalPerson
     */
    public function setFactPIndex($factPIndex)
    {
        $this->factPIndex = $factPIndex;

        return $this;
    }

    /**
     * Get factPIndex
     *
     * @return string
     */
    public function getFactPIndex()
    {
        return $this->factPIndex;
    }

    /**
     * Set factCity
     *
     * @param string $factCity
     *
     * @return LegalPerson
     */
    public function setFactCity($factCity)
    {
        $this->factCity = $factCity;

        return $this;
    }

    /**
     * Get factCity
     *
     * @return string
     */
    public function getFactCity()
    {
        return $this->factCity;
    }

    /**
     * Set factStreet
     *
     * @param string $factStreet
     *
     * @return LegalPerson
     */
    public function setFactStreet($factStreet)
    {
        $this->factStreet = $factStreet;

        return $this;
    }

    /**
     * Get factStreet
     *
     * @return string
     */
    public function getFactStreet()
    {
        return $this->factStreet;
    }

    /**
     * Set factHouseNumber
     *
     * @param string $factHouseNumber
     *
     * @return LegalPerson
     */
    public function setFactHouseNumber($factHouseNumber)
    {
        $this->factHouseNumber = $factHouseNumber;

        return $this;
    }

    /**
     * Get factHouseNumber
     *
     * @return string
     */
    public function getFactHouseNumber()
    {
        return $this->factHouseNumber;
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     *
     * @return LegalPerson
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set mobileNumber
     *
     * @param string $mobileNumber
     *
     * @return LegalPerson
     */
    public function setMobileNumber($mobileNumber)
    {
        $this->mobileNumber = $mobileNumber;

        return $this;
    }

    /**
     * Get mobileNumber
     *
     * @return string
     */
    public function getMobileNumber()
    {
        return $this->mobileNumber;
    }

    /**
     * Set whatsApp
     *
     * @param string $whatsApp
     *
     * @return LegalPerson
     */
    public function setWhatsApp($whatsApp)
    {
        $this->whatsApp = $whatsApp;

        return $this;
    }

    /**
     * Get whatsApp
     *
     * @return string
     */
    public function getWhatsApp()
    {
        return $this->whatsApp;
    }

    /**
     * Set email1
     *
     * @param string $email1
     *
     * @return LegalPerson
     */
    public function setEmail1($email1)
    {
        $this->email1 = $email1;

        return $this;
    }

    /**
     * Get email1
     *
     * @return string
     */
    public function getEmail1()
    {
        return $this->email1;
    }

    /**
     * Set email2
     *
     * @param string $email2
     *
     * @return LegalPerson
     */
    public function setEmail2($email2)
    {
        $this->email2 = $email2;

        return $this;
    }

    /**
     * Get email2
     *
     * @return string
     */
    public function getEmail2()
    {
        return $this->email2;
    }

    /**
     * Set site
     *
     * @param string $site
     *
     * @return LegalPerson
     */
    public function setSite($site)
    {
        $this->site = $site;

        return $this;
    }

    /**
     * Get site
     *
     * @return string
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * Set user
     *
     * @param \RleeCMS\UserBundle\Entity\User $user
     *
     * @return LegalPerson
     */
    public function setUser(\RleeCMS\UserBundle\Entity\User $user)
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

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param string $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }

    /**
     * @return boolean
     */
    public function isNews()
    {
        return $this->news;
    }

    /**
     * @param boolean $news
     */
    public function setNews($news)
    {
        $this->news = $news;
    }




}
