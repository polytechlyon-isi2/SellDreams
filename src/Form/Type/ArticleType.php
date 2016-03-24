<?php
namespace SellDreams\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text')
            ->add('content', 'textarea')
            ->add('categorie', 'text')
            ->add('img', 'text')
            ->add('value', 'text');
    }

    public function getName()
    {
        return 'article';
    }
}