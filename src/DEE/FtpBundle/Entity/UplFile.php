<?php

namespace DEE\FtpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * UploadedFile
 *
 * @ORM\Table(name="upl_file")
 * @ORM\Entity(repositoryClass="DEE\FtpBundle\Repository\UplFileRepository")
 */
class UplFile
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
     * @var string : name of file + extension
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="DEE\FtpBundle\Entity\UplFileCategory", cascade={"persist"})
     * @ORM\JoinColumn(name="category", referencedColumnName="id", nullable=false)
     */
    private $category;
    
    /**
     * Actual uploaded file
     * @var type 
     */
    private $file;
    
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
     * Set name
     *
     * @param string $name
     *
     * @return UploadedFile
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
     * Get UploadedFile
     * 
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }
    
    /**
     * Set file
     * 
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }
}

