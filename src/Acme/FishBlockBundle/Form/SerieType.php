<?php

namespace Acme\FishBlockBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class SerieType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('image', new ImageType())
            ->add('description')
            ->add('listeDesGenres')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\FishBlockBundle\Entity\Serie'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'acme_fishblockbundle_serie';
    }
}
