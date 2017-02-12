<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {



        $builder
        ->add('email', EmailType::class, array('attr' => array('class' => 'form-control'),'label'=>'E-mail'))
        ->add('password', PasswordType::class, array('attr' => array('class' => 'form-control'),'label'=>'Clave'))
        ->add('isActive',CheckboxType::class,array('label'=>'Activo'))
        ->add('roll', EntityType::class, array(
        'attr' => array('class' => 'form-control'),
        'label'=>'Rol del usuario',
        // query choices from this entity
        'class' => 'AppBundle:Roll',

        'placeholder' => 'Seleccione el rol de usuario...',
        // use the User.username property as the visible option string
        'choice_label' => 'description',
        ));
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_user';
    }


}
