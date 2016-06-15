<?php
namespace DEE\CoursesBundle\Controller;

require_once '../Resources/Config/config.php';

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use DEE\CoursesBundle\Entity\Exam;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use DEE\CoursesBundle\Entity\Student;
use DEE\FtpBundle\Entity\FtpFileCategory;
use Ijanki\Bundle\FtpBundle\Exception\FtpException;

/**
 * Description of ExamController
 *
 * @author kbj
 */

class UploadController extends Controller {
    
    public function indexAction(Request $request) {

        // Create form
        $file = new FtpFile();
        $form = $this->createForm(FtpFileType::class, $file);
        
        // Manage form if it has been filled and return ajax response
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            
            // Check if file is valid
            $errors = $file->isFileValid();
            if (! empty($errors)) {
                // todo error messages
            
            // If it is, connect to FTP & upload file    
            } else {
                $ftp = $this->container->get('ijanki_ftp');
                $ftp->connect($ftpServer);
                $ftp->login($ftpUser, $ftpPsw);
                $file->uploadFileToFtp($ftp)  ;
            }
            
            $entityManager->persist($file);
            $entityManager->flush();
        }
        
        return $this->render('DEEFtpBundle:Upload:index.html.twig', array('form' => $form->createView()));
       
        
        
    }
}
