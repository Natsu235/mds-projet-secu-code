<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistartionType extends AbstractType
{
    public function getConfiguration($label, $maxlength, $required, $options = []) {
        return array_merge([
            'label' => $label,
            'attr' => [
                'maxlength' => $maxlength
            ],
            'required' => $required
        ], $options);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, $this->getConfiguration('Prénom', '64', true))
            ->add('lastName', TextType::class, $this->getConfiguration('Nom', '64', true))
            ->add('email', EmailType::class, $this->getConfiguration('Adresse email', '255', true))
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => $this->getConfiguration('Mot de passe', '64', true),
                'second_options' => $this->getConfiguration('Confirmation du mot de passe', '64', true)
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }
}
