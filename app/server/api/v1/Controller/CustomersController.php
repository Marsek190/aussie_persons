<?php

namespace Api\V1\Controller;

use Exception;
use Src\Customers\Application\Action\RetrieveAll\Handler as RetrieveAllHandler;
use Src\Customers\Application\Action\RetrieveById\Command\Customer as CustomerCommand;
use Src\Customers\Application\Action\RetrieveById\Handler as RetrieveByIdHandler;
use Src\Customers\Application\Exception\CustomerNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CustomersController extends AbstractController
{
    private RetrieveAllHandler $retrieverAll;
    private RetrieveByIdHandler $retrieverById;

    public function __construct(RetrieveAllHandler $retrieverAll, RetrieveByIdHandler $retrieverById)
    {
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
        try {
            $customers = $this->retrieverAll->handle();

            return $this->createResponse(true, null, $customers, 200);
        } catch (Exception $e) {
            // sending $e->getMessage() in response for example
            return $this->createResponse(false, $e->getMessage(), null, 500);
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

            return $this->createResponse(true, null, $customer, 200);
        } catch (CustomerNotFoundException $e) {
            return $this->createResponse(false, 'Customer not found.', null, 400);
        } catch (Exception $e) {
            // sending $e->getMessage() in response for example
            return $this->createResponse(false, $e->getMessage(), null, 500);
        }
    }

    private function createResponse(bool $success, ?string $error, ?array $data, int $status): Response
    {
        return new Response(json_encode([
            'success' => $success,
            'error' => $error,
            'data' => $data,
        ]), $status);
    }
}