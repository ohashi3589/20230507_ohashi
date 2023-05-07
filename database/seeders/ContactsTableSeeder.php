<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;
use Faker\Factory as FakerFactory;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create('ja_JP');

        Contact::factory()->count(35)->create([
            'postcode' => $faker->regexify('[0-9]{3}-[0-9]{4}'),
        ]);
    }
}
