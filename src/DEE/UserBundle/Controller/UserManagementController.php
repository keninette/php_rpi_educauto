<?php

// src/DEE/UserBundle/Controller/UserManagementController.php

namespace DEE\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
    public function usersAction(Request $request) {
        // Get all users
        $userManager = $this->get('fos_user.user_manager') ;
        $users = $userManager->findUsers();
        
        // Get form to add a new user
        $response = $this->forward('FOSUserBundle:Registration:register', array('request' => $request));
        
        return $this->render('DEEUserBundle:UserManagement:users.html.twig', array('users' => $users,'response'=>$response->getContent()));
    }
    
    /**
     * @Security("has_role('ROLE_SUPER_ADMIN')")
    */
    public function activateAction($id) {
        
        // Get user
        $userManager = $this->get('fos_user.user_manager') ;
        $user = $userManager->findUserBy(array('id' => $id));
        
        // Deactivate user
        if ($user->isEnabled()) {
             $user->setEnabled(false);
        } else {
            $user->setEnabled(true);
        }  
        $userManager->updateUser($user);
        
       return new JsonResponse(array('success' => true, 'active' => $user->isEnabled()));
    }
    
    /**
     * @Security("has_role('ROLE_SUPER_ADMIN')")
    */
    public function deleteAction($id) {
        
        // Get user
        $userManager = $this->get('fos_user.user_manager') ;
        $user = $userManager->findUserBy(array('id' => $id));
        
        // Deactivate user
        $userManager->deleteUser($user);
        
       return new JsonResponse(array('success' => true));
    }
}