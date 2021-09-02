<?php

namespace Src\Customers\Infrastructure\Repository;

use Exception;
use Src\Customers\Application\Exception\CustomerNotFoundException;
use Doctrine\ORM\EntityRepository;
use Src\Customers\Application\Dto\Customer;
use Doctrine\ORM\EntityManagerInterface;
use Src\Customers\Application\Repository\CustomerRepository;
use Src\Customers\Infrastructure\Repository\Converter\CustomerConverter;
use Src\Customers\Infrastructure\Repository\Entity\Customer as CustomerEntity;

class DbCustomerRepository implements CustomerRepository
{
    private EntityManagerInterface $entityManager;
    private CustomerConverter $converter;
    private EntityRepository $entityRepo;
    private int $batchSize;

    /**
     * @param EntityManagerInterface $entityManager
     * @param CustomerConverter $converter
     * @param int $batchSize
     */
    public function __construct(EntityManagerInterface $entityManager, CustomerConverter $converter, int $batchSize)
    {
        $this->entityManager = $entityManager;
        $this->converter = $converter;
        $this->batchSize = $batchSize;
        $this->entityRepo = $this->entityManager->getRepository(CustomerEntity::class);
    }

    /** @inheritDoc */
    public function save(array $customers): void
    {
        if (empty($customers)) {
            return;
        }

        $this->entityManager->beginTransaction();
        try {
            $entities = $this->getEntitiesForPersists($customers);

            $batchOffset = 0;
            foreach ($entities as $entity) {
                if ($batchOffset % $this->batchSize === 0) {
                    $this->entityManager->flush();
                    $this->entityManager->clear();
                }

                $this->entityManager->merge($entity);
                $batchOffset++;
            }

            $this->entityManager->flush();
            $this->entityManager->clear();
            $this->entityManager->commit();
        } catch (Exception $e) {
            $this->entityManager->rollback();
            throw $e;
        }
    }

    /** @inheritDoc */
    public function findAll(): array
    {
        /** @var CustomerEntity[] $entities */

        $entities = $this->entityRepo->findAll();
        $customers = [];
        foreach ($entities as $entity) {
            $customers[] = $this->converter->convertToDto($entity);
        }

        return $customers;
    }

    /** @inheritDoc */
    public function findById(int $id): Customer
    {
        $entity = $this->entityRepo->find($id);
        if ($entity === null) {
            throw new CustomerNotFoundException();
        }

        return $this->converter->convertToDto($entity);
    }

    /**
     * @param Customer[] $customers
     * @return CustomerEntity[]
     */
    private function getEntitiesForPersists(array $customers): array
    {
        /** @var int $customerOffset */
        /** @var CustomerEntity[] $result */
        /** @var CustomerEntity[] $entities */

        $emails = array_flip(
            array_map(fn (Customer $customer) => $customer->getEmail(), $customers)
        );
        $entities = $this->entityRepo->findBy(['email' => $emails]);

        $result = [];
        foreach ($entities as $entity) {
            if (isset($emails[$entity->email])) {
                $customerOffset = $emails[$entity->email];
                $result[] = $this->converter->convertToNewEntityState($entity, $customers[$customerOffset]);
                unset($customers[$customerOffset]);
            }
        }

        foreach ($customers as $customer) {
            $result[] = $this->converter->convertToEntity($customer);
        }

        return $result;
    }
}