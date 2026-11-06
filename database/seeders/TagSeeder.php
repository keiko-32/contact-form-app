<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Tag;


class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //投入する固定のタグ候補リスト
        $tags = [
            ['name' => '質問'],
            ['name' => '要望'],
            ['name' => '不具合報告'],
            ['name' => 'ご意見'],
            ['name' => 'その他'],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }
    }
}
