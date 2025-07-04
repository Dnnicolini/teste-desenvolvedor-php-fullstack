<?php

use Illuminate\Support\Str;
use function Pest\Laravel\postJson;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Supplier;

uses(Tests\TestCase::class, RefreshDatabase::class)->in('Feature');

it('creates a supplier successfully', function () {
    $payload = [
        'cpf_cnpj' => Str::random(14),
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
