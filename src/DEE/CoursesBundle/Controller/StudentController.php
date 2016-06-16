<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DEE\CoursesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use DEE\CoursesBundle\Form\StudentType;
use DEE\CoursesBundle\Form\ExamType;
use DEE\CoursesBundle\Form\LessonType;
use DEE\CoursesBundle\Entity\Student;
use DEE\CoursesBundle\Entity\Exam;
use Symfony\Component\HttpFoundation\JsonResponse;
use DEE\CoursesBundle\Entity\Lesson;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Controller regarding all student actions available
 *
 * @author Delphine Gauthier [at]DEE
 */
class StudentController extends Controller {
    
    /**
     * Send all students and add form to view
     * Persists student in database 
     * 
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function indexAction(Request $request){
        $validForm = true;

        // Create student form
        $student = new Student();
        $form = $this->createForm(StudentType::class, $student);
        
        // Manage form if it has been filled and return ajax response
        if ($request->isMethod('POST')){
            if($form->handleRequest($request)->isValid()) {
                $studentManager = $this->getDoctrine()->getManager();
                $studentManager->persist($student);
                $studentManager->flush();
            } else {
                $validForm = false;
            }
        }
        
        // Get all students
        $studentRepository = $this->getDoctrine()->getManager()->getRepository('DEECoursesBundle:Student');
        $students = $studentRepository->findAll();
        
        return $this->render('DEECoursesBundle:Student:index.html.twig', array('students' => $students, 'form' =>$form->createView(), 'validForm' => $validForm));
    }
    
    /**
     * Delete a student in database
     * @return JSONResponse success tag
     * 
     * @Security("has_role('ROLE_ADMIN')")
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
    
    /**
     * Display a student's course
     * @param type $id : studentID
     * @param Request $request httpRequest
     * @return view or JSONResponse
     * 
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function showCourseAction($id, Request $request) {
        $validLessonForm    = true;
        $validExamForm      = true;
        
        // Prepare all managers & repositories
        $entityManager  = $this->getDoctrine()->getManager();
        $examRepo       = $entityManager->getRepository('DEECoursesBundle:Exam');
        $lessonRepo     = $entityManager->getRepository('DEECoursesBundle:Lesson'); 
        
        // Find user in database
        $student = $entityManager->find(Student::class, $id);
        
        // Get new exam form
        $exam       = new Exam();
        $examForm   = $this->createForm(ExamType::class, $exam);
        
        // Get new lesson form
        $lesson       = new Lesson();
        $lessonForm   = $this->createForm(LessonType::class, $lesson, array('student' => $student));

        // If one of the forms has been filled
        if ($request->getMethod() == 'POST') {
            // Exam form
            if ($request->request->has('exam')) {
                if ($examForm->handleRequest($request)->isValid()) {
                    $exam->setStudent($student);
                    $entityManager->persist($exam);
                    $entityManager->flush(); 
                } else {
                    $validExamForm = false;
                }   
 
            // Lesson form    
            } else if ($request->request->has('lesson')) {
                if ($lessonForm->handleRequest($request)->isValid()) {
                    $entityManager->persist($lesson);
                    $entityManager->flush();
                } else {
                    $validLessonForm = false;
                }
            }
        }
        
        // Find all exams this student has suscribed to
        $exams  = $examRepo->findBy(array('student' => $student));
        
        // Find all lessons for each exam student has suscribed to
        // Add them to an array in which key is exam id
        $lessons = array(); 
        foreach ($exams as $exam) {
            $theseLessons = $lessonRepo->findBy(array('exam' => $exam));
            $lessons[$exam->getId()] = $theseLessons;
        }
        
        // Return view
        return $this->render('DEECoursesBundle:Student:showCourse.html.twig'
                                , array(
                                    'student'           => $student
                                    , 'exams'           => $exams
                                    , 'lessons'         => $lessons
                                    , 'examForm'        => $examForm->createView()
                                    , 'lessonForm'      => $lessonForm->createView()
                                    , 'validExamForm'   => $validExamForm
                                    , 'validLessonForm' => $validLessonForm
                            ));
    }
}
