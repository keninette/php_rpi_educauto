<?php

namespace DEE\FtpBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
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
            ->add('student',        EntityType::class,      array('class'           => 'DEECoursesBundle:Student'
                                                                , 'choice_label'    => 'formDisplay'
                                                                , 'label'           => 'Etudiant'
                                                                , 'expanded'        => false
                                                                , 'multiple'        => false
                                                                , 'required' => false
                                                            ))
            ->add('category',       EntityType::class,      array('class'           => 'DEEFtpBundle:FtpFileCategory'
                                                                , 'choice_label'    => 'label'
                                                                , 'label'           => 'Catégorie'
                                                                , 'expanded'        => false
                                                                , 'multiple'        => false
                                                                , 'required' => false
                                                            ))    
            ->add('deliveryDate',   DateType::class,    array('label' => 'Date d\'émission', 'required' => false))
            ->add('file',           FileType::class,        array('label' => 'Document', 'required' => false))    
            ->add('save',           SubmitType::class,      array('label' => 'Uploader le fichier'))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DEE\FtpBundle\Entity\FtpFile'
        ));
    }
}