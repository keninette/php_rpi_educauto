<?php

namespace DEE\FtpBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FtpFileCategoryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('label',                  TextType::class,        array('label'       => 'Libellé', 'required' => false))
            ->add('nbOfCopies',             TextType::class,        array('label'       => 'Nombre de copies nécessaires', 'required' => false))
            ->add('validityPeriod',         TextType::class,        array('label'       => 'Période de validité (en années)', 'required' => false))
            ->add('ftpDirectory',           TextType::class,        array('label'       => 'Répertoire dans le FTP (docs/nomDuRepertoire/', 'required' => false))
            ->add('authorizedExtensions',   ChoiceType::class,      array('label'       => 'Extensions autorisées'
                                                                        , 'multiple'    => true
                                                                        , 'expanded'    => true
                                                                        , 'choices'     => array('JPG'  => 'jpg'
                                                                                                ,'JPEG' => 'jpeg'
                                                                                                ,'PNG'  => 'png'
                                                                                                ,'PDF'  => 'pdf'
                                                                                                ) 
                                                                        , 'required' => false
                                                                        ))
            ->add('submit',                 SubmitType::class,      array('label' => 'Ajouter la catégorie'))    
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DEE\FtpBundle\Entity\FtpFileCategory'
        ));
    }
}
