<?php
/**
 * Description of SwiftMessageType
 *
 * @author kbj
 */

namespace DEE\CoreBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Swift_MessageType extends AbtractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('subject',TextType::class)
            ->add('from',  TextType::class)
            ->add('body', TextAreaType::class)
            ->add('save',SubmitType::class);
    }
    
    public function configureOptions(OptionsResolver $resolver) {
         $resolver->setDefaults(array(
             'data_class' => '\Swift_Message'
         ));
    }
}
