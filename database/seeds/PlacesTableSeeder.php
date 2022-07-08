<?php

use Illuminate\Database\Seeder;

class PlacesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('places')->insert([
        'id'=>1,
		'user_id'=> 1,
		'lat'=>35.70765459074773,
		'lng'=>139.70587802967046,
		'created_at' => now(),
        'updated_at' => now(),
        'deleted_at' => now(),
        ]);
    }
}
