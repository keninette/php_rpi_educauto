<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DEE\CoursesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use DEE\CoursesBundle\Form\StudentType;
use DEE\CoursesBundle\Entity\Student;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use DEE\CoreBundle\Utils\ArrayFormatter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Description of StudentController
 *
 * @author kbj
 */
class StudentController extends Controller {
    
    public function indexAction(Request $request){
        
        // Get all students
        $studentRepository = $this->getDoctrine()->getManager()->getRepository('DEECoursesBundle:Student');
        $students = $studentRepository->findAll();
        
        // Create student form
        $student = new Student();
        $form = $this->createForm(StudentType::class, $student);
        
        // Manage form if it has been filled and return ajax response
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $studentManager = $this->getDoctrine()->getManager();
            $studentManager->persist($student);
            $studentManager->flush();

            return new JsonResponse(array(
                                        'success'   => true
                                        ,'student'  => (array) $student
            ));
        }
        
        return $this->render('DEECoursesBundle:Student:index.html.twig', array('students' => $students, 'form' =>$form->createView()));
    }
    
    /**
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function deleteAction($id) {

        // Get student
        $studentManager = $this->getDoctrine()->getManager();
        $student = $studentManager->find(Student::class, $id);

        // Deactivate user
        $studentManager->remove($student);
        $studentManager->flush();

        return new JsonResponse(array('success' => true));
    }
}
