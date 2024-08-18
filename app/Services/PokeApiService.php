<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PokeApiService
{
    protected string $baseUrl = 'https://pokeapi.co/api/v2/';

    public function getPokemon(string $name): array
    {
        $response = Http::get($this->baseUrl . 'pokemon/' . $name);

        if ($response->successful()) {
            return $response->json();
        }

        return [];
    }

    public function getRandomPokemon(): array
    {
        $randomId = rand(1, 898); // There are 898 Pokémon as of Generation 8
        return $this->getPokemon((string)$randomId);
    }
}