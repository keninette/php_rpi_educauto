<?php

namespace DEE\StudentManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExamType
 *
 * @ORM\Table(name="exam_type")
 * @ORM\Entity(repositoryClass="DEE\StudentManagementBundle\Repository\ExamTypeRepository")
 */
class ExamType
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
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="exam_label", type="string", length=50)
     */
    private $examLabel;

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
     * @return ExamType
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
     * @return ExamType
     */
    public function setExamLabel($examLabel)
    {
        $this->examLabel = $examLabel;
    
        return $this;
    }

    /**
     * Get examLabel
     *
     * @return string
     */
    public function getExamLabel()
    {
        return $this->examLabel;
    }

    /**
     * Set requiredAge
     *
     * @param integer $requiredAge
     *
     * @return ExamType
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
     * @return ExamType
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
}

