<?php

use function Pest\Laravel\getJson;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Supplier;

uses(Tests\TestCase::class, RefreshDatabase::class)->in('Feature');

it('shows a supplier successfully', function () {
    $supplier = Supplier::factory()->create();
    getJson("/api/suppliers/show/{$supplier->id}")
        ->assertOk()
        ->assertJsonFragment([
            'id' => $supplier->id,
            'name' => $supplier->name,
            'email' => $supplier->email,
        ]);
});
