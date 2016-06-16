<?php

namespace DEE\FtpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * FtpFileCategory
 *
 * @ORM\Table(name="ftp_file_category")
 * @ORM\Entity(repositoryClass="DEE\FtpBundle\Repository\FtpFileCategoryRepository")
 */
class FtpFileCategory
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
     * 
     * @Assert\NotBlank()
     * @Assert\Type(type="string")
     * @Assert\Length(max=100)
     */
    private $label;
    
    /**
     * @var int : number of copies needed to register student to the exams
     *
     * @ORM\Column(name="nb_of_copies", type="integer", nullable=true)
     * 
     * @Assert\Regex(pattern="/^\d*$/", message="Vous devez entrer un nombre")
     */
    private $nbOfCopies;

    /**
     * @var int
     *
     * @ORM\Column(name="validityPeriod", type="integer", nullable=true)
     * 
     * @Assert\Regex(pattern="/^\d*$/")
     */
    private $validityPeriod;

    /**
     * @var string
     *
     * @ORM\Column(name="ftpDirectory", type="string", length=255, nullable=false)
     * 
     * @Assert\NotBlank()
     * @Assert\Type(type="string")
     * @Assert\Length(max=255)
     * @Assert\Regex(pattern="/^docs\/[a-z]+\/$/")
     */
    private $ftpDirectory;
    
    /**
     * @var string array
     * 
     * @ORM\Column(name="authorized_extensions", type="array", nullable=false)
     * 
     * @Assert\NotBlank()
     */
    private $authorizedExtensions;
    
    public function __construct() {
        $this->authorizedExtensions = array();
    }

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
     * @return FtpFileCategory
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
     * Set validityPeriod
     *
     * @param integer $validityPeriod
     *
     * @return FtpFileCategory
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
     * @return FtpileCategory
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
    
    /**
     * Get authorized extensions
     * 
     * @return string array
     */
    function getAuthorizedExtensions() {
        return $this->authorizedExtensions;
    }
    
    /**
     * Get authorized extensions in a string
     * 
     * @return string 
     */
    function getAuthorizedExtensionsToString() {
        return (string) implode($this->authorizedExtensions);
    }

    /**
     * Set authorized extensions
     * 
     * @param type $authorizedExtensions
     */
    function setAuthorizedExtensions($authorizedExtensions) {
        if (!in_array($authorizedExtensions, $this->authorizedExtensions, true)) {
            $this->authorizedExtensions[] = $authorizedExtensions;
        }

        return $this;
    }
    
    /**
     * Check if the extension is in authorized extensions array
     * @param string $extension
     * @return bool true if it's in array, or false if it's not
     */
    function isExtensionValid($extension) {
        return in_array($extension, $this->getAuthorizedExtensions());
    }
}

