<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DEE\CoursesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use DEE\CoursesBundle\Entity\ExamCategory;
use DEE\CoursesBundle\Form\ExamCategoryType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * Controller regarding all ExamCategory actions available
 *
 * @author Delphine Gauthier [at]DEE
 */
class ExamCategoryController extends Controller {
    
    /**
     * Send all ExamCategorys and add form to view
     * Persists new ExamCategory 
     * 
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function indexAction(Request $request) {
        $validForm = true;
        
        // Create student form
        $ExamCategory = new ExamCategory();
        $form = $this->createForm(ExamCategoryType::class, $ExamCategory);
        
        // Manage form if it has been filled and return ajax response
        if ($request->isMethod('POST')) {
            if($form->handleRequest($request)->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($ExamCategory);
                $entityManager->flush();
            } else {
                $validForm = false;
            }
        }
        
        // Get all exam types
        $etRepository = $this->getDoctrine()->getManager()->getRepository('DEECoursesBundle:ExamCategory');
        $ExamCategories = $etRepository->findAll();
        
        return $this->render('DEECoursesBundle:ExamCategory:index.html.twig'
                            , array('ExamCategories' => $ExamCategories, 'form' =>$form->createView(), 'validForm' => $validForm));
    }
    
    /**
     * Delete an ExamCategory in database
     * @return JSONResponse success tag
     * 
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction($id) {

        // Get ExamCategory
        $entityManager = $this->getDoctrine()->getManager();
        $examRepository = $entityManager->getRepository('DEECoursesBundle:Exam');
        $ExamCategory = $entityManager->find(ExamCategory::class, $id);
        
        $exams  = $examRepository->findBy(array('category' => $ExamCategory));
        
        if (count($exams) > 0) {
            return new JsonResponse(array('success' => false));
        } else {
            // Deactivate user
            $entityManager->remove($ExamCategory);
            $entityManager->flush();

            return new JsonResponse(array('success' => true));
        }
    }
}
