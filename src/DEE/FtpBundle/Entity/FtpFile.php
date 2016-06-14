<?php

namespace DEE\FtpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * UploadedFile
 *
 * @ORM\Table(name="ftp_file")
 * @ORM\Entity(repositoryClass="DEE\FtpBundle\Repository\FtpFileRepository")
 */
class FtpFile {
    private static $CST_NAME_LENGTH = 15;
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
     * @ORM\ManyToOne(targetEntity="DEE\FtpBundle\Entity\FtpFileCategory", cascade={"persist"})
     * @ORM\JoinColumn(name="category", referencedColumnName="id", nullable=false)
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="DEE\CoursesBundle\Entity\Student", cascade={"persist"})
     * @ORM\JoinColumn(name="student", referencedColumnName="id", nullable=false)
     */
    private $student;

    /**
     * Uploaded file
     * @var type 
     */
    private $file;

    public function upload($ftp) {
        // TODO : check file
        if (null === $this->file) {
            return;
        }

        // Get original file name
        $name = $this->file->getClientOriginalName();

        // Save file name
        $this->name = $name;
        
        // Move file to FTP
        $ftp->put($this->getFtpFileName(), $this->file, FTP_BINARY);
    }

    public function getFtpFileName() {
        return $this->category->getFtpDirectory() .$this->name;
    }

    protected function getUploadRootDir() {
        // On retourne le chemin relatif vers l'image pour notre code PHP
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return UploadedFile
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Get UploadedFile
     * 
     * @return UploadedFile
     */
    public function getFile() {
        return $this->file;
    }

    /**
     * Set file
     * 
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null) {
        $this->file = $file;
    }
    
    /**
     * Creates a random password composed with alphanumeric and special characters
     * Set this password to the current user's password
     * @return none
     * 
     * ORM\PrePersist
     */
    public function createRandomName() {
        // Creating an array with alphanumeric
        $chars          = explode(',','a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,y,z'
                                        .',A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z'
                                        .',0,1,2,3,4,5,6,7,8,9');
        $maxRange       = sizeof($chars) -1;
        $string         = '';
        
        // Add a random char to string
        for($charCounter = 0; $charCounter < self::CST_NAME_LENGTH; $charCounter++) {
            $string .= $chars[rand(0,$maxRange)];
        } 
        
        return $string;
    }

}
