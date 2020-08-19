<?php

use Illuminate\Database\Seeder;

class ThesisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Skripsi::class, 25)->create();
    }
}
