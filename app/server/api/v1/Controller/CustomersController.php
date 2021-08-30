<?php

namespace Api\V1\Controller;

use Exception;
use Src\Customers\Application\Action\RetrieveAll\Handler as RetrieveAllHandler;
use Src\Customers\Application\Action\RetrieveById\Command\Customer as CustomerCommand;
use Src\Customers\Application\Action\RetrieveById\Handler as RetrieveByIdHandler;
use Src\Customers\Application\Exception\CustomerNotFoundException;
use Src\Customers\Ui\Factory\ResponseFactory;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CustomersController extends AbstractController
{
    private RetrieveAllHandler $retrieverAll;
    private RetrieveByIdHandler $retrieverById;
    private ResponseFactory $responseFactory;

    /**
     * @param RetrieveAllHandler $retrieverAll
     * @param RetrieveByIdHandler $retrieverById
     * @param ResponseFactory $responseFactory
     */
    public function __construct(
        RetrieveAllHandler $retrieverAll,
        RetrieveByIdHandler $retrieverById,
        ResponseFactory $responseFactory
    ) {
        $this->retrieverAll = $retrieverAll;
        $this->retrieverById = $retrieverById;
        $this->responseFactory = $responseFactory;
    }

    /**
     * @Route(
     *     path="/api/v1/customers/",
     *     name="retrieve_all_customers",
     *     methods={"GET"}
     * )
     */
    public function retrieveAll(): Response
    {
        try {
            $customers = $this->retrieverAll->handle();

            return $this->responseFactory->createJson(true, null, $customers, 200);
        } catch (Exception $e) {
            // sending $e->getMessage() in response for example
            return $this->responseFactory->createJson(false, $e->getMessage(), null, 500);
        }
    }

    /**
     * @Route(
     *     path="/api/v1/customers/{id}/",
     *     name="retrieve_by_id_customer",
     *     methods={"GET"},
     *     requirements={"id"="\d+"}
     * )
     */
    public function retrieveById(int $id): Response
    {
        try {
            $command = new CustomerCommand($id);
            $customer = $this->retrieverById->handle($command);

            return $this->responseFactory->createJson(true, null, $customer, 200);
        } catch (CustomerNotFoundException $e) {
            return $this->responseFactory->createJson(false, 'Customer not found.', null, 400);
        } catch (Exception $e) {
            // sending $e->getMessage() in response for example
            return $this->responseFactory->createJson(false, $e->getMessage(), null, 500);
        }
    }
}