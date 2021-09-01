<?php declare(strict_types=1); declare(strict_types=1);

namespace Src\Customers\Infrastructure\Hydrator;

use InvalidArgumentException;
use ReflectionClass;
use ReflectionException;

class ReflectionHydrator implements Hydrator
{
    private array $reflectionClasses = [];

    /**
     * @param string $className
     * @param array $data
     * @return object
     * @throws ReflectionException
     */
    public function hydrate(string $className, array $data): object
    {
        $reflection = $this->getReflectionClass($className);
        $object = $reflection->newInstanceWithoutConstructor();

        foreach ($data as $propertyName => $propertyValue) {
            if (!$reflection->hasProperty($propertyName)) {
                throw new InvalidArgumentException("No property exists '{$propertyName}' in class '{$className}'.");
            }

            $property = $reflection->getProperty($propertyName);

            if ($property->isPrivate() || $property->isProtected()) {
                $property->setAccessible(true);
            }

            $property->setValue($object, $propertyValue);
        }

        return $object;
    }

    /**
     * @param string $className
     * @return ReflectionClass
     * @throws ReflectionException
     */
    protected function getReflectionClass(string $className): ReflectionClass
    {
        if (!isset($this->reflectionClasses[$className])) {
            $this->reflectionClasses[$className] = new ReflectionClass($className);
        }

        return $this->reflectionClasses[$className];
    }

}