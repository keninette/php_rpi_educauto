<?php

namespace DEE\UserBundle\Entity;

use Doctrine\ORM\Mapping        as ORM;
use FOS\UserBundle\Model\User   as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="DEE\UserBundle\Repository\UserRepository")
 * @ORM\HasLifeCycleCallbacks()
 */
class User extends BaseUser
{
    const CST_PASSWORD_LENGTH = 15;
    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    
    /**
     * Creates a random password composed with alphanumeric and special characters
     * Set this password to the current user's password
     * @return none
     * 
     * ORM\PrePersist
     */
    public function createRandomPassword() {
        // Creating an array with alphanumeric and special chars
        $chars          = explode(',','a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,y,z'
                                        .',A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z'
                                        .',0,1,2,3,4,5,6,7,8,9,-,*,^,£,€,$,#,-,@');
        $maxRange       = sizeof($chars) -1;
        $password       = '';
        
        // Add a random char to password
        for($charCounter = 0; $charCounter < self::CST_PASSWORD_LENGTH; $charCounter++) {
            $password .= $chars[rand(0,$maxRange)];
        } 
        
        // Set the generated password as user's password
        $this->setPassword($password);
    }
}