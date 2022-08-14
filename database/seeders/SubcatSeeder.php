<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Subcat;

class SubcatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subcat::truncate();

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
        foreach($catsubs as $index => $names) {
            foreach($names as $name) {
                DB::table('subcats')->insert([
                    'cat_id' => $index + 1,
                    'name' => $name,
                ]);
            }    
        }
    }
}
