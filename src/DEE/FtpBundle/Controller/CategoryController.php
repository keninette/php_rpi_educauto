<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DEE\FtpBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\JsonResponse;

use DEE\FtpBundle\Entity\FtpFileCategory;
use DEE\FtpBundle\Form\FtpFileCategoryType;


/**
 * Controller regarding all ExamCategory actions available
 *
 * @author Delphine Gauthier [at]DEE
 */
class CategoryController extends Controller {
    
    /**
     * Send all ExamCategorys and add form to view
     * Persists new ExamCategory 
     * 
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function indexAction(Request $request) {
        $validForm = true;
        
        // Create student form
        $FileCategory = new FtpFileCategory();
        $form = $this->createForm(FtpFileCategoryType::class, $FileCategory);
        
        // Manage form if it has been filled and return ajax response
        if ($request->isMethod('POST')) {
            if($form->handleRequest($request)->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($FileCategory);
                $entityManager->flush();
            } else {
                $validForm = false;
            }
        }
        
        // Get all exam types
        $categoryRepository = $this->getDoctrine()->getManager()->getRepository('DEEFtpBundle:FtpFileCategory');
        $FileCategories = $categoryRepository->findAll();
        
        return $this->render('DEEFtpBundle:Category:index.html.twig'
                            , array('FileCategories' => $FileCategories, 'form' =>$form->createView(), 'validForm' => $validForm));
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
        $CategoryRepository = $entityManager->getRepository('DEEFtpBundle:FtpFileCategory');
        $FileCategory = $entityManager->find(FtpFileCategory::class, $id);
        
        $exams  = $CategoryRepository->findBy(array('category' => $FileCategory));
        
        if (count($exams) > 0) {
            return new JsonResponse(array('success' => false));
        } else {
            // Deactivate user
            $entityManager->remove($FileCategory);
            $entityManager->flush();

            return new JsonResponse(array('success' => true));
        }
    }
}
