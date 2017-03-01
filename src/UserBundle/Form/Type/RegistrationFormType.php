<?php

namespace UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('nom', null, array('attr' => array('class' => 'inputText')))
            ->add('prenom', null, array('attr' => array('class' => 'inputText')))
            ->add('statut', ChoiceType::class, array(
                'choices'  => array(
                    'Étudiant' => "Étudiant(e)",
                    'Salarié' => "Salarié(e)",
                    "En recherche d'emploi" => "En recherche d'emploi",
                    'Autre' => "Autre",
                )))
            ->add('dateNaissance', BirthdayType::class, array('attr' => array('class' => 'inputText'),
                'years'=>range(date('Y')-100, date('Y')),'months'=> range(1, 12), 'days'=> range(1, 31)))
            ->add('sexe', ChoiceType::class, array(
                'choices'  => array(
                    'H' => "Homme",
                    'F' => "Femme",
                    "NC" => "Non communiqué",
                )))
            ->remove('username');

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\User'
        ));
    }

    public function getName()
    {
        return 'user_registration';
    }
}