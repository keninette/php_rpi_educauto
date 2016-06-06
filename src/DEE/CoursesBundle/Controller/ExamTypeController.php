<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DEE\CoursesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use DEE\CoursesBundle\Entity\ExamType;
use DEE\CoursesBundle\Form\ExamTypeType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use DEE\CoreBundle\Utils\ArrayFormatter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


/**
 * Controller regarding all examtype actions available
 *
 * @author Delphine Gauthier [at]DEE
 */
class ExamTypeController extends Controller {
    
    /**
     * Send all examTypes and add form to view
     * Persists examType in database on ajax call
     * 
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function indexAction(Request $request) {
        
        // Get all exam types
        $etRepository = $this->getDoctrine()->getManager()->getRepository('DEECoursesBundle:ExamType');
        $examTypes = $etRepository->findAll();
        
        // Create student form
        $examType = new ExamType();
        $form = $this->createForm(ExamTypeType::class, $examType);
        
        // Manage form if it has been filled and return ajax response
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $etManager = $this->getDoctrine()->getManager();
            $etManager->persist($examType);
            $etManager->flush();

            return new JsonResponse(array(
                                        'success'   => true
                                        ,'examtype'  => (array) $examType
            ));
        }
        
        return $this->render('DEECoursesBundle:ExamType:index.html.twig', array('examtypes' => $examTypes, 'form' =>$form->createView()));
    }
    
    /**
     * Delete an examType in database
     * @return JSONResponse success tag
     * 
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction($id) {

        // Get examType
        $etManager = $this->getDoctrine()->getManager();
        $examType = $etManager->find(ExamType::class, $id);

        // Deactivate user
        $etManager->remove($examType);
        $etManager->flush();

        return new JsonResponse(array('success' => true));
    }
}
