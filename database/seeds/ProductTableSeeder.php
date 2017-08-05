<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new Product([
            'image' => '/uploads/Image01.jpg',
            'title' => 'Dunkirk',
            'description' => 'Released : 13 July 2017',
            'price' => 19.99
        ]);
        $product->save();

        $product = new Product([
            'image' => '/uploads/Image02.jpg',
            'title' => 'Interstellar ',
            'description' => 'Released : October 26, 2014',
            'price' => 9.99
        ]);
        $product->save();

        $product = new Product([
            'image' => '/uploads/Image03.jpg',
            'title' => 'The Dark Knight Rises',
            'description' => 'Released : July 16, 2012',
            'price' => 19.99
        ]);
        $product->save();

        $product = new Product([
            'image' => '/uploads/Image04.jpg',
            'title' => 'Inception',
            'description' => 'Released : July 8, 2010',
            'price' => 8.99
        ]);
        $product->save();

        $product = new Product([
            'image' => '/uploads/Image05.jpg',
            'title' => 'The Dark Knight',
            'description' => 'Released : July 14, 2008',
            'price' => 12.99
        ]);
        $product->save();

        $product = new Product([
            'image' => '/uploads/Image06.jpg',
            'title' => 'The Prestige',
            'description' => 'Released : October 17, 2006',
            'price' => 9.99
        ]);
        $product->save();

        $product = new Product([
            'image' => '/uploads/Image07.jpg',
            'title' => 'Batman Begins',
            'description' => 'Released : May 31, 2005',
            'price' => 9.99
        ]);
        $product->save();

        $product = new Product([
            'image' => '/uploads/Image08.jpg',
            'title' => 'Insomnia',
            'description' => 'Released : May 3, 2002',
            'price' => 9.99
        ]);
        $product->save();

        $product = new Product([
            'image' => '/uploads/Image09.jpg',
            'title' => 'Memento ',
            'description' => 'Released : September 5, 2000',
            'price' => 8.99
        ]);
        $product->save();
    }
}
