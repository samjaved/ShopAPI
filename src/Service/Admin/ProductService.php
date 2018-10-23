<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 23/10/2018
 * Time: 1:07 AM
 */

namespace App\Service\Admin;


use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;

class ProductService
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * @param EntityManagerInterface $manager
     */
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param Product $product
     */
    public function create(Product $product)
    {
        $this->manager->persist($product);
        $this->manager->flush();
    }

    /**
     * @param Product $product
     */
    public function update(Product $product)
    {
        $this->manager->persist($product);
        $this->manager->flush();
    }

    /**
     * @param Product $product
     */
    function delete(Product $product)
    {
        $this->manager->remove($product);
        $this->manager->flush();
    }

}