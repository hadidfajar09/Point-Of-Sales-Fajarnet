<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'id' => 1,
            'company_name' => 'Top Celluler',
            'Address' => 'Jl. Muchtar Lutfi No.24',
            'phone' => '09090909',
            'nota_type' => 1,
            'discount' => 0,
            'path_logo' => 'img/logo001.png',
            'path_member' => 'img/member.png',
        ]);
    }
}
