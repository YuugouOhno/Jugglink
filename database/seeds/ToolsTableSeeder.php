<?php

use Illuminate\Database\Seeder;
use App\Model\Tool;

class ToolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tools')->insert([
            [
            'id'=>1,
    		'name'=> 'シガーボックス',
    		],
    		[
    		'id'=>2,
    		'name'=> 'ディアボロ',
    		],
    		[
    		'id'=>3,
    		'name'=> 'ボール',
    		],
    		[
    		'id'=>4,
    		'name'=> 'クラブ',
    		],
    		[
    		'id'=>5,
    		'tool_name'=> 'ポイ',
    		],
    		[
    		'id'=>6,
    		'tool_name'=> 'フラワースティック',
    		],
    		[
    		'id'=>7,
    		'tool_name'=> 'デビルスティック',
    		],
    		[
    		'id'=>8,
    		'name'=> 'ヨーヨー',
    		],
    		[
    		'id'=>9,
    		'name'=> 'コンタクト',
    		],
    		[
    		'id'=>10,
    		'name'=> 'ハット',
    		],
    		[
    		'id'=>11,
    		'name'=> 'スピニングブレード',
    		],
    		[
    		'id'=>12,
    		'tool_name'=> 'スタッフ',
    		],
    		[
    		'id'=>13,
    		'name'=> 'シェイカーカップ',
    		],
    		[
    		'id'=>14,
    		'name'=> 'リング',
    		],
    		[
    		'id'=>15,
    		'name'=> 'エイトリング',
    		],
    		[
    		'id'=>16,
    		'name'=> 'けん玉',
    		],
    		[
    		'id'=>17,
    		'name'=> 'ダイス',
    		],
    		[
    		'id'=>18,
    		'name'=> 'ダポクト',
    		]
    		
		]);
    }
}
