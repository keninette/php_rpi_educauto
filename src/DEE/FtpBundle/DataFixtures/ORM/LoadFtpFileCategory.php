<?php

// src/DEE/FtpBundle/DataFixtures/ORM/LoadFtpFileCategory.php

namespace DEE\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DEE\FtpBundle\Entity\FtpFileCategory;

/**
 * Description of LoadFtpFileCategorys
 *
 * @author DGA
 */
class LoadFtpFileCategory implements FixtureInterface{
    
    /**
     * Function used to create ftp file categories into database
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager) {
        $labels = array ('Photo d\'identité'
                        ,'Extrait de casier judiciaire'
                        ,'Facture'
                        ,'Carte d\'identité'
                        );
        
        $nbOfCopies = array(3,2,0,1);
        
        $validityPeriod = array(0,1,0,10);
        
        $authorizedExtensions = array   (array  ('jpg'
                                                ,'jpeg'
                                                ,'png'
                                                )
                                        ,array  ('jpg'
                                                ,'jpeg'
                                                ,'png'
                                                ,'pdf'
                                                )
                                        ,array  ('jpg'
                                                ,'jpeg'
                                                ,'png'
                                                ,'pdf'
                                                )
                                        ,array  ('jpg'
                                                ,'jpeg'
                                                ,'png'
                                                )
                                        );
        $directoryPath  = array('docs/photo_id/'
                                ,'docs/casier_judiciaire/'
                                ,'docs/factures/'
                                ,'docs/id/'
                                );
        $i = 0;
        foreach ($labels as $label) {
            $category = new FtpFileCategory();
            $category   ->setLabel($label)
                        ->setDirectoryPath($directoryPath[i]);
            
            if ($nbOfCopies[i] > 0)     { $category->setNbOfCopies($nbOfCopies[i]); }
            if ($validityPeriod[i] > 0) { $category->setValidityPeriod($validityPeriod[i]); }            
            
            foreach ($authorizedExtensions[i] as $ext) {
                $category->setAuthorizedExtensions($ext);
            }
            
            $manager->persist($category);
            $i++;
        }
        
        $manager->flush();
    }
}
