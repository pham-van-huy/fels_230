<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        User::create([
            'name' => 'Pham Van Huy',
            'email' => 'pham.van.huy@framgia.com',
            'password' => 123123,
            'is_admin' => 1,
            'avatar' => 'http://www.wisportsfan.com/siteresources/images/defaultavatar.jpg',
        ]);
        $user = [];

        for ($i=1; $i<=20; $i++) {
            $user = [
                'name' => $faker->name,
                'email' => $faker->safeEmail,
                'password' => 123123,
                'is_admin' => 0,
                'avatar' => 'http://www.wisportsfan.com/siteresources/images/defaultavatar.jpg',
            ];
            User::create($user);
        }
    }
}
