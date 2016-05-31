<?php

// src/DEE/UserBundle/Controller/UserManagementController.php

namespace DEE\UserBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of UserManagementController
 *
 * @author kbj
 */
class UserManagementController extends Controller {
    
    public function indexAction() {
        var_dump('plop');
        $userManager = $this->get('fos_user.user_manager') ;
        $users = $userManager->findUsers();
        
        return $this->render('DEEUserBundle:UserManagement:index.html.twig', array('users' => $users));
    }
}
