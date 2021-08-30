<?php

namespace Api\V1\Controller;

use Exception;
use Src\Customers\Application\Action\RetrieveAll\Handler as RetrieveAllHandler;
use Src\Customers\Application\Action\RetrieveById\Command\Customer as CustomerCommand;
use Src\Customers\Application\Action\RetrieveById\Handler as RetrieveByIdHandler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CustomersController extends AbstractController
{
    private RetrieveAllHandler $retrieverAll;
    private RetrieveByIdHandler $retrieverById;

    public function __construct(
        RetrieveAllHandler $retrieverAll,
        RetrieveByIdHandler $retrieverById
    ) {
        $this->retrieverAll = $retrieverAll;
        $this->retrieverById = $retrieverById;
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
        $customers = $this->retrieverAll->handle();

        return new Response(json_encode($customers), 200);
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

            return new Response(json_encode($customer), 200);
        } catch (Exception $e) {
            return new Response('Something was wrong...', 400);
        }
    }
}