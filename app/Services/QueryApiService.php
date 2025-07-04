<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Client\RequestException;

class QueryApiService
{
    protected string $baseUrl = 'https://brasilapi.com.br/api';

    public function searchCep(string $cep): array|null
    {
        try {
            $response = Http::timeout(5)
                ->retry(3, 100)
                ->get("{$this->baseUrl}/cep/v1/{$cep}");

            if ($response->successful()) {
                return $response->json();
            }

            Log::warning('BrasilAPI request failed: ' . $response->body());
        } catch (RequestException $e) {
            Log::error('BrasilAPI exception: ' . $e->getMessage());
        }

        return null;
    }

    public function getStates(): array|null
    {
        try {
            $response = Http::timeout(5)
                ->retry(3, 100)
                ->get("{$this->baseUrl}/ibge/estados/v1");

            if ($response->successful()) {
                return $response->json();
            }

            Log::warning('BrasilAPI request failed: ' . $response->body());
        } catch (RequestException $e) {
            Log::error('BrasilAPI exception: ' . $e->getMessage());
        }

        return null;
    }
    public function getCities(string $uf): array|null
    {
        try {
            $response = Http::timeout(5)
                ->retry(3, 100)
                ->get("{$this->baseUrl}/ibge/municipios/v1/{$uf}");

            if ($response->successful()) {
                return $response->json();
            }

            Log::warning('BrasilAPI request failed: ' . $response->body());
        } catch (RequestException $e) {
            Log::error('BrasilAPI exception: ' . $e->getMessage());
        }

        return null;
    }

    public function searchCnpj(string $cnpj): array|null
    {
        try {
            $response = Http::timeout(5)
                ->retry(3, 100)
                ->get("{$this->baseUrl}/cnpj/v1/{$cnpj}");

            if ($response->successful()) {
                return $response->json();
            }

            Log::warning('BrasilAPI request failed: ' . $response->body());
        } catch (RequestException $e) {
            Log::error('BrasilAPI exception: ' . $e->getMessage());
        }

        return null;
    }
}
