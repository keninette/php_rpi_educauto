<?php
/**
 * Description of SwiftMessageType
 *
 * @author kbj
 */

namespace DEE\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MessageType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('subject',    TextType::class)
            ->add('from',       TextType::class)
            ->add('body',       TextAreaType::class)
            ->add('save',       SubmitType::class,      array('label' => 'Envoyer'));
    }
    
    public function configureOptions(OptionsResolver $resolver) {
         $resolver->setDefaults(array(
             'data_class' => '\Swift_Message'
         ));
    }
}
