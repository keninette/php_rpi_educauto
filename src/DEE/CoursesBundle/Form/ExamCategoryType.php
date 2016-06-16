<?php

namespace DEE\CoursesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

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
            ->add('label',          TextType::class,    array('label' => 'Libellé', 'required' => false))
            ->add('requiredAge',    TextType::class,    array('label' => 'Âge minimum requis', 'required' => false))
            ->add('validityPeriod', TextType::class,    array('label' => 'Période de validité (en années)', 'required' => false))
            ->add('save',           submitType::class,  array('label' => 'Créer le type d\'examen', 'required' => false))
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
