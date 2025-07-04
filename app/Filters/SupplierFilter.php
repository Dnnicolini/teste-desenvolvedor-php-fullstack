<?php

namespace App\Filters;

class SupplierFilter extends QueryFilter
{
    public function cpf_cnpj($value)
    {
        $this->builder->where('cpf_cnpj', 'like', "%{$value}%");
    }

    public function name($value)
    {
        $this->builder->where('name', 'like', "%{$value}%");
    }

    public function email($value)
    {
        $this->builder->where('email', 'like', "%{$value}%");
    }

    public function phone($value)
    {
        $this->builder->where('phone', 'like', "%{$value}%");
    }

    public function state($value)
    {
        $this->builder->where('state', $value);
    }

    public function active($value)
    {
        $bool = filter_var($value, FILTER_VALIDATE_BOOLEAN);
        $this->builder->where('active', $bool);
    }

    public function type($value)
    {
        $this->builder->where('type', $value);
    }
}
