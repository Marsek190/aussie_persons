<?php

namespace Customer\Infrastructure\Repository;

use Exception;
use Customer\Domain\ValueObject\Customer;
use Doctrine\ORM\EntityManagerInterface;
use Customer\Application\Repository\CustomerRepository;
use Customer\Infrastructure\Repository\Converter\CustomerConverter;

class DbCustomerRepository implements CustomerRepository
{
    private EntityManagerInterface $entityManager;
    private CustomerConverter $converter;
    private int $batchSize;

    public function __construct(EntityManagerInterface $entityManager, CustomerConverter $converter, int $batchSize)
    {
        $this->entityManager = $entityManager;
        $this->converter = $converter;
        $this->batchSize = $batchSize;
    }

    /** @inheritDoc */
    public function save(array $customers): void
    {
        $this->entityManager->beginTransaction();
        try {
            $batchOffset = 0;
            foreach ($customers as $customer) {
                if ($batchOffset % $this->batchSize === 0) {
                    $this->entityManager->flush();
                    $this->entityManager->clear();
                }

                $entity = $this->converter->convertToEntity($customer);
                $this->entityManager->persist($entity);
                $batchOffset++;
            }

            $this->entityManager->flush();
            $this->entityManager->clear();
            $this->entityManager->commit();
        } catch (Exception $e) {
            $this->entityManager->rollback();
        }
    }

    /** @inheritDoc */
    public function findAll(): array
    {
        
    }

    /** @inheritDoc */
    public function findById(int $id): Customer
    {

    }
}