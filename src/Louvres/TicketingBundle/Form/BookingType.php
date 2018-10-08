<?php

namespace Louvres\TicketingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookingType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $radioChoices = [
            'Journée' => '1',
            'Demi-journée' => '0'
        ];

        $builder
            ->add('name',TextType::class,['label' => 'Renseigner votre nom'])
            ->add('email',EmailType::class,['label' => 'Renseigner votre adresse mail'])
            ->add('dateVisit',DateType::class,[
                'label' => 'Choisissez une date',
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'dd/MM/yyyy',
                'attr' => ['class' => 'datepicker']
                ])
            ->add('type',ChoiceType::class, [
                'choices' => $radioChoices,
                'expanded' => true,
                'multiple' => false,
                'label' => 'Choisissez un type de billet',
                ])
            ->add('quantity',IntegerType::class,[
                'attr'=> ['min'=> 1,'max'=> 10],
                'label' => 'Nombre de visiteur',
                ])
            ->add('save',SubmitType::class,['label' => 'Valider']);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Louvres\TicketingBundle\Entity\Booking'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'louvres_ticketingbundle_booking';
    }


}
