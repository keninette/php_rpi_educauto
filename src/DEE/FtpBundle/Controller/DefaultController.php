<?php
namespace DEE\FtpBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Description of DefaultController
 *
 * @author Etudiant
 */
class DefaultController extends Controller {
    
    /**
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function indexAction() {
        // Get entity manager
        $entityManager = $this->getDoctrine()->getManager();
        
        
        
    }
}
