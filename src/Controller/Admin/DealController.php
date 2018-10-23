<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 23/10/2018
 * Time: 3:57 PM
 */

namespace App\Controller\Admin;


use App\Entity\Product;
use App\Form\Type\Admin\DealCreateType;
use App\Repository\Backend\ProductRepository;
use App\Request\FormRequest;
use App\Service\Admin\DealService;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Operation;
use Ramsey\Uuid\Uuid;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Form\FormInterface;
use Swagger\Annotations as SWG;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DealController
{
    /**
     * @var ProductRepository
     */
    private $repository;
    /**
     * @var DealService
     */
    private $service;

    /**
     * ProductController constructor.
     */
    public function __construct(ProductRepository $repository, DealService $dealService)
    {

        $this->repository = $repository;
        $this->service = $dealService;
    }

    /**
     * Add new Deal.
     * @param FormRequest $request
     * @return null|FormInterface
     *
     * @Operation(
     *     tags={"Deals Features"},
     *     @SWG\Parameter(
     *         name="data",
     *         in="body",
     *         @Model(type="App\Form\Type\Admin\DealCreateType")
     *     ),
     *     @SWG\Response(response=201, description="Success"),
     *     @SWG\Response(response=400, description="Validation error", @SWG\Schema(ref="#definitions/FormError")),
     *     @SWG\Response(response=404, description="Token not found")
     * )
     * @Rest\Post("/deal/create/{productAId}/{productBId}")
     * @Rest\View(statusCode=201)
     * @Security("is_granted('ROLE_RESOURCE_DEAL_CREATE')")
     */
    public function createAction(string $productAId, string $productBId, FormRequest $request): ?FormInterface
    {
        $productA = $this->getProduct($productAId);
        $productB = $this->getProduct($productBId);
        if ($request->handle(DealCreateType::class)) {

            $deal = $request->getValidData();
            $this->service->create(
                $deal, $productA, $productB
            );
            return null;

        }
        return $request->getForm();

    }

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