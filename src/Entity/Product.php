<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 23/10/2018
 * Time: 12:56 AM
 */

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="products")
 * @UniqueEntity("productName")
 */
class Product extends Base
{
    public function __construct() {
        parent::__construct();
        $this->deals = new ArrayCollection();
    }
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $productName;

    /**
     * @var string
     * @Assert\Currency
     * @ORM\Column(type="string")
     */
    private $currency;
    /**
     * price
     * @ORM\Column(type="decimal",scale=2)
     */
    private $price;
    /**
     * discount
     * @ORM\Column(type="decimal",scale=2, nullable=true)
     */
    private $discount;

    /**
     * One Product has Many Deals.
     * @OneToMany(targetEntity="App\Entity\Deal", mappedBy="productA")
     */
    private $deals;

    /**
     * @return string
     */
    public function getProductName(): ?string
    {
        return $this->productName;
    }

    /**
     * @param string $productName
     */
    public function setProductName($productName): void
    {
        $this->productName = $productName;
    }


    /**
     * @return string
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency($currency): void
    {
        $this->currency = $currency;
    }
    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * @param mixed $discount
     */
    public function setDiscount($discount): void
    {
        $this->discount = $discount;
    }

}