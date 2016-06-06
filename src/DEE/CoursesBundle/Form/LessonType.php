<?php

namespace DEE\CoursesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use DEE\CoursesBundle\Repository\ExamRepository;


class LessonType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // Set studentID
        $student = $options['student'];
        
        // Create form builder 
        // Only display exams that belong to this user
        $builder
            ->add('date',       DateType::class)
            ->add('duration',   NumberType::class,      array('label'   => 'Durée (en minutes)'))
            ->add('comment',    TextAreaType::class,    array('label'   => 'Commentaire'))
            ->add('exam',       Entitytype::class,      array('class'           => 'DEECoursesBundle:Exam'
                                                            , 'choice_label'    => 'examFormDisplay'
                                                            , 'label'           => 'Examen concerné'
                                                            , 'expanded'        => false
                                                            , 'multiple'        => false
                                                            , 'query_builder'   => function (ExamRepository $repository) use($student) {
                                                                    return $repository->getWhereStudentQueryBuilder($student);
                                                                }    
                                                            ))
            ->add('save',       SubmitType::class,      array('label'   => 'Ajouter la leçon'))        
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'    => 'DEE\CoursesBundle\Entity\Lesson'
            , 'student'   => null
        ));
    }
}
