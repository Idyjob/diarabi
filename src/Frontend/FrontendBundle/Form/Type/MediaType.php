<?php

namespace Frontend\FrontendBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MediaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('name')
            ->add('file','file', array(
            'data_class' => null,
            'property_path' => 'file',
             
        ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Frontend\FrontendBundle\Entity\Media',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'media';
    }
}
