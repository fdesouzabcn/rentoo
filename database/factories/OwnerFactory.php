<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Owner>
 */
class OwnerFactory extends Factory
{
    // Factory configured to use localized data (Spanish data)
    //protected static ?string $locale ='es_ES'; -- Failing sometimes
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
        return [
            'name' => $this->faker->name(),
            'dni' => $this->generateSpanishDNI(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->generateSpanishPhone(),
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
        ];
    }

    private function generateSpanishDNI(): string
    {
        $number = $this->faker->numberBetween(10000000, 99999999);
        $letters = 'TRWAGMYFPDXBNJZSQVHLCKE';
        $letter = $letters[$this->faker->numberBetween(0,22)];

        return $number . $letter;
    }

    private function generateSpanishPhone():string
    {
        return '+34 '. $this->faker->numberBetween(600,699) . ' ' .
                $this->faker->numberBetween(100,999) . ' ' .
                $this->faker->numberBetween(100,999);
    }

    private function generateBarcelonaPostalCode(): string
    {
        $number = $this->faker->numberBetween(8001, 8999);
        return str_pad((string) $number, 5, '0', STR_PAD_LEFT);
    }
}
