<?php
namespace App\RestClient;
use App\DTO\User;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class RewardGatewayAPIClient
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function fetchUsers(): array {
        $result = ['error' => null, 'items' => []];
        try {
            $response = $this->client->request('GET', 'http://hiring.rewardgateway.net/list', [
                RequestOptions::HEADERS => [
                    'Accept' => 'application/json',
                ],
                RequestOptions::AUTH => ['hard', 'hard'],
            ]);

            if ($response->getStatusCode() == 200) {
                $body = $response->getBody();
                $json_body = \GuzzleHttp\json_decode($body, true);
                $result['items'] = array_map(function($user) {
                    return new User($user);
                }, $json_body);
            }
        } catch (\Exception $e) {
            $result['error'] = $e;
        }
        return $result;
    }
}