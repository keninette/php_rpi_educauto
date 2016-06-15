<?php

namespace DEE\CoursesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Exam
 *
 * @ORM\Table(name="exam")
 * @ORM\Entity(repositoryClass="DEE\CoursesBundle\Repository\ExamRepository")
 */
class Exam
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime",nullable=true)
     * 
     * @Assert\DateTime()
     */
    private $date;

    /**
     * @var bool
     *
     * @ORM\Column(name="training", type="boolean", nullable=true)
     * 
     */
    private $training;
    
    /**
     * @var bool
     *
     * @ORM\Column(name="success", type="boolean", nullable=true)
     */
    private $success;
    
    /**
     * @ORM\ManyToOne(targetEntity="DEE\CoursesBundle\Entity\ExamCategory", cascade={"persist"})
     * @ORM\JoinColumn(name="category", referencedColumnName="id", nullable=false)
     * @Assert\Valid()
     */
    private $category;

    /**
     *
     * @var Student 
     * 
     * @ORM\ManyToOne(targetEntity="DEE\CoursesBundle\Entity\Student", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * 
     * @Assert\Valid()
     */
    private $student;
    
    

    /**
     * Constructor to set default values for Exam object
     */
    public function __construct() {
        $this->training = true;
        $this->success = false;
    }
    
    /**
     * Convert the object into an array
     * @param DEE/CoursesBundle/Entity/Exam $exam
     * @return array containing object info
     */
    public function toArray() {
        $array = array();
        
        $array['id']        = $this->getId();
        $array['date']      = $this->getDate();
        $array['training']  = $this->getTraining();
        $array['success']   = $this->getSuccess();
        $array['ExamCategory']  = $this->getExamCategory()->getExamLabel();
        
        return $array;
    }
    
    /**
     * Function to set what is to be displayed in form under exam input
     * @return string
     */
    public function getExamFormDisplay() {
        return $this->getCategory()->getLabel();
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Exam
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
    
    /**
     * Format date to d/m/Y
     * @return string : formatted date 
     */
    public function getDateToString() {
        return date_format($this->date, 'd/m/Y');
    }

    /**
     * Get training
     *
     * @return boolean
     */
    function getTraining() {
        return $this->training;
    }
    
    /**
     * Set training
     *
     * @param boolean $training
     *
     * @return Exam
     */
    function setTraining($training) {
        $this->training = $training;
    }

        
    /**
     * Set success
     *
     * @param boolean $success
     *
     * @return Exam
     */
    public function setSuccess($success)
    {
        $this->success = $success;
    
        return $this;
    }

    /**
     * Get success
     *
     * @return boolean
     */
    public function getSuccess()
    {
        return $this->success;
    }
    
    /**
     * Get category
     *
     * @return category
     */
    function getCategory() {
        return $this->category;
    }
    
    /**
     * Set ExamCategory
     *
     * @param ExamCategory $ExamCategory
     *
     * @return Exam
     */
    function setCategory(ExamCategory $category) {
        $this->category = $category;
    }
    
    /**
     * Get student
     *
     * @return Student
     */
    function getStudent() {
        return $this->student;
    }

    /**
     * Set student
     *
     * @param ExamCategory $student
     *
     * @return Student
     */
    function setStudent(Student $student) {
        $this->student = $student;
    }
}

