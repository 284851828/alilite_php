<?php

class GatewaySdk
{
    private $appId;
    private $httpClient;

    public function __construct(string $appId)
    {
        $this->appId = $appId;
        $this->httpClient = new \GuzzleHttp\Client();
    }

    public function post(string $endpoint, array $payload): void
    {
        $jsonPayload = json_encode($payload);

        $options = [
            'headers' => [
                'Content-Type' => 'application/json',
                'X-Gateway-AppId' => $this->appId,
            ],
            'body' => $jsonPayload,
        ];

        try {
            $response = $this->httpClient->request('POST', "https://open.xiadandt.com/$endpoint", $options);
            if ($response->getStatusCode() !== 200) {
                throw new \RuntimeException("Unexpected response status code: " . $response->getStatusCode());
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            throw new \RuntimeException("Failed to send POST request: " . $e->getMessage());
        }
    }
}