<?php

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Position::create([
            'id' => Position::MANAGER,
            'name' => 'Manager',
            'salary' => 20000,
        ]);

        Position::create([
            'id' => Position::DEVELOPER,
            'name' => 'Developer',
            'salary' => 30000,
        ]);

        Position::create([
            'id' => Position::DIRECTOR,
            'name' => 'Director',
            'salary' => 40000,
        ]);
    }
}
