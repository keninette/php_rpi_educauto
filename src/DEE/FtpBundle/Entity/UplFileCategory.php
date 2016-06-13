<?php

namespace DEE\FtpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UploadedFileCategory
 *
 * @ORM\Table(name="upl_file_category")
 * @ORM\Entity(repositoryClass="DEE\FtpBundle\Repository\UploadedFileCategoryRepository")
 */
class UplFileCategory
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
     * @ORM\Column(name="label", type="string", length=100, unique=true)
     */
    private $label;
    
    /**
     * @var int : number of copies needed to register student to the exams
     *
     * @ORM\Column(name="nb_of_copies", type="integer")
     */
    private $nbOfCopies;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deliveryDate", type="datetime")
     */
    private $deliveryDate;

    /**
     * @var int
     *
     * @ORM\Column(name="validityPeriod", type="integer", nullable=true)
     */
    private $validityPeriod;

    /**
     * @var string
     *
     * @ORM\Column(name="ftpDirectory", type="string", length=255)
     */
    private $ftpDirectory;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set label
     *
     * @param string $label
     *
     * @return UploadedFileCategory
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set deliveryDate
     *
     * @param \DateTime $deliveryDate
     *
     * @return UploadedFileCategory
     */
    public function setDeliveryDate($deliveryDate)
    {
        $this->deliveryDate = $deliveryDate;

        return $this;
    }

    /**
     * Get deliveryDate
     *
     * @return \DateTime
     */
    public function getDeliveryDate()
    {
        return $this->deliveryDate;
    }

    /**
     * Set validityPeriod
     *
     * @param integer $validityPeriod
     *
     * @return UploadedFileCategory
     */
    public function setValidityPeriod($validityPeriod)
    {
        $this->validityPeriod = $validityPeriod;

        return $this;
    }

    /**
     * Get validityPeriod
     *
     * @return int
     */
    public function getValidityPeriod()
    {
        return $this->validityPeriod;
    }

    /**
     * Set ftpDirectory
     *
     * @param string $ftpDirectory
     *
     * @return UploadedFileCategory
     */
    public function setFtpDirectory($ftpDirectory)
    {
        $this->ftpDirectory = $ftpDirectory;

        return $this;
    }

    /**
     * Get ftpDirectory
     *
     * @return string
     */
    public function getFtpDirectory()
    {
        return $this->ftpDirectory;
    }
    
    /**
     * Get number of copies needed
     * 
     * @return int
     */
    function getNbOfCopies() {
        return $this->nbOfCopies;
    }

    /**
     * Set number of copies needed
     * 
     * @param type $nbOfCopies
     */
    function setNbOfCopies($nbOfCopies) {
        $this->nbOfCopies = $nbOfCopies;
    }
}

