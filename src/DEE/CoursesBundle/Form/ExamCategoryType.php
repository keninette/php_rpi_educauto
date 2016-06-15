<?php

namespace DEE\CoursesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class ExamCategoryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code',           TextType::class)
            ->add('label',          textType::class,    array('label' => 'Libellé'))
            ->add('requiredAge',    numberType::class,  array('label' => 'Âge minimum requis'))
            ->add('validityPeriod', numberType::class,  array('label' => 'Période de validité (en années)', 'required' => false))
            ->add('save',           submitType::class,  array('label' => 'Créer le type d\'examen'))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DEE\CoursesBundle\Entity\ExamCategory'
        ));
    }
}
