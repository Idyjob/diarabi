<?php

namespace Settings\SettingsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Frontend\FrontendBundle\Form\Type\MediaType;

class ArtisteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('nom')
            ->add('prenom')
            ->add('biography',null,array('attr'=>array('class'=>'ckeditor')))
            ->add('adresse')
            ->add('telephone')


            ->add('media',  new MediaType())
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Settings\SettingsBundle\Entity\Artiste',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'artiste';
    }
}
