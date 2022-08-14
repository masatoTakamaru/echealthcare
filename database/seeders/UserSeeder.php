<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $familyNamesSplFileObject = new \SplFileObject(__DIR__ . '/user.csv');
        $familyNamesSplFileObject->setFlags(
            \SplFileObject::READ_CSV |
            \SplFileObject::READ_AHEAD |
            \SplFileObject::SKIP_EMPTY |
            \SplFileObject::DROP_NEW_LINE
        );
        $count = 0;
        foreach($familyNamesSplFileObject as $key=>$row) {
            if($key == 0) continue;
            DB::table('users')->insert([
                'email' => trim($row[0]),
                'password' => trim($row[1]),
                'last_name' => trim($row[2]),
                'first_name' => trim($row[3]),
                'last_name_kana' => trim($row[4]),
                'first_name_kana' => trim($row[5]),
                'phone' => trim($row[6]),
                'zip' => trim($row[7]),
                'address' => trim($row[8]),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $count++;
        }

    }
}
