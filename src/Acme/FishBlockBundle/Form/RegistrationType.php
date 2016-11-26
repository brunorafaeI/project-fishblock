<?php
// src/Acme/FishBlockBundle/Form/RegistrationType.php

namespace Acme\FishBlockBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Gregwar\CaptchaBundle\Type\CaptchaType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('date_nais', BirthdayType::class, array('format' => 'ddMMyyyy', 'label' => 'Date de naissance: '))
            ->add('captcha', CaptchaType::class, array('reload' => true, 'as_url' => true))
        ;
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';

        // Or for Symfony < 2.8
        // return 'fos_user_registration';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}