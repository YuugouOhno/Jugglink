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
    		'tool_name'=> 'シガーボックス',
    		],
    		[
    		'id'=>2,
    		'tool_name'=> 'ディアボロ',
    		],
    		[
    		'id'=>3,
    		'tool_name'=> 'ボール',
    		],
    		[
    		'id'=>4,
    		'tool_name'=> 'クラブ',
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
    		'tool_name'=> 'ヨーヨー',
    		],
    		[
    		'id'=>9,
    		'tool_name'=> 'コンタクト',
    		],
    		[
    		'id'=>10,
    		'tool_name'=> 'ハット',
    		],
    		[
    		'id'=>11,
    		'tool_name'=> 'スピニングブレード',
    		],
    		[
    		'id'=>12,
    		'tool_name'=> 'スタッフ',
    		],
    		[
    		'id'=>13,
    		'tool_name'=> 'シェイカーカップ',
    		],
    		[
    		'id'=>14,
    		'tool_name'=> 'リング',
    		],
    		[
    		'id'=>15,
    		'tool_name'=> 'エイトリング',
    		],
    		[
    		'id'=>16,
    		'tool_name'=> 'けん玉',
    		],
    		[
    		'id'=>17,
    		'tool_name'=> 'ダイス',
    		],
    		[
    		'id'=>18,
    		'tool_name'=> 'ダポクト',
    		],
    		[
    		'id'=>19,
    		'tool_name'=> 'その他',
    		]
    		
		]);
    }
}
