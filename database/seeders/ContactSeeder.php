<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Tag;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 事前にすべてのタグのIDをコレクションとして取得しておく
        $tagIds = Tag::pluck('id');
        // タグが１つもない場合は処理をスキップする
        if ($tagIds->isEmpty()) {
            return;
        }
        // 各コンタクトに対して、ランダムに1〜3個のタグを紐づける
        Contact::all()->each(function ($contact) use ($tagIds) {
            $randomCount = min(rand(1, 3), $tagIds->count()); // 1〜3個のタグをランダムに選択
            // ランダムに選んだIDを配列で取得
            $randomTagIds = $tagIds->random($randomCount)->all();
            // 中間テーブルに紐づけ
            $contact->tags()->attach($randomTagIds);
        });

        // 日本語のFakerインスタンスを生成
        $faker = Factory::create('ja_JP');

        // ビル・マンション名のダミー配列
        $buildings = [
            'さくらビル3F',
            'グランドハイツ',
            'コーポ・サンライズ101',
            'メゾン・ド・フルール',
            'シャトー・ド・リュミエール',
        ];

        // 20件のダミーデータを生成
        for ($i = 0; $i < 20; $i++) {
            Contact::create([
                'category_id' => Category::inRandomOrder()->first()->id, // ランダムにカテゴリを付与
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'gender' => $faker->randomElement([1, 2, 3]),
                'email' => $faker->unique()->safeEmail,
                'tel' => str_replace('-', '', $faker->phoneNumber),
                'address' => $faker->address,
                'building' => $faker->randomElement($buildings),
                'detail' => $faker->text(200),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
