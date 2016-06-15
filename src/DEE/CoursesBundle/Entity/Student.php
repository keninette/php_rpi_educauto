<?php

namespace DEE\CoursesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Student
 *
 * @ORM\Table(name="student")
 * @ORM\Entity(repositoryClass="DEE\CoursesBundle\Repository\StudentRepository")
 */
class Student
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
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="address_other", type="string", length=255, nullable=true)
     */
    private $addressOther;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=20)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="phone_other", type="string", length=20, nullable=true)
     */
    private $phoneOther;

    /**
     * @var string
     * 
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;   
    
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
     * @return Student
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
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Student
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    
        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Student
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
     * Set addressOther
     *
     * @param string $addressOther
     *
     * @return Student
     */
    public function setAddressOther($addressOther)
    {
        $this->addressOther = $addressOther;
    
        return $this;
    }

    /**
     * Get addressOther
     *
     * @return string
     */
    public function getAddressOther()
    {
        return $this->addressOther;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Student
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
     * Set phoneOther
     *
     * @param string $phoneOther
     *
     * @return Student
     */
    public function setPhoneOther($phoneOther)
    {
        $this->phoneOther = $phoneOther;
    
        return $this;
    }

    /**
     * Get phoneOther
     *
     * @return string
     */
    public function getPhoneOther()
    {
        return $this->phoneOther;
    }
    
    /**
     * Get email
     * 
     * @return string
     */
    function getEmail() {
        return $this->email;
    }
    
    /**
     * Set email
     *
     * @param string $email
     *
     * @return Student
     */
    function setEmail($email) {
        $this->email = $email;
    }
    
    /**
     * Custom return object to array
     * @return array
     */
    public function toArray() {
        $array = array();
        
        $array['id']            = $this->getId();
        $array['name']          = $this->getName();
        $array['firstname']     = $this->getFirstname();
        $array['address']       = $this->getAddress();
        $array['addressOther']  = $this->getAddressOther();
        $array['phone']         = $this->getPhone();
        $array['phoneOther']    = $this->getPhoneOther();
        $array['email']         = $this->getEmail();
        
        return $array;
    }
    
    /**
     * Return a string used to identify user in forms
     * @return string
     */
    public function getFormDisplay() { // tODo ajouter ville
        return $this->name .' ' .$this->firstname ;
    }

}

