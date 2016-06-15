<?php

// src/DEE/CoursesBundle/DataFixtures/ORM/LoadExamType.php

namespace DEE\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DEE\CoursesBundle\Entity\ExamType;


/**
 * Description of LoadExamType
 *
 * @author kbj
 */
class LoadExamType {
    
     /**
     * Function used to create ftp file categories into database
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager) {
        $codes = array ('A1'
                        ,'A+'
                        ,'A'
                        ,'B'
                        ,'CR'
                        );
        
        $labels = array('Motocyclettes légères'
                        ,'Motocyclettes 34ch'
                        ,'Motocyclettes 100ch'
                        ,'Automobiles 3.5T'
                        ,'Code de la route'
                        );
        
        $requiredAge = array(16,18,21,18,16);
        
        $validityPeriod = array(0,0,0,0,5);
        
        $i = 0;
        foreach ($codes as $code) {
            $examType = new ExamType();
            $examType   ->setCode($code)
                        ->setExamLabel($labels[i])
                        ->setRequiredAge($requiredAge[i]);
            if ($validityPeriod[$i] > 0) { $examType->setValidityPeriod($validityPeriod[$i]); }
            
            $manager->persist($examType);
            $i++;
        }
        
        $manager->flush();
    }
}
