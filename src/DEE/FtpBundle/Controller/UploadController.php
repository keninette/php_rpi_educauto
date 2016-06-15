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
            $entityManager = $this->getDoctrine()->getManager();
            
            // Check if file is valid
            $errors = $file->isFileValid();
            if (! empty($errors)) {
                // todo error messages
            
            // If it is, connect to FTP & upload file    
            } else {
                $ftpServer  = 'ftp.kkbj.info';
                $ftpUser    = 'kkbjinfoif';
                $ftpPsw     = 'zt6U8EQz6u5v';
                $ftpPort    = 21;
                $ftpRoot    = 'www/educauto/';
                
                // Connect to FTP
                $ftp = ftp_connect($ftpServer, $ftpPort);
                $connected = ftp_login($ftp, $ftpUser, $ftpPsw);
                
                // Check if directory exists
                $ftpDirectory = $ftpRoot .$file->getCategory()->getFtpDirectory();
                var_dump($ftpDirectory);
                /*if (empty(ftp_nlist($ftp, $ftpDirectory))) {
                    ftp_mkdir($ftp,$ftpDirectory);
                }*/
                                var_dump('plop');
                $file->uploadFileToFtp($ftp, $ftpDirectory)  ;
            }
            ftp_close($ftp);
            $entityManager->persist($file);
            $entityManager->flush();
        }
        
        return $this->render('DEEFtpBundle:Upload:index.html.twig', array('form' => $form->createView()));
    }
}
