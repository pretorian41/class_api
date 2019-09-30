<?php

namespace App\Form;

use App\Entity\AppClass;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class AppClassType
 */
class AppClassType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'required'  => true,
            ])
            ->add('active', CheckboxType::class, [
                'required'  => true,
            ])
            ->add('creationDate', DateTimeType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd HH:mm',
                'required'  => true,
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AppClass::class,
            'csrf_protection' => false,
        ]);
    }

    /**
     * @return bool|string
     */
    public function getBlockPrefix()
    {
        return false;
    }
}
