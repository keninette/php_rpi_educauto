<?php

namespace DEE\CoursesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * ExamCategory
 *
 * @ORM\Table(name="exam_category")
 * @ORM\Entity(repositoryClass="DEE\CoursesBundle\Repository\ExamCategoryRepository")
 */
class ExamCategory
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
     * @ORM\Column(name="code", type="string", length=10, unique=true)
     * @Assert\Type(type="string")
     * @Assert\Length(max=10)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=50)
     * 
     * Assert\Type(type="string")
     * @Assert\Length(max=50)
     */
    private $label;

    /**
     * @var int
     *
     * @ORM\Column(name="required_age", type="integer")
     */
    private $requiredAge;

    /**
     * @var int
     *
     * @ORM\Column(name="validity_period", type="integer", nullable=true)
     */
    private $validityPeriod;


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
     * Set code
     *
     * @param string $code
     *
     * @return ExamCategory
     */
    public function setCode($code)
    {
        $this->code = $code;
    
        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set examLabel
     *
     * @param string $examLabel
     *
     * @return ExamCategory
     */
    public function setLabel($label)
    {
        $this->label = $label;
    
        return $this;
    }

    /**
     * Get examLabel
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set requiredAge
     *
     * @param integer $requiredAge
     *
     * @return ExamCategory
     */
    public function setRequiredAge($requiredAge)
    {
        $this->requiredAge = $requiredAge;
    
        return $this;
    }

    /**
     * Get requiredAge
     *
     * @return integer
     */
    public function getRequiredAge()
    {
        return $this->requiredAge;
    }

    /**
     * Set validityPeriod
     *
     * @param integer $validityPeriod
     *
     * @return ExamCategory
     */
    public function setValidityPeriod($validityPeriod)
    {
        $this->validityPeriod = $validityPeriod;
    
        return $this;
    }

    /**
     * Get validityPeriod
     *
     * @return integer
     */
    public function getValidityPeriod()
    {
        return $this->validityPeriod;
    }
    
    /**
     * Custom cast to array
     * @return array
     */
    public function toArray() {
        $array = array();
        
        $array['id']                = $this->getId();
        $array['code']              = $this->getCode();
        $array['label']             = $this->getLabel();
        $array['requiredAge']       = $this->getRequiredAge();
        $array['validityPeriod']    = $this->getValidityPeriod();
            
        return $array;
    }
}

