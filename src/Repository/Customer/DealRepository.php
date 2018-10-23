<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 23/10/2018
 * Time: 9:22 AM
 */

namespace App\Repository\Customer;


use App\Entity\Deal;


interface DealRepository
{

    /**
     * @return Deal[]
     */
    public function findAll(): array;
}