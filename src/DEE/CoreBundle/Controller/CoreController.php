<?php
    namespace DEE\CoreBundle\Controller;
    
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;
    use Symfony\Component\Form\Extension\Core\Type\TextareaType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\HttpFoundation\Request;
    
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
             //$form = $this->createForm(Swift_MessageType::class, $message);
            $form = $this->createFormBuilder($message)
                    ->add('subject', TextType::class)
                    ->add('from', TextType::class)
                    ->add('body', TextareaType::class)
                    ->add('Envoyer', SubmitType::class)
                    ->getForm();
            
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