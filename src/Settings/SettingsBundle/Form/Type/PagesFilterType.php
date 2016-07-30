<?php

namespace Settings\SettingsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Lexik\Bundle\FormFilterBundle\Filter\Form\Type as Type;

class PagesFilterType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('createdAt', @Type\DateFilterType::class)
            ->add('updatedAt', @Type\DateFilterType::class)
           ->add('slug', @Type\TextFilterType::class)
           ->add('titre', @Type\TextFilterType::class)
           ->add('contenu', @Type\TextFilterType::class)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'        => 'Settings\SettingsBundle\Entity\Pages',
            'csrf_protection'   => false,
            'validation_groups' => array('filter'),
            'method'            => 'GET',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'pages_filter';
    }
}
