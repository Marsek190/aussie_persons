<?php declare(strict_types=1);

namespace Src\Customers\Ui\Factory;

use Symfony\Component\HttpFoundation\JsonResponse;

// use in controllers
class ResponseFactory
{
    /**
     * @param bool $success
     * @param string|null $error
     * @param array|null $data
     * @param int $status
     * @return JsonResponse
     */
    public function createJson(bool $success, ?string $error, ?array $data, int $status): JsonResponse
    {
        $response = new JsonResponse(json_encode([
            'success' => $success,
            'error' => $error,
            'data' => $data,
        ]), $status);

        $response->setEncodingOptions(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        return $response;
    }
}