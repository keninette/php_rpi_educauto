<?php
    namespace DEE\CoreBundle\Controller;
    
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;
    use DEE\CoreBundle\Form\MessageType;
    
    class CoreController extends Controller
    {
        
        public function indexAction()
        {
            return $this->render('DEECoreBundle:Core:index.html.twig');
        }
        
        public function contactAction(Request $request) {
            
            // Create a new email
            $message = \Swift_Message::newInstance();
            
            // Create a form to fill this email
            $form = $this->createForm(MessageType::class, $message);
            
            // If form has been filled and if it's valid, send email and redirect user to homepage ! 
            if($request->isMethod('POST')) {
                $form->handleRequest($request);
            
                if ($form->isValid()) {
                    
                    $message->setTo('keninette.bloggeusedeluxe@gmail.com'); // TODO : ask groukx
                    $this->get('mailer')->send($message);
                    
                    $request->getSession()->getFlashBag()->add('notice','Votre message a bien été envoyé, nous vous recontacterons très prochainement !');
                    
                    return $this->redirectToRoute('dee_core_home');
                }
            }
            
            // If form has not been filled already, then display it
            return $this->render('DEECoreBundle:Core:contact.html.twig', array('form' => $form->createView()));
        }
        
        public function pricesAction(Request $request) {
            $request->getSession()->getFlashBag()->add('notice','Cliquez sur une formule pour en voir le détail');
            return $this->render('DEECoreBundle:Core:prices.html.twig');
        }
    }