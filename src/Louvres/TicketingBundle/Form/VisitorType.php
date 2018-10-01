<?php

namespace Louvres\TicketingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;



class VisitorType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,['label' => 'Nom'])
            ->add('firstname',TextType::class,['label' => 'Prénom'])
            ->add('country',CountryType::class,['label' => 'Pays'])
            ->add('birthdate',BirthdayType::class,['label' => 'Date de naissance'])
            ->add('reduction',CheckboxType::class,[
                'label' => "Je bénéficie d'un tarif réduit",
                'required'=>false
            ])
            ->add('save',SubmitType::class,['label' => 'Valider']);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Louvres\TicketingBundle\Entity\Visitor'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'louvres_ticketingbundle_visitor';
    }


}
