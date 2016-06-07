<?php
namespace DEE\CoursesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use DEE\CoursesBundle\Entity\Exam;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Description of ExamController
 *
 * @author kbj
 */
class ExamController extends Controller{
   
    /**
     * Delete an exam in database
     * @return JSONResponse success tag
     * 
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction($id) {

        // Get exal
        $examManager = $this->getDoctrine()->getManager();
        $exam = $examManager->find(Exam::class, $id);

        // Deactivate user
        $examManager->remove($exam);
        $examManager->flush();

        return new JsonResponse(array('success' => true));
    }
}
