<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder

            ->add('nom',null,array('attr'=>array('placeholder'=>"Votre nom...")))
            ->add('email',EmailType::class,array('attr'=>array('placeholder'=>"Votre email..")))
            ->add('sujet',null,array('attr'=>array('placeholder'=>"Votre sujet...")))
            ->add('message',TextareaType::class,array('attr'=>array('placeholder'=>"Votre message...")))

        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Form\Data\Contact'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'contact';
    }

}