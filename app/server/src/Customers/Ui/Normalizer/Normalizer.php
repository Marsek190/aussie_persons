<?php

namespace Src\Customers\Ui\Normalizer;

use Symfony\Component\Serializer\SerializerInterface;

// use in controllers
class Normalizer
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param object[] $objects
     * @return string
     */
    public function objectsToJson(array $objects): string
    {
        return $this->serializer->serialize($objects, 'json');
    }
}