<?php

namespace Acme\FishBlockBundle\Form;

use Gregwar\CaptchaBundle\Type\CaptchaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProposerType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomSerie','text', array('label' => 'Nom de la série :'))
            ->add('image', FileType::class, array('label' => 'Image (jpg, png, jpeg)', 'data_class' => null, 'required' => false))
            ->add('category')
            ->add('description', TextareaType::class, array('label' => 'Description :','required' => false))
            ->add('captcha', CaptchaType::class)
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\FishBlockBundle\Entity\Proposer'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'acme_fishblockbundle_proposer';
    }


}
