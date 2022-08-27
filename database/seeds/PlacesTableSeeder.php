<?php

use Illuminate\Database\Seeder;
use App\Place;

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
		'latitude'=>35.70765459074773,
		'longitude'=>139.70587802967046,
		'created_at' => now(),
        'updated_at' => now(),
        'deleted_at' => NULL
        ]);
        DB::table('places')->insert([
        'id'=>2,
		'user_id'=> 1,
		'latitude'=>35.10765459074773,
		'longitude'=>139.10587802967046,
		'created_at' => now(),
        'updated_at' => now(),
        'deleted_at' => NULL
        ]);
        DB::table('places')->insert([
        'id'=>3,
		'user_id'=> 1,
		'latitude'=>36.70765459074773,
		'longitude'=>138.70587802967046,
		'created_at' => now(),
        'updated_at' => now(),
        'deleted_at' => NULL
        ]);
        DB::table('places')->insert([
        'id'=>4,
		'user_id'=> 1,
		'latitude'=>36.70765459074773,
		'longitude'=>138.70587802967046,
		'created_at' => now(),
        'updated_at' => now(),
        'deleted_at' => NULL
        ]);
        DB::table('places')->insert([
        'id'=>5,
		'user_id'=> 1,
		'latitude'=>36.10765459074773,
		'longitude'=>138.10587802967046,
		'created_at' => now(),
        'updated_at' => now(),
        'deleted_at' => NULL
        ]);
        DB::table('places')->insert([
        'id'=>6,
		'user_id'=> 1,
		'latitude'=>35.70765459074773,
		'longitude'=>138.20587802967046,
		'created_at' => now(),
        'updated_at' => now(),
        'deleted_at' => NULL
        ]);
    }
}
