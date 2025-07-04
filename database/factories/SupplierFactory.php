<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    protected $model = Supplier::class;

    public function definition(): array
    {
        return [
            'cpf_cnpj' => $this->faker->unique()->numerify('###########'),
            'type' => $this->faker->randomElement(['pf', 'pj']),
            'name' => $this->faker->unique()->company(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->streetAddress(),
            'number' => $this->faker->numberBetween(1, 9999),
            'complement' => $this->faker->optional()->secondaryAddress(),
            'neighborhood' => $this->faker->citySuffix(),
            'city' => $this->faker->city(),
            'state' => $this->faker->stateAbbr(),
            'zip_code' => $this->faker->postcode(),
            'notes' => $this->faker->optional()->sentence(),
            'active' => $this->faker->boolean(90),
        ];
    }
}
