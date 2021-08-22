<?php

namespace App\Form;

use App\Entity\ContactSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,[
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeHolder' => 'Search first names ...',
                ]
            ])
            // ->add('lastname',TextType::class,[
            //     'label' => false,
            //     'required' => false,
            //     'attr' => [
            //         'placeHolder' => 'Search last names ...'
            //     ]
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ContactSearch::class,
            'method' => 'get',
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
