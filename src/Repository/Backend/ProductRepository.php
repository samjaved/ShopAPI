<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 23/10/2018
 * Time: 9:22 AM
 */

namespace App\Repository\Backend;


use App\Entity\Product;

interface ProductRepository
{
    /**
     * Use this method to find a user by id $id.
     *
     * @param string $id
     * @return Product|null
     */
    public function findOneById(string $id): ?Product;
}