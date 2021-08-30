<?php

namespace Console\Commands;

use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Src\Customers\Application\Action\Import\Command\Customer as CustomerCommand;
use Src\Customers\Application\Action\Import\Handler as CustomersImportHandler;

class CustomersImport extends Command
{
    private const CUSTOMERS_LIMIT_ARGUMENT = 'limit';
    protected static $defaultName = 'customers.import';

    private CustomersImportHandler $handler;

    public function __construct(CustomersImportHandler $handler)
    {
        parent::__construct();
        $this->handler = $handler;
    }

    /** @inheritDoc */
    protected function configure()
    {
        $this->addArgument(
            self::CUSTOMERS_LIMIT_ARGUMENT,
            InputArgument::REQUIRED,
            ''
        );
    }

    /** @inheritDoc */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $limit = (int) $input->getArgument(self::CUSTOMERS_LIMIT_ARGUMENT);
            $command = new CustomerCommand($limit);
            $added = $this->handler->handle($command);
            $output->writeln('Console command was success executed.');
            $output->writeln(sprintf('Added %s customers.', $added));

            return self::SUCCESS;
        } catch (Exception $e) {
            $output->writeln('Console command has failure.');
            $output->writeln(sprintf("Cause of fail: '%s'", $e->getMessage()));

            return self::FAILURE;
        }
    }
}