<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
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
		'password' => '$2y$10$45R29qTzjuRgyXlgRbIKQe1lKqo0d9SjhDngX.x03zeUdJM.nQaF.',
		'tool_id' => 1,
		'created_at' => now(),
        'updated_at' => now(),
        ]);
    }
}
