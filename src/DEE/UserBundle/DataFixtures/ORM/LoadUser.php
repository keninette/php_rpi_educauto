<?php

// src/DEE/UserBundle/DataFixtures/ORM/LoadUser.php

namespace DEE\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DEE\UserBundle\Entity\User;

/**
 * Description of LoadUser
 *
 * @author DGA
 */
class LoadUser implements FixtureInterface{
    
    /**
     * Function used to create fake users into database
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager) {
        $names = array ('jeangilles'
                        ,'kbj'
                        ,'jeanneige'
                        ,'harryseldon'
                        );
        
        foreach ($names as $name) {
            $user = new User();
            $user   ->setUsername($name)
                    ->setPassword(hash('sha512',$name))
                    ->setEmail($name.'@' .$name .'.plop')
                    ->setEnabled(true);
            
            $manager->persist($user);
        }
        
        $manager->flush();
    }
}
