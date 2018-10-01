<?php

namespace Louvres\TicketingBundle\Form;

use Symfony\Component\Form\AbstractType;
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
            ->add('dateVisit',DateType::class)
            ->add('type',ChoiceType::class, [
                'choices' => $radioChoices,
                'expanded' => true,
                'multiple' => false,
                'data' => 1,
                ])
            ->add('quantity',IntegerType::class,array('attr'=> ['min'=> 1],'data' => 1))
            ->add('save',SubmitType::class);
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
