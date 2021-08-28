<?php

namespace Console\Command;

use Exception;
use App\CustomersImporter\Handler\Command\Customer;
use App\CustomersImporter\Handler\CustomersImporterHandler;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CustomersImporter extends Command
{
    private const COMMAND_ERROR_CODE = 1;
    private const COMMAND_SUCCESS_CODE = 0;

    private CustomersImporterHandler $customersImporterHandler;

    public function __construct(CustomersImporterHandler $customersImporterHandler)
    {
        parent::__construct();

        $this->customersImporterHandler = $customersImporterHandler;
    }

    public static function getDefaultName(): string
    {
        return 'app:import-customers';
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $customer = new Customer(100);
            $this->customersImporterHandler->handle($customer);
        } catch (Exception $e) {
            return self::COMMAND_ERROR_CODE;
        }

        return self::COMMAND_SUCCESS_CODE;
    }
}