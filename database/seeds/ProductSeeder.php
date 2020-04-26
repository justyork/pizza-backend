<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    use \Illuminate\Foundation\Testing\WithFaker;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $category = \App\Category::firstOrCreate(['title' => 'Pizzas']);

        $items = [
            ['title' => 'Cheese pizza', 'image' => '1.jpg', 'text' => 'Tomato sauce, mozzarella'],
            ['title' => 'Cheese and ham', 'image' => '2.jpg', 'text' => 'Ham, mozzarella, cream sauce'],
            ['title' => 'Pepperoni with pepper', 'image' => '3.jpeg', 'text' => 'Spicy pepperoni, tomato sauce, sweet pepper, mozzarella'],
            ['title' => 'Ham and mushrooms', 'image' => '4.jpg', 'text' => 'Ham, tomato sauce, champignons, mozzarella'],
            ['title' => 'Hawaiian', 'image' => '5.jpg', 'text' => 'Chicken, tomato sauce, mozzarella, pineapple'],
            ['title' => 'Double pepperoni', 'image' => '6.jpg', 'text' => 'Spicy pepperoni, tomato sauce, mozzarella'],
            ['title' => 'Chicken ranch', 'image' => '7.jpg', 'text' => 'Chicken, cheese sauce, mozzarella, tomatoes'],
        ];

        foreach ($items as $item) {
            $this->createProductWithSizes($category->id, $item);
        }

        $category = \App\Category::firstOrCreate(['title' => 'Drinks']);
        \App\Product::create([
            'title' => 'Coca-cola, 0,5 l',
            'price' => 120,
            'image' => 'products/8.jpg',
            'category_id' => $category->id,
        ]);
        \App\Product::create([
            'title' => 'Capuchino,  0,3 l',
            'price' => 300,
            'image' => 'products/9.jpeg',
            'category_id' => $category->id,
        ]);
    }


    private function createProductWithSizes($category_id, array $data)
    {
        $prices = [25 => 500, 30 => 750, 35 => 960];

        $data += [
            'category_id' => $category_id,
        ];
        $data['image'] = 'products/'.$data['image'];

        $product = \App\Product::create($data);
        foreach ($prices as $size => $price) {
            $data['price'] = $price;
            $data['size'] = $size;
            $data['parent_id'] = $product->id;

            \App\Product::create($data);
        }

    }
}
