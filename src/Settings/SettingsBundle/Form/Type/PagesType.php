<?php

namespace Settings\SettingsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PagesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            // ->add('createdAt')
            // ->add('updatedAt')
            // ->add('slug')
            ->add('titre')
            ->add('contenu',null, array('attr'=>array('class'=>'ckeditor')))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Settings\SettingsBundle\Entity\Pages',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'pages';
    }
}
