<?php

namespace Frontend\FrontendBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Lexik\Bundle\FormFilterBundle\Filter\Form\Type as Type;

class ArticleFilterType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            //->add('createdAt', @Type\DateTimeFilterType::class)
            //->add('updatedAt', @Type\DateTimeFilterType::class)
            ->add('titre', @Type\TextFilterType::class)

            // ->add('slug', 'filter_text')
            // ->add('medias', 'filter_entity', array('class' => 'Frontend\FrontendBundle\Entity\Media'))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'        => 'Frontend\FrontendBundle\Entity\Article',
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
        return 'article_filter';
    }
}
