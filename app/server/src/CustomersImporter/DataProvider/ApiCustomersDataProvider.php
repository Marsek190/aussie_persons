<?php

namespace App\CustomersImporter\DataProvider;

use Exception;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\GuzzleException;
use App\CustomersImporter\Handler\Command\Customer;
use App\CustomersImporter\Handler\Dto\Customer as CustomerDto;

class ApiCustomersDataProvider implements CustomersDataProvider
{
    private ApiConf $apiConf;
    private ClientInterface $httpClient;
    private int $timeout;

    public function __construct(ApiConf $apiConf, ClientInterface $httpClient, int $timeout)
    {
        $this->apiConf = $apiConf;
        $this->httpClient = $httpClient;
        $this->timeout = $timeout;
    }

    /** @inheritDoc */
    public function collect(Customer $customer): array
    {
        try {
            $request = new Request('GET', $this->getUrl($customer));
            $response = $this->httpClient->send($request, [
                'timeout' => $this->timeout,
            ]);

            $data = json_decode($response->getBody()->getContents(), true);
            if (empty($data) || empty($data['results'])) {
                return [];
            }

            $results = $data['results'];

            $customers = [];
            foreach ($results as $result) {
                $customers[] = new CustomerDto(
                    (int) $result['id'],
                    $result[''],
                    $result[''],
                    $result[''],
                    $result['']
                );
            }

            return $customers;
        } catch (BadResponseException $e ) {
            throw new Exception($e->getResponse()->getBody()->getContents());
        } catch (Exception | GuzzleException $e) {
            throw new Exception($e->getMessage());
        }
    }

    private function getUrl(Customer $customer): string
    {
        $query = http_build_query([
            'nat' => 'au',
            'results' => $customer->getQuantity(),
        ]);

        return sprintf(
            '%s/?%s',
            trim($this->apiConf->getBaseUrl(), '/'),
            $query
        );
    }
}