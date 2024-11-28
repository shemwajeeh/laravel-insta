<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    private $category;

    public function __construct(Category $category) {
        $this->category = $category;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Fashion',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'name' => 'Gadgets',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'name' => 'Transportation',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'name' => 'Music',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'name' => 'Career',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'name' => 'Movie',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ]
        ];

        $this->category->insert($categories);
    }
}
