<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $catsubs = [
            [
                '化粧下地',
                'ファンデーション',
                'アイシャドウ',
                '口紅',
                'メイク道具',
            ],
            [
                '洗顔料',
                'クレンジング',
                '化粧水',
                'フェイスパック',
                '美容液',
                '乳液',
                'クリーム',
                'UVカット・日焼け止め',
            ],
            [
                'シャンプー',
                'コンディショナー・リンス',
                'トリートメント',
                'ヘアスタイリング剤',
                'ワックス・ポマード',
                'カラーリング剤',
                '白髪染め',
                '育毛・羊毛・増毛',
            ],
            [
                'ボディローション・ミルク',
                'ボディクリーム',
                'ボディウォッシュ',
                'ボディソープ',
                '固形せっけん',
                'ハンドソープ',
                'バス・シャワー用品',
                '入浴剤',
                'ハンド・ネイルケア',
                'フットケア',
                'カミソリ',
                '脱毛・除毛',
                'シェービング・ムダ毛処理',
            ],
            [
                'ネイルカラー',
                'ジェルネイル',
                'アクリルスカルプチュア',
                'ベースコート',
                'トップコート',
                'リムーバー',
                'ネイル道具',
            ],
            [
                'サプリメント・ビタミン',
                '栄養バー・栄養ドリンク',
                'スポーツサプリメント',
                'ダイエット',
            ],
            [
                '女性用',
                '男性用',
                '子ども用',
                '練り香水',
                'ボディミスト',
                'フレグランスウォーター',
                'アロマオイル',
                'エッセンシャルオイル',
                '香水・フレグランスセット',
                'アトマイザー',
            ],
        ];

        $makers = [
            'メーカー001',
            'メーカー002',
            'メーカー003',
            'メーカー004',
            'メーカー005',
            'メーカー006',
            'メーカー007',
            'メーカー008',
            'メーカー009',
            'メーカー010',
        ];

        $count = 1;
        $catsub_count = 1;

        foreach($catsubs as $index => $names) {
            $cat_num = $index + 1;
            foreach($names as $index => $name) {
                $product_number = rand(5, 200);
                for($i = 0; $i <= $product_number; $i++) {
                    DB::table('products')->insert([
                        'header' => '今なら' . rand(1,8) . '0%OFF!!',
                        'name' => '製品' . $count . fake()->text(100),
                        'serial' => sprintf('%1$09d', $count),
                        'price' => rand(1, 99) * 100 + 98,
                        'inventory' => rand(0, 25),
                        'spec' => '規格：' . fake()->realText(200),
                        'cat_id' => $cat_num,
                        'subcat_id' => $catsub_count,
                        'maker' => $makers[array_rand($makers)],
                    ]);
                    $count++;    
                }
                $catsub_count++;
            }
        }
    }
}
