<?php
/**
 * Created by PhpStorm.
 * User: Delphine_Corneil
 * Date: 18/10/2018
 * Time: 11:32
 */

namespace Louvres\TicketingBundle\Form;

use Louvres\TicketingBundle\DTO\ContactDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class ContactType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Votre nom',
                'attr' => [
                    'minLength' => 2,
                    'maxLength' => 40
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Votre adresse mail'
            ])
            ->add('title', TextType::class, [
                'label' => 'Objet du message',
                'attr' => [
                    'minLength' => 2,
                    'maxLength' => 100
                ]
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Votre message',
                'attr' => [
                    'maxLength' => 400
                ]
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ContactDTO::class,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'louvres_ticketing_contact';
    }
}