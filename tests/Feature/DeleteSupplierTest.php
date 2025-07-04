<?php

use function Pest\Laravel\deleteJson;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Supplier;

uses(Tests\TestCase::class, RefreshDatabase::class)->in('Feature');

it('deletes a supplier successfully', function () {
    $supplier = Supplier::factory()->create();

    deleteJson("/api/suppliers/delete/{$supplier->id}")
        ->assertOk()
        ->assertJson(['message' => 'Supplier deleted successfully']);

    expect(Supplier::withTrashed()->find($supplier->id)->trashed())->toBeTrue();
});
