<?php

namespace App\Rules;

use Closure;
use App\Services\QueryApiService;
use Illuminate\Contracts\Validation\ValidationRule;

class CpfCnpjApiValidation implements ValidationRule
{
    protected string $type;
    protected QueryApiService $queryApi;

    public function __construct(string $type)
    {
        $this->type = $type;
        $this->queryApi = app(QueryApiService::class);
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $cleaned = preg_replace('/\D/', '', $value);

        if ($this->type === 'pf') {
            if (!$this->isValidCpf($cleaned)) {
                $fail('The CPF is invalid.');
            }
        }

        if ($this->type === 'pj') {
            $data = $this->queryApi->searchCnpj($cleaned);

            if (!$data || isset($data['message'])) {
                $fail('CNPJ not found in BrasilAPI.');
                return;
            }

            if (strtoupper($data['descricao_situacao_cadastral'] ?? '') !== 'ATIVA') {
                $fail('The CNPJ is inactive.');
            }
        }
    }

    private function isValidCpf(string $cpf): bool
    {
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        if (strlen($cpf) !== 11 || preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            $sum = 0;
            for ($i = 0; $i < $t; $i++) {
                $sum += $cpf[$i] * (($t + 1) - $i);
            }

            $digit = (10 * $sum) % 11;
            $digit = $digit === 10 ? 0 : $digit;

            if ((int)$cpf[$t] !== $digit) {
                return false;
            }
        }

        return true;
    }
}
