<?php

namespace Neverlxsss\Syrve\Support;

use GuzzleHttp\Exception\GuzzleException;
use Mockery\Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class Syrve
{
    private string $token;
    private string $apiUrl;
    private string $accessToken;


    /**
     * @throws \Exception
     */
    public function __construct(string $token, string $apiUrl = "https://api-eu.syrve.live")
    {
        if (empty($token)) {
            throw new Exception("Token is required");
        }

        if (empty($apiUrl)) {
            throw new Exception("API endpoint is required");
        }

        $this->token = $token;
        $this->apiUrl = $apiUrl;
        $accessTokenResponse = $this->getAccessToken();

        if ($accessTokenResponse->success()) {
            $this->accessToken = $accessTokenResponse->body()->token;
        } else {
            throw new \Exception("Can't get access token");
        }
    }

    /**
     * Call api
     *
     */
    public function api(
        string $path,
        string $method,
        array $headers = [],
        array $params = [],
        int $timeout = 5,
    ): Response {
        $suits = array_column(Method::cases(), "value");
        // Validate request method
        if (!in_array($method, $suits, true)) {
            throw new Exception("Invalid method");
        }

        // Set access token
        if (isset($this->accessToken)) {
            $headers["Authorization"] = "Bearer {$this->accessToken}";
        }
        // Set application-json for encoded body
        $headers['content-type'] = "application/json";

        // Fill query and body
        if ($method === Method::POST->value) {
            $body = array_filter($params);
        } elseif ($method === Method::GET->value) {
            $body = [];
            if (!empty($params)) {
                $headers['query'] = $params;
            }
        } else {
            $body = $params;
        }

        // Encode body to json
        try {
            $body = json_encode($body, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            throw new \RuntimeException("Invalid body");
        }

        $client = new Client(['base_uri' => $this->apiUrl, 'timeout' => $timeout]);

        try {
            $response = $client->request($method, $path, [
                'headers' => $headers,
                'query'   => $method === Method::GET->value ? $params : null,
                'body'    => $method === Method::POST->value ? $body : null,
            ]);
        } catch (GuzzleException $e) {
            return new Response(null, null, $e->getMessage());
        }

        return new Response(
            $response->getStatusCode(),
            json_decode($response->getBody()->getContents())
        );
    }

    private function getAccessToken(): Response
    {
        $response = $this->api(
            "/api/1/access_token",
            Method::POST->value,
            [],
            [
                'apiLogin' => $this->token
            ]
        );

        return $response;
    }
}
