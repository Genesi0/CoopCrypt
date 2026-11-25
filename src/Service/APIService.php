<?php
namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class APIService
{
    private string $BaseURL = "https://api.hypixel.net/v2";
    private string $ProfilesURL = "/skyblock/profiles";
    private string $APIKey = "a96fa033-b737-4d28-b57f-68e8a8ac5270";

    public function __construct(
        private HttpClientInterface $client,
    ) {
    }

    public function fetchProfilesInfoFromUUID($uuid): array
    {
        $URL = "$this->BaseURL$this->ProfilesURL";
        $response = $this->client->request(
            'GET',
            $URL,
            [
                // these values are automatically encoded before including them in the URL
                'query' => [
                    'key' => $this->APIKey,
                    'uuid' => $uuid,
                ],
            ]
        );

        $statusCode = $response->getStatusCode();
        //$contentType = $response->getHeaders()['content-type'][0];
        //$content = $response->getContent();
        // $content = '{"id":521583, "name":"symfony-docs", ...}'
        $content = $response->toArray();
        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]

        return $content;
    }
}