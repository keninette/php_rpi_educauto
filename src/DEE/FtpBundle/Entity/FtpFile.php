<?php

namespace DEE\FtpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * UploadedFile
 *
 * @ORM\Table(name="ftp_file")
 * @ORM\Entity(repositoryClass="DEE\FtpBundle\Repository\FtpFileRepository")
 */
class FtpFile
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
     * 
     * @Assert\Type(type="string")
     * @Assert\Length(max=100)
     */
    private $name;
    
    /**
     * @ORM\ManyToOne(targetEntity="DEE\FtpBundle\Entity\FtpFileCategory", cascade={"persist"})
     * @ORM\JoinColumn(name="category", referencedColumnName="id", nullable=false)
     * 
     * @Assert\NotBlank()
     */
    private $category;
    
    /**
     * @ORM\ManyToOne(targetEntity="DEE\CoursesBundle\Entity\Student", cascade={"persist"})
     * @ORM\JoinColumn(name="student", referencedColumnName="id", nullable=true)
     * 
     * @Assert\Valid()
     */
    private $student;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deliveryDate", type="datetime", nullable=true)
     * 
     * @Assert\DateTime()
     */
    private $deliveryDate;
    
    /**
     * Actual uploaded file
     *
     * @var type 
     * 
     *@Assert\NotBlank()
     *@Assert\File(maxSize="6000000")
     */
    private $file;
    
    /**
     * Creates a random name composed with alphanumeric and special characterss
     * @return string name generated
     */
    public function createRandomName() {
        $filenameLength = 15;
        
        // Creating an array with alphanumeric
        $chars          = explode(',','a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,y,z'
                                        .',A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z'
                                        .',0,1,2,3,4,5,6,7,8,9,-,_');
        $maxRange       = sizeof($chars) -1;
        $name       = '';
        
        // Add a random char to password
        for($charCounter = 0; $charCounter < $filenameLength ; $charCounter++) {
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
    
    public function uploadFileToFtp($ftp, $ftpRoot) {
        $uploadDirectory    = __DIR__.'/../../../../web/uploads/';
        //$ftpDirectory       = $ftpRoot .  $this->getCategory()->getFtpDirectory();
        
        // Create random name         
        $this->name = $this->createRandomName() .'.' .$this->getExtension();
        
        // Upload file to FTP
        try {
            // 1. Upload to temp file in uploads directory
            $this->file->move($uploadDirectory,$this->name);
            // 2. Upload this file to FTP
            //ftp_put($ftp,$ftpDirectory .$this->name, $uploadDirectory .$this->name,FTP_ASCII);
            //ssh2_scp_send($ftp,$ftpDirectory .$this->name, $uploadDirectory .$this->name);
            // 3. Delete temp file
            //ftp_close($ftp);
            //unlink($uploadDirectory .$this->name);
        } catch (FtpException $e) {
            var_dump($e->getMessage());
            return false;
        }
        return true;
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

