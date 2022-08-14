<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Cat;

class CatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cat::truncate();

        $names = [
            'メイク・フェイスケア',
            'スキンケア',
            'ヘアケア',
            'バス用品',
            'シェービング',
            '美容・栄養補助食品',
            '香水・フレグランス',
        ];
        foreach($names as $name) {
            DB::table('cats')->insert([
                'name' => $name,
            ]);
        }
    }
}
