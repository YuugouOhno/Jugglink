<?php

use Illuminate\Database\Seeder;
use App\Tool;

class ToolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {
        $tools = ["シガーボックス", "ディアボロ", "ボール", "クラブ", 'ポイ', "フラワースティック", "デビルスティック", "ヨーヨー", "コンタクト", "スピニングブレード", "シェイカーカップ", "ハット", "リング", "スタッフ", "エイトリング", "けん玉", "ダポクト", "その他"];
        foreach($tools as $tool)
        
        {
            Tool::create([
                'tool_name' => $tool
            ]);
        }
    }
    }
}
