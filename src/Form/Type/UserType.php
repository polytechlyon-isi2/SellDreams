<?php
namespace SellDreams\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 'text')
            ->add('userlastname', 'text')
            ->add('adress', 'text')
            ->add('postalcode', 'text')
            ->add('city', 'text')
            ->add('email', 'text') 
                
            ->add('password', 'repeated', array(
                'type'            => 'password',
                'invalid_message' => 'The password fields must match.',
                'options'         => array('required' => true),
                'first_options'   => array('label' => 'Mot de passe'),
                'second_options'  => array('label' => 'Mot de passe (confirmation)'),
            ))
            ->add('role', 'choice', array('choices' => array('ROLE_USER' => 'User')
            ));

    }

    public function getName()
    {
        return 'user';
    }
}