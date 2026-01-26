<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Contract;
use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contract>
 */
class ContractFactory extends Factory
{
    // Force Spanish locale for tenant names
    // public function __construct()
    // {
    //     parent::__construct();
    //     $this->faker = \Faker\Factory::create('es_ES');
    // }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $monthlyRent = $this->faker->randomFloat(2, 600, 2000);
        $legalDeposit = $monthlyRent;
        $additionalDeposit = $monthlyRent;

        $statusWeights = [
            Contract::STATUS_DRAFT => 70,
            Contract::STATUS_ACTIVE => 25,
            Contract::STATUS_FINALIZED => 5,
        ];
        $status = $this->weightedRandomElement($statusWeights);

        // Date logic based on status
        $dates = $this->generateContractDates($status);

        // Chances of having (tensioned 50%; tenant_2 40%)
        $isTensioned = $this->faker->boolean(50);
        $hasTenant2 = $this->faker->boolean(40);

        return [
            'property_id' => Property::factory(),

            'status' => $status,

            // Contract Dates
            'start_date' => $dates['start_date'],
            'end_date' => $dates['end_date'],

            // Financial Terms
            'monthly_rent' => $monthlyRent,
            'legal_deposit' => $legalDeposit,
            'additional_deposit' => $additionalDeposit,

            // Expense Responsibilities (30% as paid by a tenant)
            'tenant_pays_ibi' => $this->faker->boolean(30),
            'tenant_pays_community_fees' => $this->faker->boolean(30),
            'tenant_pays_garbage_fees' => $this->faker->boolean(30),

            // Tensioned Area (80% as tensioned areas) and IRPA (+5% calculation)
            'is_tensioned_area' => $isTensioned ,
            'irpa_value' => $isTensioned ? round($monthlyRent * 1.05, 2) : null,

            // Tenant 1 (Required)
            'tenant1_name' => $this->faker->name(),
            'tenant1_dni' => $this->generateSpanishDNI(),
            'tenant1_email' => $this->faker->unique()->safeEmail(),
            'tenant1_phone' => $this->generateSpanishPhone(),

            // Tenant 2 (Optional)
            'tenant2_name' => $hasTenant2 ? $this->faker->name() : null,
            'tenant2_dni' => $hasTenant2 ? $this->generateSpanishDNI() : null,
            'tenant2_email' => $hasTenant2 ? $this->faker->safeEmail() : null,
            'tenant2_phone' => $hasTenant2 ? $this->generateSpanishPhone() : null,
        ];
    }

    private function generateContractDates(string $status): array
    {
        switch ($status) {
            case Contract::STATUS_DRAFT:
                return [
                    'start_date' => $this->faker->dateTimeBetween('+1 week', '+3 months'),
                    'end_date' => null,
                ];

            case Contract::STATUS_ACTIVE:
                $startDate = $this->faker->dateTimeBetween('-2 years', '-1 day');
                $endDate = $this->faker->dateTimeBetween('+1 month', '+5 years');
                return [
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                ];

            case Contract::STATUS_FINALIZED:
                $startDate = $this->faker->dateTimeBetween('-5 years', '-2 years');
                $endDate = $this->faker->dateTimeBetween($startDate, '-1 day');
                return [
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                ];

            default:
                return [
                    'start_date' => $this->faker->dateTimeBetween('+1 week', '+3 months'),
                    'end_date' => null,
                ];
        }
    }

    private function weightedRandomElement(array $weights): mixed
    {
        $totalWeight = array_sum($weights);
        $random = $this->faker->numberBetween(1, $totalWeight);

        $sum = 0;
        foreach ($weights as $value => $weight) {
            $sum += $weight;
            if ($random <= $sum) {
                return $value;
            }
        }

        return array_key_first($weights);
    }

    private function generateSpanishDNI(): string
    {
        $number = $this->faker->numberBetween(10000000, 99999999);
        $letters = 'TRWAGMYFPDXBNJZSQVHLCKE';
        $letter = $letters[$this->faker->numberBetween(0, 22)];

        return $number . $letter;
    }

    private function generateSpanishPhone(): string
    {
        return '+34 ' . $this->faker->numberBetween(600, 699) . ' ' .
               $this->faker->numberBetween(100, 999) . ' ' .
               $this->faker->numberBetween(100, 999);
    }

    // Methods for testing specific scenarios

    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Contract::STATUS_DRAFT,
        ]);
    }

    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Contract::STATUS_ACTIVE,
        ]);
    }

    public function finalized(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Contract::STATUS_FINALIZED,
        ]);
    }

    public function withTwoTenants(): static
    {
        return $this->state(fn (array $attributes) => [
            'tenant2_name' => $this->faker->name(),
            'tenant2_dni' => $this->generateSpanishDNI(),
            'tenant2_email' => $this->faker->safeEmail(),
            'tenant2_phone' => $this->generateSpanishPhone(),
        ]);
    }

    public function inTensionedArea(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_tensioned_area' => true,
            'irpa_value' => round($attributes['monthly_rent'] * 1.05, 2),
        ]);
    }
}
