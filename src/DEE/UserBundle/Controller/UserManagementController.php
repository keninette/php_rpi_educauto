<?php

// src/DEE/UserBundle/Controller/UserManagementController.php

namespace DEE\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Description of UserManagementController
 *
 * @author kbj
 */
class UserManagementController extends Controller {
    
    public function indexAction() {
        return $this->render('DEEUserBundle:UserManagement:index.html.twig');
    }
    
    /**
   * @Security("has_role('ROLE_SUPER_ADMIN')")
   */
    public function usersAction() {
        $userManager = $this->get('fos_user.user_manager') ;
        $users = $userManager->findUsers();
        
        return $this->render('DEEUserBundle:UserManagement:users.html.twig', array('users' => $users));
    }
    
    /**
   * @Security("has_role('ROLE_SUPER_ADMIN')")
   */
    public function activateAction($id) {
        var_dump($id);
        
        // Get user
        $userManager = $this->get('fos_user.user_manager') ;
        $user = $userManager->findUserBy(array('id' => $id));
        
        // Deactivate user & add flashbag
        if ($user->getEnabled()) {
             $user->setEnabled(false);
             $this->getSession()->getFlashBag()->add('notice','L\'utilisateur a bien été désactivé');
        } else {
            $user->setEnabled(true);
            $this->getSession()->getFlashBag()->add('notice','L\'utilisateur a bien été activé');
        }  
        $userManager->update($user);
        
        return new JsonResponse(array('success' => true));
    }
}