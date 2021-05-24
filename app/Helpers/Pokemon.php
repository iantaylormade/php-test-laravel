<?php

namespace App\Helpers;

use GuzzleHttp\Client;

class Pokemon {

    private $client;
    private static $apiEndpoint = 'https://pokeapi.co/api/v2/';

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => self::$apiEndpoint,
            'verify' => config('app.debug') ? false : true
        ]);
    }

    public function find($name)
    {
        return $this->get('pokemon/' . $name);
    }

    public function all()
    {
        $firstPokemon = $this->get('pokemon?limit=1');

        if(is_null($firstPokemon)){
           return null;
        }

        $remainingCount = $firstPokemon->count - 1;
        $remainingPokemon = $this->get("pokemon?limit=$remainingCount&offset=1");

        if(is_null($remainingPokemon)){
            return null;
        }

        return array_merge($firstPokemon->results, $remainingPokemon->results);
    }

    private function get($endpoint)
    {
        try {
            $response = $this->client->request('GET', $endpoint);
            $contents = $response->getBody()->getContents();
            return json_decode($contents);
        } catch (\Exception $e){
            return null;
        }
    }

}
