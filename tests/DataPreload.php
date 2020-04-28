<?php
/**
 * Author: York
 * Email: yorkshp@gmail.com
 * Date: 19.04.2020
 */

namespace Tests;


use App\Category;
use App\DeliveryInterface;
use App\ProductInterface;
use Illuminate\Foundation\Testing\WithFaker;

trait DataPreload
{
    use WithFaker;
    protected $category;
    protected $product;
    protected $subproduct;
    protected $delivery;

    protected function loadProducts()
    {
        $this->category = factory(Category::class)->create();
        $this->product = factory(ProductInterface::class)->create(['category_id' => $this->category->id]);
        $this->subproduct = factory(ProductInterface::class)->create([
            'category_id' => $this->category->id,
            'parent_id' => $this->product->id
        ]);
    }

    protected function loadDelivery()
    {
        $this->delivery = factory(DeliveryInterface::class)->create();
    }
}
