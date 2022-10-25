<?php

namespace Pokemon\Api;

use GuzzleHttp\Client;

abstract class BaseApi
{
    /**
     * Pokémon API base URL
     */
    public const BASE_URI = 'https://pokeapi.co/api/v2/';

    /**
     * HTTP client
     *
     * @var \GuzzleHttp\Client
     */
    protected Client $client;

    /**
     * HTTP Client constructor
     */
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => self::BASE_URI,
            'timeout' => 2.0,
        ]);
    }

    /**
     * Fetch data from API
     *
     * @param string $uri
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    protected function fetch(string $uri): array
    {
        $response = $this->client->get($uri, [
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
    }
}
