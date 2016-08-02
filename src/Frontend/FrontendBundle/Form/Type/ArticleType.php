<?php

namespace Frontend\FrontendBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder


            ->add('titre')
            ->add('contenu',null, array('attr'=>array('class'=>'ckeditor')))

            // ->add('medias')

            ->add('medias', 'collection', array(
            'type' => new MediaType(),

            'allow_add' => true,
            'allow_delete' => true,
           
            'prototype' => true,
            // 'by_reference'=> false,
            'attr'=>array('class'=>'mediacollection')
        ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Frontend\FrontendBundle\Entity\Article',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'article';
    }
}
