<?php

namespace DEE\CoursesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class StudentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',           TextType::Class,    array('label' => 'Nom'))
            ->add('firstname',      TextType::Class,    array('label' => 'Prénom'))
            ->add('address',        TextType::Class,    array('label' => 'Adresse'))
            ->add('addressOther',   TextType::Class,    array('required' => false, 'label'  => 'Adresse (suite)'))
            ->add('phone',          TextType::Class,    array('label' => 'Téléphone'))
            ->add('phoneOther',     TextType::Class,    array('required' => false, 'label'  => 'Téléphone (autre)'))
            ->add('email',          TextType::Class,    array('required' => false,  'label' => 'Email'))
            ->add('save',           SubmitType::class,  array('label' => 'Créer un candidat'))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DEE\CoursesBundle\Entity\Student'
        ));
    }
}
