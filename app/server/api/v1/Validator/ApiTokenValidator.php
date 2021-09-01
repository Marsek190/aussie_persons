<?php declare(strict_types=1);

namespace Api\V1\Validator;

use Symfony\Component\HttpFoundation\Request;

class ApiTokenValidator
{
    private string $apiToken;

    /**
     * @param string $apiToken
     */
    public function __construct(string $apiToken)
    {
        $this->apiToken = $apiToken;
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function validate(Request $request): bool
    {
        return $this->apiToken === $request->headers->get('X-Api-Token');
    }
}