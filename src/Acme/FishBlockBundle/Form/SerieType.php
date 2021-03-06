<?php

namespace Acme\FishBlockBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;



class SerieType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', 'text', array('label' => 'Titre :'))
            ->add('image', ImageType::class, array('label' => 'Image (jpg, png, jpeg)', 'data_class' => null,
            'attr' => array('required' => false)))
            ->add('description')
            ->add('category')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\FishBlockBundle\Entity\Series'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'acme_fishblockbundle_serie';
    }




}
