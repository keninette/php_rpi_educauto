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
     */
    private $date;

    /**
     * @var bool
     *
     * @ORM\Column(name="training", type="boolean")
     */
    private $training;
    
    /**
     * @var bool
     *
     * @ORM\Column(name="success", type="boolean")
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Constructor to set default values for Exam object
     */
    public function __construct() {
        $this->training = true;
        $this->success = false;
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
        return $this->in_training;
    }
    
    /**
     * Set in_training
     *
     * @param boolean $in_training
     *
     * @return Exam
     */
    function setIn_training($in_training) {
        $this->in_training = $in_training;
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

