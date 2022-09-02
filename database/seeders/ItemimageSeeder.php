<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Item;

class ItemimageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //ディレクトリのファイルを削除
        $success = Storage::deleteDirectory('itemPhotos');

        $amount = Item::all()->count();
        for($id = 1; $id <=$amount; $id++) {
            $item = Item::find($id);
            $image_amount = rand(2,5);
            //製品写真をディレクトリにコピー
            for($i = 1; $i <= $image_amount; $i++) {
                Storage::copy(
                    'samplePhoto/samplePhoto0' . $i . '.jpg',
                    '/public/itemPhotos/'. $item->id . '/'. $i . '.jpg'
                );
                DB::table('itemimages')->insert([
                    'item_id' => $item->id,
                    'image_id' => $i,
                    'url' => $item->id . '/'. $i . '.jpg',
                ]);
            }
        }
    }
}
