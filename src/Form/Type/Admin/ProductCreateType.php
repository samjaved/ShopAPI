<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 23/10/2018
 * Time: 12:14 AM
 */

namespace App\Form\Type\Admin;


use App\Entity\Product;

use App\Form\Type\BaseType;
use Symfony\Component\Finder\Comparator\NumberComparator;
use Symfony\Component\Form\Extension\Core\Type\CurrencyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductCreateType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('productName', TextType::class, ['required' => true]);
        $builder->add('price', NumberType::class, ['required' => true]);
        $builder->add('discount', NumberType::class, ['required' => false]);
        $builder->add('currency', CurrencyType::class, ['required' => false]);

    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', Product::class);
    }
}