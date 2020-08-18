<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoldersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titles = ['プライベート', '仕事', '旅行'];

        foreach ($titles as $title) {
            DB::table('folders')->insert([
                'title' => $title, /*タスクタイトル */
                'created_at' => Carbon::now(), /*タスク作成日-> カーボンを用いて現在日時代入*/
                'updated_at' => Carbon::now(), /*タスク更新日-> カーボンを用いて現在日時代入*/
            ]);
        }
    }
}
