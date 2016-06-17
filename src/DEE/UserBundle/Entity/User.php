<?php

namespace DEE\UserBundle\Entity;

use Doctrine\ORM\Mapping        as ORM;
use FOS\UserBundle\Model\User   as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="DEE\UserBundle\Repository\UserRepository")
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
     * Custom array cast
     * @return array
     */
    public function toArray() {
        $array = array();
        
        $array['id']        =  $this->getId();
        $array['enabled']   =  $this->isEnabled();
        $array['username']  =  $this->getUsername();
        $array['email']     =  $this->getEmail();
        $array['role']      =  $this->getRoles();
        
        return $array;
    }
}