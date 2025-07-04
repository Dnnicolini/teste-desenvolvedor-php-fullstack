<?php

use Illuminate\Support\Str;
use function Pest\Laravel\postJson;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Supplier;

uses(Tests\TestCase::class, RefreshDatabase::class)->in('Feature');

it('creates a supplier successfully', function () {
    $payload = [
        'cpf_cnpj' => '04014152286',
        'type' => 'pf',
        'name' => 'Supplier ' . Str::random(5),
        'email' => 'supplier' . Str::random(5) . '@example.com',
        'phone' => '9999999999',
        'address' => 'Initial Street',
        'number' => 100,
        'complement' => 'Block A',
        'neighborhood' => 'Initial Neighborhood',
        'city' => 'Initial City',
        'state' => 'RO',
        'zip_code' => '76800-000',
        'notes' => 'Initial notes',
        'active' => true,
    ];

    postJson('/api/suppliers/store', $payload)
        ->assertCreated()
        ->assertJson(['message' => 'Supplier created successfully']);

    expect(Supplier::where('cpf_cnpj', $payload['cpf_cnpj'])->exists())->toBeTrue();
});


it('creates a PJ supplier successfully', function () {
    $cnpj = '42.591.651/2116-08';

    $payload = [
        'cpf_cnpj' => $cnpj,
        'type' => 'pj',
        'name' => 'Company ' . Str::random(5),
        'email' => 'pj' . Str::random(5) . '@example.com',
        'phone' => '9998887777',
        'address' => 'Company Avenue',
        'number' => 500,
        'complement' => 'Tower 2',
        'neighborhood' => 'Business District',
        'city' => 'São Paulo',
        'state' => 'SP',
        'zip_code' => '01000-000',
        'notes' => 'PJ test supplier',
        'active' => true,
    ];

    postJson('/api/suppliers/store', $payload)
        ->assertCreated()
        ->assertJson(['message' => 'Supplier created successfully']);

    expect(Supplier::where('cpf_cnpj', $cnpj)->exists())->toBeTrue();
});