<?php

namespace Src\Customers\Infrastructure\DataProvider;

use Exception;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\GuzzleException;
use Src\Customers\Application\Action\Import\Command\Customer as CustomerCommand;
use Src\Customers\Application\DataProvider\CustomerDataProvider;
use Src\Customers\Application\Dto\Customer;
use Src\Customers\Application\Dto\Location;
use Src\Customers\Application\Dto\Name;

class ApiCustomerDataProvider implements CustomerDataProvider
{
    private ApiConf $apiConf;
    private ClientInterface $httpClient;
    private int $timeout;

    /**
     * @param ApiConf $apiConf
     * @param ClientInterface $httpClient
     * @param int $timeout
     */
    public function __construct(ApiConf $apiConf, ClientInterface $httpClient, int $timeout)
    {
        $this->apiConf = $apiConf;
        $this->httpClient = $httpClient;
        $this->timeout = $timeout;
    }

    /** @inheritDoc */
    public function collect(CustomerCommand $command): array
    {
        try {
            $request = new Request('GET', $this->getUrl($command));
            $response = $this->httpClient->send($request, [
                'timeout' => $this->timeout,
            ]);

            $data = json_decode($response->getBody()->getContents(), true);
            if (empty($data) || empty($data['results'])) {
                return [];
            }

            /** @var array $results */
            $results = $data['results'];

            $customers = [];
            /** @var array $result */
            foreach ($results as $result) {
                $id = (int) $result['id']['value'];
                if (isset($customers[$id])) {
                    continue;
                }

                $name = new Name(
                    $result['name']['first'],
                    $result['name']['last']
                );
                $location = new Location(
                    $result['location']['city'],
                    $result['location']['country']
                );

                $customers[$id] = new Customer(
                    $id,
                    $name,
                    $location,
                    $result['email'],
                    $result['login']['username'],
                    $result['gender'],
                    $result['phone']
                );
            }

            return $customers;
        } catch (BadResponseException $e) {
            throw new Exception($e->getResponse()->getBody()->getContents());
        } catch (Exception | GuzzleException $e) {
            throw new Exception($e->getMessage());
        }
    }

    private function getUrl(CustomerCommand $command): string
    {
        $query = http_build_query([
            'nat' => 'au',
            'results' => $command->getLimit(),
        ]);

        return sprintf(
            '%s/?%s',
            trim($this->apiConf->getBaseUrl(), '/'),
            $query
        );
    }
}