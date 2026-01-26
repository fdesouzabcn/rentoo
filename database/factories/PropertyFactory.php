<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Owner;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    // Force Spanish locale for the properties
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
        $surfaceArea = $this->faker->numberBetween(50, 150);
        $bedrooms = $this->faker->numberBetween(1, 4);
        $bathrooms = $this->faker->numberBetween(1, 2);

        return [
            'owner_id' => Owner::factory(),
            // 'owner_id' => null, // FIXED: Don't auto-create owner, it will let the seeder set this

            // Property Address
            'address' => $this->faker->streetAddress(),
            'city' => $this->faker->randomElement([
                'Barcelona',
                'Badalona',
                'L\'Hospitalet de Llobregat',
                'Sabadell',
                'Terrassa',
            ]),
            'postal_code' => $this->generateBarcelonaPostalCode(),
            'province'=>'Barcelona',

            // Property Details
            'cadastral_reference' => $this->generateCadastralReference(),
            'surface_area' => $surfaceArea,
            'bedrooms' => $bedrooms,
            'bathrooms' => $bathrooms,
            'description' => $this->faker->optional(0.6)->paragraph(),

            'energy_certificate_rating' => $this->faker->randomElement(['A', 'B', 'C', 'D', 'E', 'F', 'G']),
            'energy_certificate_number' => $this->generateEnergyCertificateNumber('VP'),
            'energy_certificate_expiry' => $this->faker->dateTimeBetween('+1 year', '+10 years'),

            'habitability_certificate_number' => $this->generateHabitabilityCertificateNumber('CHB'),
            'habitability_certificate_expiry' => $this->faker->dateTimeBetween('+1 year', '+15 years'),

            'last_rent_amount' => $this->faker->optional(0.6)->randomFloat(2, 600, 2000),
            'ibi_annual_amount' => $this->faker->randomFloat(2, 300, 1500),
            'community_fees_monthly' => $this->faker->randomFloat(2, 50, 250),
            'garbage_fees_annual' => $this->faker->randomFloat(2, 100, 300),
        ];
    }

    private function generateBarcelonaPostalCode(): string
    {
        $number = $this->faker->numberBetween(8001, 8999);
        return str_pad((string) $number, 5, '0', STR_PAD_LEFT);
    }

    private function generateCadastralReference(): string
    {
        $part1 = str_pad((string) $this->faker->numberBetween(1000000, 9999999), 7, '0', STR_PAD_LEFT);
        $part2 = $this->faker->lexify('??'); // 2 random letters
        $part3 = $this->faker->numerify('####'); // 4 digits
        $part4 = $this->faker->lexify('?');
        $part5 = $this->faker->numerify('####'); // 4 digits
        $part6 = $this->faker->lexify('??');

        return strtoupper($part1 . $part2 . $part3 . $part4 . $part5 . $part6);
    }

    private function generateEnergyCertificateNumber(string $prefix): string
    {
        $part1 = str_pad((string) $this->faker->numberBetween(1, 99), 2, '0', STR_PAD_LEFT);
        $part2 = $this->faker->lexify('?');
        $part3 = $this->faker->randomDigitNotZero();
        $part4 = $this->faker->lexify('???');

        return strtoupper($prefix . $part1 . $part2 . $part3 . $part4);
    }

    private function generateHabitabilityCertificateNumber(string $prefix): string
    {
        $part1 = $this->faker->numerify('###########');  // 11 digits

        return strtoupper($prefix . $part1);
    }
}
