<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DormsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dorms')->delete();
        $data = [
            ['name' => 'Gernal'],
            ['name' => 'OBC'],
            ['name' => 'SC'],
            ['name' => 'ST'],
            //['name' => 'Trust Hostel'],
        ];
        DB::table('dorms')->insert($data);
    }
}
