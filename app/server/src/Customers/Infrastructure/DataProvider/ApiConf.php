<?php declare(strict_types=1); declare(strict_types=1);

namespace Src\Customers\Infrastructure\DataProvider;

class ApiConf
{
    private string $baseUrl;

    /**
     * @param string $baseUrl
     */
    public function __construct(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }
}