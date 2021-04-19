<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Unique;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // definition de la liste des années
        $years = range( date('Y')-100 , date('Y')-18 );
        rsort($years);


        $builder

            // Email
            ->add('email', EmailType::class, [
                'label' => "Votre adresse email",
                'required' => true,
                'attr' => [
                    'placeholder' => "Saisir votre adresse email"
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => "L'adresse email est obligatoire."
                    ]),
                    new Email([
                        'message' => "L'adresse email n'est pas valide."
                    ]),
                    new Unique([
                        'message' => "L'adresse email est deja utilisée."
                    ])
                ]
            ])









            // Firstname
            ->add('firstname', TextType::class, [
                'label' => "Votre prénom",
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => "Ce champ est obligatoire"
                    ])
                ]
            ])

            // Lastname
            ->add('lastname', TextType::class, [
                'label' => "Votre NOM",
                'required' => true,
                'attr' => [
                    'placeholder' => "Ceci est le placeholder du champ lastname"
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => "Ce champ est obligatoire"
                    ])
                ]
                ])

            // Birthday
            ->add('birthday', BirthdayType::class, [
                'label' => "Votre date de naissance",
                'required' => true,

                // Placeholder des champs <select>
                'placeholder' => [
                    'year' => "Année",
                    'month' => "Mois",
                    'day' => "Jour",
                ],

                // Liste des options du champ <select> "Year"
                'years' => $years,



                'constraints' => [
                    new NotBlank([
                        'message' => "Ce champ est obligatoire"
                    ])
                ]
            ])








            // Agree Terms
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])

            // Password
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
