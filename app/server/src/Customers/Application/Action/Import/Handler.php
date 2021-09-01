<?php declare(strict_types=1);

namespace Src\Customers\Application\Action\Import;

use Exception;
use Src\Customers\Application\Repository\CustomerRepository;
use Src\Customers\Application\Action\Import\Command\Customer as CustomerCommand;
use Src\Customers\Application\DataProvider\CustomerDataProvider;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class Handler
{
    private CustomerDataProvider $customerDataProvider;
    private CustomerRepository $customerRepo;
    private ValidatorInterface $validator;

    public function __construct(
        CustomerDataProvider $customerDataProvider,
        CustomerRepository $customerRepo,
        ValidatorInterface $validator
    ) {
        $this->customerDataProvider = $customerDataProvider;
        $this->customerRepo = $customerRepo;
        $this->validator = $validator;
    }

    /**
     * @param CustomerCommand $command
     * @return int
     * @throws Exception
     */
    public function handle(CustomerCommand $command): int
    {
        $errors = $this->validator->validate($command);
        if (count($errors) !== 0) {
            throw new Exception($errors->get(0)->getMessage());
        }

        $customers = $this->customerDataProvider->collect($command);
        $this->customerRepo->save($customers);

        return count($customers);
    }
}