<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 23/10/2018
 * Time: 6:53 PM
 */

namespace App\Controller\Customer;


use App\Repository\Backend\ProductRepository;
use Nelmio\ApiDocBundle\Annotation\Operation;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Swagger\Annotations as SWG;
use FOS\RestBundle\Controller\Annotations as Rest;

class ProductController
{
    /**
     * @var ProductRepository
     */
    private $repository;


    /**
     * ProductController constructor.
     */
    public function __construct(ProductRepository $repository)
    {

        $this->repository = $repository;
    }
    /**
     * Retrieve a list of all Products
     * @Operation(
     *     tags={"Products"},
     *     @SWG\Response(response=200, description="OK"),
     *     @SWG\Response(response=400, description="Product Not Found", @SWG\Schema(ref="#definitions/FormError")),
     *     @SWG\Response(response=404, description="Token not found")
     * )
     * @Rest\Get("/product/list")
     * @Rest\View()
     */
    public function get()
    {
        return $this->repository->findAll();
    }
}