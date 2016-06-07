<?php

// src/DEE/UserBundle/Controller/UserManagementController.php

namespace DEE\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use DEE\CoreBundle\Utils\ArrayFormatter;

/**
 * Description of UserManagementController
 *
 * @author kbj
 */
class UserManagementController extends Controller {
    
    /**
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function indexAction() {
        return $this->render(':backend:index.html.twig');
    }

    /**
     * Display all users & add user form
     * Handle form
     * @param Request $request
     * @return view to render
     * 
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function usersAction(Request $request) {
        // Get all users
        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();

        // Get form to add a new user
        // This is FOSUserBundle:Registration:register simpler copy
        // No override of existing register controller for 2 reasons :
        //  - It will be used on website version 2
        //  - Not to mess with updates
        $formFactory = $this->get('fos_user.registration.form.factory');
        $user = $userManager->createUser();
        $user->setEnabled(true);
     
        $form = $formFactory->createForm();
        $form->add('roles'
                , ChoiceType::class
                , array(
                    'choices'       => $this->getExistingRoles()
                    , 'required'    => true  
                    , 'multiple'    => true
                    , 'expanded'    => true
        ));
        
        $form->setData($user);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $userManager->updateUser($user);
            return new JsonResponse(array(
                                        'success' => true
                                        ,'user' => $user->toArray()
            ));
        }
        
        return $this->render('DEEUserBundle:UserManagement:users.html.twig', array('users' => $users, 'form' => $form->createView()));
    }

    /**
     * Activate or deactivate user controller
     * @param type $id
     * @return JsonResponse
     * 
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function activateAction($id) {

        // Get user
        $userManager = $this->get('fos_user.user_manager');
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
     * Delete user controller
     * @param integer $id : user id
     * @return JsonResponse
     * 
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function deleteAction($id) {

        // Get user
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserBy(array('id' => $id));

        // Deactivate user
        $userManager->deleteUser($user);

        return new JsonResponse(array('success' => true));
    }
    
    /**
     * Get all existing roles in app
     * @return array[rolename formatted] = rolename raw
     */
    public function getExistingRoles() {
        $roleHierarchy = $this->container->getParameter('security.role_hierarchy.roles');
        $existingRoles = array_keys($roleHierarchy);
        
        // Add roles to new array, and format string
        foreach ($existingRoles as $role) {
            $roles[str_replace('_', ' ', substr($role,5))] = $role ;
        }
        return $roles;
    }
}
