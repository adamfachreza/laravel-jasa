<?php

namespace Database\Seeders;

use App\Models\DetailUser;
use Illuminate\Database\Seeder;

class DetailUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $detail_user = [
            [
                'users_id' => 1,
                'photo' => NULL,
                'role' => 'admin',
                'contact_number' => '08221234567',
                'biography' => NULL,
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s'),
            ],
            [
                'users_id' => 2,
                'photo' => NULL,
                'role' => 'user',
                'contact_number' => '081234567890',
                'biography' => NULL,
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s'),
            ],
        ];

        DetailUser::insert($detail_user);
    }
}
