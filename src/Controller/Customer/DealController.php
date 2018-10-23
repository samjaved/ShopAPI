<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 23/10/2018
 * Time: 7:58 PM
 */

namespace App\Controller\Customer;
use Nelmio\ApiDocBundle\Annotation\Operation;
use Swagger\Annotations as SWG;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Repository\Customer\DealRepository;

class DealController
{
    /**
     * @var ProductRepository
     */
    private $repository;


    /**
     * ProductController constructor.
     */
    public function __construct(DealRepository$repository)
    {

        $this->repository = $repository;
    }
    /**
     * Retrieve a list of all deals
     * @Operation(
     *     tags={"Deals"},
     *     @SWG\Response(response=200, description="OK"),
     *     @SWG\Response(response=400, description="Deal Not Found", @SWG\Schema(ref="#definitions/FormError")),
     *     @SWG\Response(response=404, description="Token not found")
     * )
     * @Rest\Get("/deal/list")
     * @Rest\View()
     */
    public function get()
    {
        return $this->repository->findAll();
    }

}