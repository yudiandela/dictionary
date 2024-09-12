<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Word;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@dictionary.exm',
        ]);

        $category = Category::create([
            'name' => 'Fashion',
            'slug' => 'fashion',
        ]);

        $groupId = Str::uuid();

        $words = [
            [
                'slug' => 'home',
                'category_id' => $category->id,
                'group_id' => $groupId,
                'language_code' => 'eng',
                'language' => 'English',
                'daily_text' => 'Home',
                'formal_text' => 'Home',
                'voice' => '',
            ], [
                'slug' => 'rumoh',
                'category_id' => $category->id,
                'group_id' => $groupId,
                'language_code' => 'ach',
                'language' => 'Acehnesse',
                'daily_text' => 'Rumoh',
                'formal_text' => 'Rumoh',
                'voice' => '',
            ], [
                'slug' => 'rumah',
                'category_id' => $category->id,
                'group_id' => $groupId,
                'language_code' => 'ind',
                'language' => 'Indonesia',
                'daily_text' => 'Rumah',
                'formal_text' => 'Rumah',
                'voice' => '',
            ]
        ];

        foreach ($words as $word) {
            Word::create($word);
        }
    }
}
