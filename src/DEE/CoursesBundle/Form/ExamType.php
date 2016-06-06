<?php

namespace DEE\CoursesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ExamType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date',       DateType::class,        array('label'       => 'Date d\'obtention'
                                                            , 'required'    => false))
            ->add('training',   CheckboxType::class,    array('label'       => 'En cours d\'apprentissage'
                                                            , 'required'    => false))
            ->add('success',    CheckboxType::class,    array('label'       => 'Obtenu'
                                                            , 'required'    => false))
            ->add('examType',   EntityType::class,      array('class'           => 'DEECoursesBundle:ExamType'
                                                            , 'choice_label'    => 'examLabel'
                                                            , 'label'           => 'Type d\'examen'
                                                            , 'expanded'        => false
                                                            , 'multiple'        => false))
            ->add('submit',     SubmitType::class,      array('label' => 'Ajouter l\'examen'))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DEE\CoursesBundle\Entity\Exam'
        ));
    }
}
