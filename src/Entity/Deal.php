<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 23/10/2018
 * Time: 3:24 PM
 */

namespace App\Entity;


use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="deals")
 */
class Deal extends Base
{

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $dealName;

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
     * Many Deals have One Product.
     * @ManyToOne(targetEntity="Product", inversedBy="deals")
     * @JoinColumn(name="productA_id", referencedColumnName="id")
     */
    private $productA;

    /**
     * Many Deals has One Product.
     * @ManyToOne(targetEntity="Product", inversedBy="deals")
     * @JoinColumn(name="productB_id", referencedColumnName="id")
     */
    private $productB;

    /**
     * @return string
     */
    public function getDealName(): ?string
    {
        return $this->dealName;
    }

    /**
     * @param string $dealName
     */
    public function setDealName(string $dealName): void
    {
        $this->dealName = $dealName;
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
    public function setCurrency(string $currency): void
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
    public function getProductA()
    {
        return $this->productA;
    }

    /**
     * @param mixed $productA
     */
    public function setProductA($productA): void
    {
        $this->productA = $productA;
    }

    /**
     * @return mixed
     */
    public function getProductB()
    {
        return $this->productB;
    }

    /**
     * @param mixed $productB
     */
    public function setProductB($productB): void
    {
        $this->productB = $productB;
    }

}