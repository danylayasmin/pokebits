<?php

namespace App\Traits;

trait HandlesPokeAPIResponse
{
    protected function checkResponse($response): bool
    {
        if ($response->getStatusCode() !== 200) {
            $this->error('Failed to fetch data from PokeAPI.');
            return false;
        }

        return true;
    }

}
