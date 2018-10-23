<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 23/10/2018
 * Time: 9:24 AM
 */

namespace App\Repository\Customer;


use App\Entity\Deal;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;

class ORMDealRepository implements DealRepository
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * ORMUserRepository constructor.
     * @param EntityManagerInterface $manager
     */
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }
    /**
     * @return Deal[]
     */
    public function findAll(): array
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        return $this->manager->createQueryBuilder()
            ->select('d.dealName,d.price,d.currency,productA.productName AS firstProduct,productB.productName AS secondProduct')
            ->from(Deal::class, 'd')
            ->join('d.productA','productA')
            ->join('d.productB','productB')
            ->getQuery()
            ->getResult();
    }
}