<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'Super User']);
        $admin = User::create([
            'name'      => 'Developer',
            'email'     => 'developer@dev.com',
            'username'     => 'developer',
            'password'  =>  bcrypt('devpass'),
        ])->assignRole('Super User');
    }
}
