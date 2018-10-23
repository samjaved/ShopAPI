<?php
namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;

abstract class BaseType extends AbstractType
{
    public function getBlockPrefix()
    {
        return '';
    }
}
