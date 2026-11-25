<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@atelier.test'],
            ['name' => 'Store Admin', 'password' => Hash::make('password'), 'role' => 'admin']
        );

        $items = [
            ['name' => 'Tops', 'description' => 'Everyday essentials and elevated basics.'],
            ['name' => 'Outerwear', 'description' => 'Light layers and statement jackets.'],
            ['name' => 'Bottoms', 'description' => 'Modern fits for everyday wear.'],
            ['name' => 'Accessories', 'description' => 'The finishing touches.'],
        ];

        foreach ($items as $item) {
            $category = Category::firstOrCreate(
                ['slug' => Str::slug($item['name'])],
                ['name' => $item['name'], 'description' => $item['description'], 'is_active' => true]
            );

            $products = match ($item['name']) {
                'Tops' => [
                    ['Everyday Cotton Tee', 49, 'A relaxed-fit cotton tee made for daily rotation.', 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=900'],
                    ['Essential Ribbed Tank', 39, 'A clean, versatile layering essential.', 'https://images.unsplash.com/photo-1503342217505-b0a15ec3261c?w=900'],
                ],
                'Outerwear' => [
                    ['Relaxed Utility Jacket', 189, 'A lightweight layer with a timeless silhouette.', 'https://images.unsplash.com/photo-1591047139829-d91aecb6caea?w=900'],
                    ['Minimal Overshirt', 129, 'An easy extra layer for transitional days.', 'https://images.unsplash.com/photo-1598033129183-c4f50c736f10?w=900'],
                ],
                'Bottoms' => [
                    ['Straight Leg Trousers', 119, 'A modern straight-leg fit with a clean finish.', 'https://images.unsplash.com/photo-1473966968600-fa801b869a1a?w=900'],
                    ['Relaxed Denim', 139, 'Comfortable denim with an easy everyday shape.', 'https://images.unsplash.com/photo-1542272604-787c3835535d?w=900'],
                ],
                default => [
                    ['Canvas Everyday Tote', 35, 'A practical carry-all for everyday essentials.', 'https://images.unsplash.com/photo-1544816155-12df9643f363?w=900'],
                    ['Classic Cap', 45, 'A simple finishing touch for off-duty looks.', 'https://images.unsplash.com/photo-1588850561407-ed78c282e89b?w=900'],
                ],
            };

            foreach ($products as $index => $p) {
                Product::firstOrCreate(
                    ['slug' => Str::slug($p[0])],
                    [
                        'category_id' => $category->id,
                        'name' => $p[0],
                        'sku' => strtoupper(substr(Str::slug($p[0]), 0, 12)),
                        'description' => $p[2],
                        'price' => $p[1],
                        'compare_at_price' => null,
                        'image_url' => $p[3],
                        'stock' => 30,
                        'is_featured' => $index === 0,
                        'is_active' => true,
                    ]
                );
            }
        }
    }
}
