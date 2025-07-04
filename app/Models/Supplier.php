<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'suppliers';

   protected $fillable = [
        'cpf_cnpj',
        'type',
        'name',
        'email',
        'phone',
        'address',
        'number',
        'complement',
        'neighborhood',
        'city',
        'state',
        'zip_code',
        'notes',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];
    public function scopeFilter($query, $filters)
        {
            return $filters->apply($query);
        }
}
