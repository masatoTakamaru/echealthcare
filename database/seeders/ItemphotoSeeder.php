<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Item;

class ItemphotoSeeder extends Seeder
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
            $photo_amount = rand(2,5);
            //製品写真をディレクトリにコピー
            for($i = 1; $i <= $photo_amount; $i++) {
                Storage::copy(
                    'samplePhoto/samplePhoto0' . $i . '.jpg',
                    '/public/itemPhotos/'. $item->serial . '/'. $i . '.jpg'
                );
                DB::table('itemphotos')->insert([
                    'item_id' => $item->id,
                    'url' => 'storage/' . 'itemPhotos/'. $item->serial . '/'. $i . '.jpg',
                ]);
            }
        }
        $items = Item::all();
        foreach($items as $item) {
            $itemphoto = $item->itemphotos()->first();
            $item->update([
                'primaryphoto_url' => $itemphoto->url,
            ]);
        }
    }
}
