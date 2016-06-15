<?php
namespace DEE\FtpBundle\Controller;

// Native components
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

// DEE Classes
use DEE\FtpBundle\Entity\FtpFile;
use DEE\FtpBundle\Entity\FtpFileCategory;
use DEE\CoursesBundle\Entity\Student;

// DEE Forms
use DEE\FtpBundle\Form\FtpFileType;
use DEE\FtpBundle\Form\FtpFileCategoryType;

// Bundle 
use DEE\FtpBundle\Resources\config;



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

            if (! $file->getCategory()->isExtensionValid($file->getExtension())) {
                // todo flashbags
            } else {
                $entityManager = $this->getDoctrine()->getManager();
            
                // Get FTP connection parameters
                $ftpServer  = $this->getParameter('ftpServer');
                $ftpUser    = $this->getParameter('ftpUser');
                $ftpPsw     = $this->getParameter('ftpPsw');
                $ftpPort    = $this->getParameter('ftpPort');
                $ftpRoot    = $this->getParameter('ftpRoot');

                // Connect to FTP
                $ftp = ftp_connect($ftpServer, $ftpPort);

                if (! ftp_login($ftp, $ftpUser, $ftpPsw)) {
                    // todo flashbags
                } else {
                    // Upload file
                    $file->uploadFileToFtp($ftp, $ftpRoot);

                    // Close FTP connection
                    ftp_close($ftp);

                    // Persist file in database
                    $entityManager->persist($file);
                    $entityManager->flush();
                }
            }
        }
        
        return $this->render('DEEFtpBundle:Upload:index.html.twig', array('form' => $form->createView()));
    }
}
