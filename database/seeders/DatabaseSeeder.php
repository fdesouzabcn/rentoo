<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Contract;
use App\Models\Owner;
use App\Models\Property;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Clear existing data
        Contract::query()->delete();
        Property::query()->delete();
        Owner::query()->delete();

        // Create 10 owners, each with 1-3 properties
        for ($i = 0; $i < 10; $i++) {
            $propertyCount = rand(1, 3);

            Owner::factory()
                ->has(Property::factory()->count($propertyCount))
                ->create();
        }

        echo "✅ Created " . Owner::count() . " owners" . PHP_EOL;
        echo "✅ Created " . Property::count() . " properties" . PHP_EOL;

        // Create 1-2 contracts for each property
        $properties = Property::all();

        foreach ($properties as $property) {
            $contractCount = rand(1, 2);

            Contract::factory()
                ->for($property)
                ->count($contractCount)
                ->create();
        }

        echo "✅ Created " . Contract::count() . " contracts" . PHP_EOL;
        echo PHP_EOL . "🎉 Database seeding completed!" . PHP_EOL;
        echo PHP_EOL;
    }
}
