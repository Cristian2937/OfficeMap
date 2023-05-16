<?php

namespace App\Form;

use App\Entity\Utente;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UtenteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('password')
            ->add('dataUltimoAggiornamento')
            ->add('stato')
            ->add('personaFisica',TextType::class,[
                'mapped'=>false,
            ])
            ->add('personaGiuridica')
            ->add('ruolo')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utente::class,
        ]);
    }
}
