<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $userID = DB::table('users')->insertGetId([
            'login' => 'zhuravlev.vu',
            'email' => 'zhuravlev.vu@yandex.ru',
            'password' => bcrypt('120912'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('messages')->insert([
          'user_id' => $userID,
          'message' => '<p>hello! This is a test message ;)</p>',
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s'),

        ]);
    }
}
