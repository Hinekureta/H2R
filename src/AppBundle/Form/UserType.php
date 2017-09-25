<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, ['attr' => [
                'class' => 'col-md-7 form-control',
                'placeholder' => 'Email',
            ]])
            ->add('username', TextType::class, ['attr' => [
                'class' => 'col-md-7 form-control',
                'placeholder' => 'Pseudo',
            ]])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Mot de passe', 'attr' => [
                    'class' => 'col-md-7 form-control',
                    'placeholder' => 'Mot de passe',
                ]],
                'second_options' => ['label' => 'Répétez le mot de passe', 'attr' => [
                    'class' => 'col-md-7 form-control',
                    'placeholder' => 'Répétez le mot de passe',
                ]],
            ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_user';
    }


}
