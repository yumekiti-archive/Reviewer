<?php

use Illuminate\Database\Seeder;

class ThreadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $titles = ['タイトルテスト１', 'タイトルテスト２', 'タイトルテスト３'];
        $details = ['詳細テスト１', '詳細テスト２', '詳細テスト３'];

        foreach ($titles as $index => $title) {
            DB::table('threads')->insert([
                'title' => $title,
                'detail' => $details[$index],
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'user_id' => 1
            ]);
        }

    }
}