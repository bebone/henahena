<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BonplanType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('titre')
            ->add('contenu')
            ->add('categorie', 'entity', array('class' => 'AppBundle:Categorie', 'property' => 'nom', 'label'=>'Catégorie'))
            ->add('superficie')
            ->add('loyer')
            ->add('prix')
            ->add('depart')
            ->add('arrivee')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Bonplan'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'bonplan_create';
    }

}