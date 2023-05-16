<?php

namespace App\Form;

use App\Entity\PersonaFisica;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class PersonaFisicaFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nome',TextType::class)
            ->add('cognome',TextType::class)
            ->add('codiceFiscale',TextType::class)
            ->add('telefono',TextType::class)
            ->add('dataNascita', DateType::class,[
                'widget'=> 'single_text',
            ])
            ->add('luogoNascita',TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PersonaFisica::class,
            'csrf_protection' => false
        ]);
    }
}
