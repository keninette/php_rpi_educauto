<?php

namespace DEE\FtpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Ijanki\Bundle\FtpBundle\Exception\FtpException;

/**
 * UploadedFile
 *
 * @ORM\Table(name="ftp_file")
 * @ORM\Entity(repositoryClass="DEE\FtpBundle\Repository\FtpFileRepository")
 */
class FtpFile
{
    const CST_NAME_LENGTH = 15;
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
    
    private $url;
    
    /**
     * @ORM\ManyToOne(targetEntity="DEE\FtpBundle\Entity\FtpFileCategory", cascade={"persist"})
     * @ORM\JoinColumn(name="category", referencedColumnName="id", nullable=false)
     */
    private $category;
    
    /**
     * @ORM\ManyToOne(targetEntity="DEE\CoursesBundle\Entity\Student", cascade={"persist"})
     * @ORM\JoinColumn(name="student", referencedColumnName="id", nullable=true)
     */
    private $student;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deliveryDate", type="datetime", nullable=true)
     */
    private $deliveryDate;
    
    /**
     * Actual uploaded file
     * @var type 
     */
    private $file;
    
    /**
     * Creates a random name composed with alphanumeric and special characterss
     * @return string name generated
     */
    public function createRandomName() {
        // Creating an array with alphanumeric
        $chars          = explode(',','a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,y,z'
                                        .',A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z'
                                        .',0,1,2,3,4,5,6,7,8,9,-,_');
        $maxRange       = sizeof($chars) -1;
        $name       = '';
        
        // Add a random char to password
        for($charCounter = 0; $charCounter < self::CST_NAME_LENGTH; $charCounter++) {
            $name .= $chars[rand(0,$maxRange)];
        } 
        
        return $name;
    }
    
    /**
     * Get the file extension
     * @param string $fileName
     * @return string 
     */
    public function getExtension () {
        $fileName = $this->file->getClientOriginalName();
        return substr($fileName, strripos($fileName,'.')+1);
    }
    
    public function uploadFileToFtp($ftp, $ftpDirectory) {
        
        $this->name = $this->createRandomName() .'.' .$this->getExtension();
        $uploadDirectory = __DIR__.'/../../../../web/uploads/';
        var_dump($this->name);
        var_dump($this->file);
        var_dump($uploadDirectory .$this->name);
        try {
            $this->file->move($uploadDirectory,$this->name);
            ftp_put($ftp,$ftpDirectory .$this->name, $uploadDirectory .$this->name,FTP_ASCII);
            $this->file->remove();
        } catch (FtpException $e) {
            var_dump($e->getMessage());
            return false;
        }
        return true;
    }
    
    public function isFileValid() {
        $errors = array();
        
        if (!filesize($this->file) || filesize($this->file) > FtpFileCategory::MAX_FILE_SIZE) {
            $errors[] = 'La taille du fichier ne doit pas dépasser 3Mo.';      
        }
        
        if (!$this->category->isExtensionValid($this->file->getExtension())) {
            $errors[] = 'L\'extention du fichier n\'est pas valide.';
        }
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
     * Set name
     *
     * @param string $name
     *
     * @return FtpFile
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
     * Get uploaded file
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
    
    /**
     * Set deliveryDate
     *
     * @param \DateTime $deliveryDate
     *
     * @return FtpFileCategory
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
    
    function getCategory() {
        return $this->category;
    }

    function getStudent() {
        return $this->student;
    }

    function setCategory($category) {
        $this->category = $category;
    }

    function setStudent($student) {
        $this->student = $student;
    }


}

