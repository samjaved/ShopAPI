<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 23/10/2018
 * Time: 9:24 AM
 */

namespace App\Repository\Backend;


use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;

class ORMProductRepository implements ProductRepository
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
     * Use this method to find a user by id $id.
     *
     * @param string $id
     * @return Product|null
     */
    public function findOneById(string $id): ?Product
    {
        return $this->manager->createQueryBuilder()
            ->select('p')
            ->from(Product::class, 'p')
            ->where('p.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }
}