<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;

class ProductphotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //ディレクトリのファイルを削除
        $success = Storage::deleteDirectory('productPhotos');

        $amount = Product::all()->count();
        for($id = 1; $id <=$amount; $id++) {
            $product = Product::find($id);
            $photo_amount = rand(2,5);
            //製品写真をディレクトリにコピー
            for($i = 1; $i <= $photo_amount; $i++) {
                Storage::copy(
                    'samplePhoto/samplePhoto0' . $i . '.jpg',
                    '/public/productPhotos/'. $product->serial . '/'. $i . '.jpg'
                );
                DB::table('productphotos')->insert([
                    'product_id' => $product->id,
                    'url' => 'storage/' . 'productPhotos/'. $product->serial . '/'. $i . '.jpg',
                ]);
            }
        }
        $products = Product::all();
        foreach($products as $product) {
            $productphoto = $product->productphotos()->first();
            $product->update([
                'primaryphoto_url' => $productphoto->url,
            ]);
        }
    }
}
