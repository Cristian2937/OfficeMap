<?php

namespace App\Form;

use App\Entity\Utente;
use App\Enum\StatoWorkflow;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UtentiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            /*->add('password')
            ->add('dataUltimoAggiornamento')*/
            ->add('stato',ChoiceType::class,[
                'choices'=>[StatoWorkflow::ATTIVO->name=>2,
                    StatoWorkflow::NON_ATTIVO->name=>3,
                    StatoWorkflow::ATTESA_DI_APPROVAZIONE->name =>4,
                ],
            ])
            /*->add('personaFisica',TextType::class,[
                'mapped'=>false,
            ])*/
            /*->add('personaGiuridica')*/
            ->add('ruolo'/*, ChoiceType::class,[
                'choices' =>['ROLE_ADMIN'=>'ROLE_ADMIN',
                    'ROLE_COORD'=>'ROLE_COORD',
                    'ROLE_USER'=>'ROLE_USER',
                    'ROLE_GUEST'=> 'ROLE_GUEST'
                ]
            ]*/)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utente::class,
        ]);
    }
}
