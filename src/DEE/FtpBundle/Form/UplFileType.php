<?php

namespace DEE\FtpBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bridge\Doctrine\Form\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FtpFileType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category',   EntityType::class,      array('class'          => 'DEEFtpBundle:FtpFileCategory'
                                                            , 'choice_label'    => 'label'
                                                            , 'label'           => 'Catégorie'
                                                            , 'expanded'        => false
                                                            , 'multiple'        => false))
            ->add('student',    EntityType::class,      array('class'          => 'DEECoursesBundle:Student'
                                                            , 'choice_label'    => 'name' .' ' .'firstname'
                                                            , 'label'           => 'Etudiant'
                                                            , 'expanded'        => false
                                                            , 'multiple'        => false))
            ->add('file',       FileType::class,        array('label' => 'Document'))
            ->add('submit',     SubmitType::class,      array('label' => 'Uploader le document'))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DEE\FtpBundle\Entity\UplFile'
        ));
    }
}
