<?php

namespace Tests\Feature;

use App\Cart;
use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\DataPreload;
use Tests\TestCase;

class CartTest extends TestCase
{
    use DataPreload, RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->loadProducts();
        Cart::flush();
    }



    /** @test */
    public function can_add_product_to_the_cart(): void
    {
        $this->assertTrue(Cart::empty());

        Cart::add($this->product);
        $this->assertEquals($this->product->title, Cart::get($this->product->id)->title());
    }

    /** @test */
    public function storage_has_correct_product_and_counts(): void
    {
        Cart::add($this->product, 2);

        $this->assertDatabaseHas('cart_storage_items', [
            'product_id' => $this->product->id,
            'count' => 2
        ]);
    }

    /** @test */
    public function can_delete_product_from_the_cart(): void
    {
        Cart::add($this->product);
        $this->assertTrue(Cart::notEmpty());

        Cart::remove($this->product->id);
        $this->assertTrue(Cart::empty());
    }

    /** @test */
    public function can_increase_product_count(): void
    {
        Cart::add($this->product);
        $this->assertEquals(1, $this->size());

        Cart::increase($this->product->id);
        $this->assertEquals(2, $this->size());

        $this->assertDatabaseHas('cart_storage_items', [
            'cart_id' => Cart::getId(),
            'product_id' => $this->product->id,
            'count' => 2
        ]);
    }

    /** @test */
    public function can_reduce_product_count(): void
    {
        Cart::add($this->product, 2);
        $this->assertEquals(2, $this->size());

        Cart::reduce($this->product->id);
        $this->assertEquals(1, $this->size());

        $this->assertDatabaseHas('cart_storage_items', [
            'cart_id' => Cart::getId(),
            'product_id' => $this->product->id,
            'count' => 1
        ]);
    }


    /** @test */
    public function cart_can_remove_an_item(): void
    {
        Cart::add($this->product);
        $this->assertEquals(1, $this->size());

        Cart::remove($this->product->id);
        $this->assertFalse(Cart::has($this->product->id));
    }

    public function size()
    {
        return Cart::count($this->product->id);
    }

}
