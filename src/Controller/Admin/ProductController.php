<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 22/10/2018
 * Time: 11:56 PM
 */

namespace App\Controller\Admin;


use App\Entity\Product;
use App\Form\Type\Admin\ProductCreateType;

use App\Form\Type\Admin\ProductUpdateType;
use App\Repository\Backend\ProductRepository;
use App\Request\FormRequest;
use App\Service\Admin\ProductService;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Operation;
use Ramsey\Uuid\Uuid;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Form\FormInterface;
use Swagger\Annotations as SWG;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductController
{
    /**
     * @var ProductService
     */
    private $service;

    /**
     * @var ProductRepository
     */
    private $repository;


    /**
     * ProductController constructor.
     */
    public function __construct(ProductRepository $repository, ProductService $productService)
    {
        $this->service = $productService;
        $this->repository = $repository;
    }

    /**
     * Add new Product.
     * @param FormRequest $request
     * @return null|FormInterface
     *
     * @Operation(
     *     tags={"Product Features"},
     *     @SWG\Parameter(
     *         name="data",
     *         in="body",
     *         @Model(type="App\Form\Type\Admin\ProductCreateType")
     *     ),
     *     @SWG\Response(response=201, description="Success"),
     *     @SWG\Response(response=400, description="Validation error", @SWG\Schema(ref="#definitions/FormError")),
     *     @SWG\Response(response=404, description="Token not found")
     * )
     * @Rest\Post("/product/create")
     * @Rest\View(statusCode=201)
     * @Security("is_granted('ROLE_RESOURCE_PRODUCT_CREATE')")
     */
    public function createAction(FormRequest $request): ?FormInterface
    {
        if ($request->handle(ProductCreateType::class)) {

            $product = $request->getValidData();
            $this->service->create(
                $product
            );
            return null;
        }
        return $request->getForm();
    }

    /**
     * Update Product.
     * @param FormRequest $request
     * @return null|FormInterface
     *
     * @Operation(
     *     tags={"Product Features"},
     *     @SWG\Parameter(
     *         name="data",
     *         in="body",
     *         @Model(type="App\Form\Type\Admin\ProductUpdateType")
     *     ),
     *     @SWG\Response(response=201, description="Success"),
     *     @SWG\Response(response=400, description="Validation error", @SWG\Schema(ref="#definitions/FormError")),
     *     @SWG\Response(response=404, description="Token not found")
     * )
     * @Rest\Put("/product/update/{id}")
     * @Rest\View(statusCode=201)
     * @Security("is_granted('ROLE_RESOURCE_PRODUCT_UPDATE')")
     */
    public function updateAction(string $id, FormRequest $request): ?FormInterface
    {
        $product = $this->getProduct($id);

        if ($request->handle(ProductUpdateType::class, $product, ['method' => 'PUT'])) {
            $data = $request->getValidData();
            $this->service->update($data);
            return null;
        }
        return $request->getForm();

    }

    /**
     * @param string $id
     * @return Product
     */
    private function getProduct(string $id): Product
    {
        if (Uuid::isValid($id)) {
            $product = $this->repository->findOneById(
                Uuid::fromString($id)
            );
        } else {
            $product = null;
        }
        if ($product === null) {
            throw new NotFoundHttpException(sprintf('Product with id %s not found', $id));
        }
        return $product;
    }
}