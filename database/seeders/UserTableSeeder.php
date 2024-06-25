<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Domain\Role\Domain\Role;
use App\Domain\User\Domain\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $admin = new User();
        $admin->media = '2024-03/admin.png';
        $admin->first_name = 'Admin';
        $admin->last_name = null;
        $admin->email = 'admin@mail.ru';
        $admin->password = Hash::make('admin123');
        $admin->status = true;
        $admin->data = [
            'ip_address' => '120.33.201.1'
        ];
        $admin->save();
        $admin->roles()->attach(Role::where('slug', 'admin')->first());

        sleep(1);

        $user = new User();
        $user->media = '2024-03/user.png';
        $user->first_name = 'User';
        $user->last_name = null;
        $user->email = 'user@mail.ru';
        $user->password = Hash::make('user1234');
        $user->status = true;
        $user->data = [
            'ip_address' => '231.0.102.91'
        ];
        $user->save();
        $user->roles()->attach(Role::where('slug', 'user')->first());
    }
}
