<?php

use App\Models\Supplier;
use Illuminate\Testing\Fluent\AssertableJson;
use function Pest\Laravel\getJson;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class)->in('Feature');


beforeEach(function () {
    Supplier::firstOrCreate([
        'name' => 'Pessoa Física',
        'cpf_cnpj' => '11111111111',
        'type' => 'pf',
        'email' => 'pf@example.com',
        'phone' => '9991112222',
        'address' => 'Rua A',
        'number' => 10,
        'neighborhood' => 'Centro',
        'city' => 'Porto Velho',
        'state' => 'RO',
        'zip_code' => '76800000',
        'active' => true,
    ]);

    Supplier::firstOrCreate([
        'name' => 'Pessoa Jurídica',
        'cpf_cnpj' => '22222222000100',
        'type' => 'pj',
        'email' => 'pj@example.com',
        'phone' => '9992223333',
        'address' => 'Rua B',
        'number' => 20,
        'neighborhood' => 'Industrial',
        'city' => 'Rio Branco',
        'state' => 'AC',
        'zip_code' => '69900000',
        'active' => false,
    ]);
});

it('returns paginated list of suppliers', function () {
    getJson('/api/suppliers?per_page=1')
        ->assertOk()
        ->assertJsonStructure(['data', 'links', 'meta'])
        ->assertJsonCount(1, 'data');
});

it('filters by type pf', function () {
    getJson('/api/suppliers?type=pf')
        ->assertOk()
        ->assertJsonFragment(['type' => 'pf']);
});

it('filters by type pj', function () {
    getJson('/api/suppliers?type=pj')
        ->assertOk()
        ->assertJsonFragment(['type' => 'pj']);
});

it('filters by active status false', function () {
    getJson('/api/suppliers?active=false')
        ->assertOk()
        ->assertJsonFragment(['active' => false]);
});

it('filters by name', function () {
    getJson('/api/suppliers?name=Jurídica')
        ->assertOk();
});

it('filters by cpf_cnpj', function () {
    getJson('/api/suppliers?cpf_cnpj=111')
        ->assertOk();

});

it('filters by state', function () {
    getJson('/api/suppliers?state=RO')
        ->assertOk()
        ->assertJsonFragment(['state' => 'RO']);
});

it('returns empty if no supplier matches', function () {
    getJson('/api/suppliers?name=Nada')
        ->assertOk()
        ->assertJsonCount(0, 'data');
});
