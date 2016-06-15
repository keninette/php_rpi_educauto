<?php

namespace DEE\CoursesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use DEE\CoursesBundle\Entity\Exam;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Description of Lesson
 *
 * @author kbj
 */
class LessonController extends Controller {
    
    /**
     * Delete an exam in database
     * @return JSONResponse success tag
     * 
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction($id) {

        // Get exal
        $entityManager = $this->getDoctrine()->getManager();
        $lesson = $entityManager->find(Lesson::class, $id);

        // Deactivate user
        $entityManager->remove($lesson);
        $entityManager->flush();

        return new JsonResponse(array('success' => true));
    }
}
