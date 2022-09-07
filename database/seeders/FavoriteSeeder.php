<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Item;

class FavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $amount = Item::all()->count();
        for($i = 1; $i <= 4; $i++)
        {
            DB::table('favorites')->insert([
                'user_id' => 1,
                'item_id' => rand(1, $amount),
            ]);
        }
    }
}
