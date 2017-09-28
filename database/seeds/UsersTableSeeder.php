<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\TurOnline\User::class, 1)
            ->states('admin')
            ->create([
                'name' =>'Diego Fernandes',
                'email'=>'admin@user.com'
            ]);

        factory(\TurOnline\User::class, 1)
            ->create([
                'name' =>'Jose da silva',
                'email'=>'jose@user.com'
            ]);
    }
}
