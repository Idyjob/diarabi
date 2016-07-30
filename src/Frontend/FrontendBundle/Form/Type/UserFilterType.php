<?php
 namespace Frontend\FrontendBundle\Form\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Lexik\Bundle\FormFilterBundle\Filter\Query\QueryInterface;
use Lexik\Bundle\FormFilterBundle\Filter\Form\Type as Type;
class UserFilterType extends AbstractType {

   public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $builder
                ->add('username', @Type\TextFilterType::class, array('label' => "Nom d'utilisateur"))
                ->add('email', @Type\TextFilterType::class, array('label' => 'E-mail'))
                ->add('enabled', @Type\BooleanFilterType::class, array('label' => 'Autorisé'))
                ->add('groups', @Type\EntityFilterType::class, array(
                    'label' => 'Groupes',
                    'class' => 'Frontend\FrontendBundle\Entity\Group',
                    'expanded' => true,
                    'multiple' => true,
                    'attr'=>array('class'=>'chosen'),
                    'apply_filter' => function (QueryInterface $filterQuery, $field, $values) {
                        $query = $filterQuery->getQueryBuilder();
                        $query->leftJoin($field, 'm');
                        // Filter results using orWhere matching ID
                        foreach ($values['value'] as $value) {
                            $query->orWhere($query->expr()->in('m.id', $value->getId()));
                        }
                    },
                ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Frontend\FrontendBundle\Entity\User',
            'csrf_protection' => false,
            'validation_groups' => array('filter'),
            'method' => 'GET',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName() {
        return 'user_filter';
    }
}
