<?php

use App\RestClient\RewardGatewayAPIClient;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

class RewardGatewayAPIClientTest extends \PHPUnit\Framework\TestCase
{
    public function testSuccessfulResponse()
    {
        $data = [[
            "uuid" => "19de51e7-312e-35e4-a015-63bec88bdc8c",
            "company" => "Torphy-Boyer",
            "bio" => "0",
            "name" => "Norbert Mills",
            "title" => "Pewter Caster",
            "avatar" => "http://httpstat.us/503"
        ]];
        $mock = new MockHandler([
            new Response(200, [], json_encode($data)),
        ]);
        $handler = HandlerStack::create($mock);
        $mockClient = new Client(['handler' => $handler]);
        $client = new RewardGatewayAPIClient($mockClient);
        $result = $client->fetchUsers();
        $this->assertNull($result['error']);
        $this->assertEquals(count($result['items']), 1);
    }

    public function testFailureResponse()
    {
        $mock = new MockHandler([
            new Response(500),
        ]);
        $handler = HandlerStack::create($mock);
        $mockClient = new Client(['handler' => $handler]);
        $client = new RewardGatewayAPIClient($mockClient);
        $result = $client->fetchUsers();
        $this->assertNotNull($result['error']);
        $this->assertEquals(count($result['items']), 0);
    }
}