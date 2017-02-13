<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;



class CustomerType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nombre', TextType::class, array('attr' => array('class' => 'form-control'),'label'=>'Nombre'))
        ->add('apellido', TextType::class, array('attr' => array('class' => 'form-control'),'label'=>'Apellido'))
        ->add('cedula', TextType::class, array('attr' => array('class' => 'form-control'),'label'=>'Cedula'))
        ->add('celular', TextType::class, array('attr' => array('class' => 'form-control'),'label'=>'Celular'))
        ->add('email', EmailType::class, array('attr' => array('class' => 'form-control'),'label'=>'E-mail'))
        ->add('numeroRegistro', TextType::class, array('attr' => array('class' => 'form-control'),'label'=>'NumeroRegistro'))
        ->add('descargarCertificado', ChoiceType::class, array(
            'attr' => array('class' => 'form-control'),
                'choices'  => array(
                    'El cliente puede descargar el certificado' => '',
                    'Si' => 1,
                    'No' => 0,
        ),
                
            ))

            ->add('fecha_curso', DateType::class, array(
                'widget' => 'single_text',
                // do not render as type="date", to avoid HTML5 date pickers
                'html5' => false,

                // add a class that can be selected in JavaScript
                'attr' => ['class' => 'form-control datepicker'],
            ))

        ->add('nivel_certificado', EntityType::class, array(
        'attr' => array('class' => 'form-control'),
        'label'=>'Nivel del certificado',
        // query choices from this entity
        'class' => 'AppBundle:Nivel_certificado',

        'placeholder' => 'Seleccione el nivel de certificado...',
        // use the User.username property as the visible option string
        'choice_label' => 'descripcion',
        ));        

        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Customer'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_customer';
    }


}
