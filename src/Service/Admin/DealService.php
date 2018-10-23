<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 23/10/2018
 * Time: 4:35 PM
 */

namespace App\Service\Admin;


use App\Entity\Deal;
use App\Entity\Product;
use App\Form\Type\Admin\DealCreateType;
use Doctrine\ORM\EntityManagerInterface;

class DealService
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
     * @param Deal $deal
     */
    public function create(Deal $deal,Product $productA,Product $productB)
    {
        $deal->setProductA($productA);
        $deal->setProductB($productB);
        $this->manager->persist($deal);
        $this->manager->flush();
    }

    /**
     * @param Deal $deal
     */
    public function update(Deal $deal)
    {
        $this->manager->persist($deal);
        $this->manager->flush();
    }

    /**
     * @param Deal $deal
     */
    function delete(Deal $deal)
    {
        $this->manager->remove($deal);
        $this->manager->flush();
    }
}