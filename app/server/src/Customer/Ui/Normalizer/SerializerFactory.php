<?php

namespace Customer\Ui\Normalizer;

use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class SerializerFactory
{
    /** @return Serializer */
    public function create(): Serializer
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [
            new ObjectNormalizer(
                null,
                new CamelCaseToSnakeCaseNameConverter(),
                null,
                new PhpDocExtractor()
            ),
            new ArrayDenormalizer()
        ];

        return new Serializer($normalizers, $encoders);

    }
}