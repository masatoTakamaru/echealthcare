<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Item;

class RecommendSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $amount = Item::all()->count();
        for($i = 1; $i <= 10; $i++)
        {
            DB::table('recommends')->insert([
                'item_id' => rand(1, $amount),
            ]);
        }
    }
}
