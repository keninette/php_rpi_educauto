<?php

namespace DEE\FtpBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
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
            ->add('label',                  TextType::class,        array('label'       => 'Libellé'))
            ->add('nbOfCopies',             NumberType::class,      array('label'       => 'Nombre de copies nécessaires'))
            ->add('validityPeriod',         NumberType::class,      array('label'       => 'Période de validité (en années)'))
            ->add('ftpDirectory',           TextType::class,        array('label'       => 'Répertoire dans le FTP'))
            ->add('authorizedExtensions',   ChoiceType::class,      array('label'       => 'Extensions autorisées'
                                                                        , 'multiple'    => true
                                                                        , 'expanded'    => true
                                                                        , 'choices'     => array('JPG'  => 'jpg'
                                                                                                ,'JPEG' => 'jpeg'
                                                                                                ,'PNG'  => 'png'
                                                                                                ,'PDF'  => 'pdf'
                                                                                                )  
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
