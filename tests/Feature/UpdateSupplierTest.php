<?php

use Illuminate\Support\Str;
use function Pest\Laravel\putJson;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Supplier;

uses(Tests\TestCase::class, RefreshDatabase::class)->in('Feature');

it('updates a supplier successfully', function () {
    $cpf = '05013154200';

    $supplier = Supplier::factory()->create([
        'cpf_cnpj' => $cpf,
        'email' => 'original' . Str::random(4) . '@example.com',
        'name' => 'Original Name',
    ]);

    $updated = [
        'cpf_cnpj' => $cpf,
        'type' => 'pf',
        'name' => 'Updated Name',
        'email' => 'updated' . Str::random(4) . '@example.com',
        'phone' => '8888888888',
        'address' => 'Updated Address',
        'number' => 200,
        'complement' => 'Suite B',
        'neighborhood' => 'Updated Neighborhood',
        'city' => 'Updated City',
        'state' => 'AC',
        'zip_code' => '69900-000',
        'notes' => 'Updated notes',
        'active' => false,
    ];

    putJson("/api/suppliers/update/{$supplier->id}", $updated)
        ->assertOk()
        ->assertJson(['message' => 'Supplier updated successfully']);

    $supplier->refresh();

    expect($supplier->name)->toBe('Updated Name');
    expect($supplier->email)->toBe($updated['email']);
});
