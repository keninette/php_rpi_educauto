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
            $em = $this->getDoctrine()->getManager();
            $em->persist($student);
            $em->flush();

            return new JsonResponse(array(
                                        'success'   => true
                                        ,'student'  => ArrayFormatter::setCorrectKeysAfterArrayCast((array) $student)
            ));
        }
        
        return $this->render('DEECoursesBundle:Student:index.html.twig', array('students' => $students, 'form' =>$form->createView()));
    }
}
