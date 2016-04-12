<?php
namespace SellDreams\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
class BasketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('quantity', 'text');// a changer en pour avoir une liste d'entier iou un truc du genre
    }

    public function getName()
    {
        return 'basket';
    }
}