<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'sku' => 'GAME001',
            'name' => 'Call of Duty Cold War',
            'description' => 'Shooter game',
            'price' => 69.99,
            'image' => 'CodColdWar.jpg',
            'stock' => 5
        ]);

        Product::create([
            'sku' => 'GAME002',
            'name' => 'FIFA 24',
            'description' => 'Soccer game',
            'price' => 49.99,
            'image' => 'FC24.jpg',
            'stock' => 10
        ]);

        Product::create([
            'sku' => 'GAME003',
            'name' => 'Minecraft Dungeons',
            'description' => 'Sandbox game',
            'price' => 29.99,
            'image' => 'MinecraftDungeons.jpg',
            'stock' => 20
        ]);

        Product::create([
            'sku' => 'GAME004',
            'name' => 'GTA V',
            'description' => 'Open world game',
            'price' => 39.99,
            'image' => 'GTA5.jpg',
            'stock' => 7
        ]);

        Product::create([
            'sku' => 'GAME005',
            'name' => 'NBA 2K24',
            'description' => 'Basketball game',
            'price' => 59.99,
            'image' => 'NBA2k24.jpg',
            'stock' => 8
        ]);

        Product::create([
            'sku' => 'GAME006',
            'name' => 'Fortnite',
            'description' => 'Battle royale',
            'price' => 0.00,
            'image' => 'Fortnite.jpg',
            'stock' => 999
        ]);

        Product::create([
            'sku' => 'GAME007',
            'name' => 'Elden Ring',
            'description' => 'RPG',
            'price' => 59.99,
            'image' => 'EldenRing.jpg',
            'stock' => 6
        ]);

        Product::create([
            'sku' => 'GAME008',
            'name' => 'Spider-Man',
            'description' => 'Action game',
            'price' => 49.99,
            'image' => 'Spiderman.jpg',
            'stock' => 4
        ]);

        Product::create([
            'sku' => 'GAME009',
            'name' => 'The Witcher 3',
            'description' => 'Adventure RPG',
            'price' => 39.99,
            'image' => 'Witcher3.jpg',
            'stock' => 9
        ]);

        Product::create([
            'sku' => 'GAME010',
            'name' => 'Cyberpunk 2077',
            'description' => 'Futuristic RPG',
            'price' => 59.99,
            'image' => 'Cyberpunk2077.jpg',
            'stock' => 5
        ]);
    }
}