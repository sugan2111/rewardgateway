<?php
namespace App\RestClient;

use App\DTO\User;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class RewardGatewayAPIClient
{
    public function fetchUsers(): array {
        $client = new Client();
        $result = ['error' => null, 'items' => []];
        try {
            $response = $client->request('GET', 'http://hiring.rewardgateway.net/list', [
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