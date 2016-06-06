<?php

namespace DEE\CoursesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(name="date", type="datetime")
     * @ORM\JoinColumn(nullable=true)
     */
    private $date;

    /**
     * @var bool
     *
     * @ORM\Column(name="training", type="boolean")
     * @ORM\JoinColumn(nullable=true)
     */
    private $training;
    
    /**
     * @var bool
     *
     * @ORM\Column(name="success", type="boolean")
     * @ORM\JoinColumn(nullable=true)
     */
    private $success;
    
    /**
     * @ORM\ManyToOne(targetEntity="DEE\CoursesBundle\Entity\ExamType", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @ORM\Column(name="exam_type")
     */
    private $examType;

    /**
     *
     * @var Student 
     * 
     * @ORM\ManyToOne(targetEntity="DEE\CoursesBundle\Entity\Student", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
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
        $array['examType']  = $this->getExamType()->getExamLabel();
        
        return $array;
    }
    
    /**
     * Function to set what is to be displayed in form under exam input
     * @return string
     */
    public function getExamFormDisplay() {
        var_dump($this->getExamType());
        return $this->getExamType()->getExamLabel();
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
    function setIn_training($training) {
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
     * Get examType
     *
     * @return ExamType
     */
    function getExamType() {
        return $this->examType;
    }
    
    /**
     * Set examType
     *
     * @param ExamType $examType
     *
     * @return Exam
     */
    function setExamType(ExamType $examType) {
        $this->examType = $examType;
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
     * @param ExamType $student
     *
     * @return Student
     */
    function setStudent(Student $student) {
        $this->student = $student;
    }
}

