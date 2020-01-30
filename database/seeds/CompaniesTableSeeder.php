<?php

use Faker\Factory;
use App\Models\User;
use App\Models\Company;
use App\Models\Position;
use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        factory(Company::class, 50)->create()->each(function ($company) use ($faker) {
            $director = factory(User::class)->make();
            $director->position()->associate(Position::DIRECTOR)->save();
            $company->users()->save($director);


            for ($i = 1; $i <= $faker->numberBetween(1, 3); $i++) {
                $manager = factory(User::class)->make();
                $manager->position()->associate(Position::MANAGER)->save();
                $company->users()->save($manager);
            }

            for ($j = 1; $j <= $faker->numberBetween(3, 15); $j++) {
                $developer = factory(User::class)->make();
                $developer->position()->associate(Position::DEVELOPER)->save();
                $company->users()->save($developer);
            }
        });
    }
}
