<?php

namespace App\Form;

use App\Entity\Mensaje;
use App\Entity\Banda;
use App\Entity\User;
use App\Entity\Modo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class AddMensajeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fecha',DateTimeType::class)
            ->add('juez', ChoiceType::class)
            ->add('user', IntegerType::class)
            ->add('banda', EntityType::class,[
                'class'=>Banda::class,
                'choice_label'=>function($banda){
                    return $banda->getMin().'-'.$banda->getMax();
                },
                'multiple'=>true,
                'expanded'=>true,
            ])
            ->add('modo', ChoiceType::class)
            ->add('guardar', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Mensaje::class,
        ]);
    }
}
