<?php

namespace DEE\CoursesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lesson
 *
 * @ORM\Table(name="lesson")
 * @ORM\Entity(repositoryClass="DEE\CoursesBundle\Repository\LessonRepository")
 */
class Lesson
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
     * @var int
     * Duration must be saved in seconds
     * @ORM\Column(name="duration", type="integer")
     */
    private $duration;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=1500, nullable=true)
     */
    private $comment;
    
    /**
     *
     * @var Exam 
     * 
     * @ORM\ManyToOne(targetEntity="DEE\CoursesBundle\Entity\Exam", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $exam;

    /**
     * Constructor : to set default values
     */
    public function __construct() {
        // Default lesson duration = 3600s (1 hour)
        // Convert it to hours, so user doesn't have to convert
        $this->duration = 60;
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
     * @return Lesson
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
     * Set duration
     *
     * @param int $duration 
     *
     * @return Lesson
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    
        return $this;
    }
    
    /**
     * Get duration
     *
     * @return \DateTime
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return Lesson
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    
        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }
    
    /**
     * Get Exam
     *
     * @return Exam
     */
    function getExam() {
        return $this->exam;
    }

     /**
     * Set exam
     *
     * @param Ewam $exam
     *
     * @return Lesson
     */
    function setExam(Exam $exam) {
        $this->exam = $exam;
    }
    
    /**
     * Function to set what is to be displayed in form under exam input
     * @return string
     */
    /*public function getExamFormDisplay() {
        return $this->getExam()->getExamType()->getExamLabel();
    }*/
    
    /**
     * Custom cast to array
     * @return array
     */
    public function toArray() {
        $array = array();
        
        $array['id']        = $this->getId();
        $array['date']      = $this->getDate();
        $array['duration']  = $this->getDuration();
        $array['comment']   = $this->getComment();
        $array['exam']      = $this->getExamFormDisplay();
        
        return $array;
    }
}

