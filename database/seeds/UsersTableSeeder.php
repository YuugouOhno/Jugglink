<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        'id' => 1,
		'name' => 'test',
		'email' => 'test@gmail.com',
		'password' => '$2y$10$AlJKL5pperTiQRcff9EQR.XfAAQ1bo1Vz8pH7D5/Al7nyAuNtJuH2',
		'tool_id' => 1,
		'start_date' => now(),
		'created_at' => now(),
        'updated_at' => now(),
        ]);
    }
}
