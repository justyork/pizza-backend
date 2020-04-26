<?php

namespace Tests\Feature;

use App\Cart;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\DataPreload;
use Tests\TestCase;

class CartApiTest extends TestCase
{

    use RefreshDatabase, DataPreload;

    protected function setUp(): void
    {
        parent::setUp();
        $this->loadProducts();
        $this->loadDelivery();
        Cart::flush();
    }

    /** @test */
    public function customer_can_get_cart(): void
    {
        Cart::add($this->product);
        $data = $this->getJson(route('api.cart'))
            ->assertStatus(200);

        $this->assertEquals($this->product->title, $data[0]['title']);


    }

    /** @test */
    public function customer_can_add_new_product(): void
    {
        $this->putJson(route('api.cart.add'), ['id' => $this->product->id, 'count' => 1])
            ->assertStatus(200);

        $this->assertDatabaseHas('cart_storage_items', [
            'cart_id' => Cart::getId(),
            'product_id' => $this->product->id,
            'count' => 1
        ]);
    }

    /** @test */
    public function customer_can_remove_product(): void
    {
        Cart::add($this->product);

        $this->deleteJson(route('api.cart.remove'), ['id' => $this->product->id])
            ->assertStatus(200);

        $this->assertDatabaseMissing('cart_storage_items', [
            'cart_id' => Cart::getId(),
            'product_id' => $this->product->id
        ]);
    }

    /** @test */
    public function customer_can_clear_cart(): void
    {
        Cart::add($this->product);
        $this->postJson(route('api.cart.clear'))
            ->assertStatus(200);

        $this->assertTrue(Cart::empty());
    }

    /** @test */
    public function customer_can_increase_product_count(): void
    {
        Cart::add($this->product);

        $this->postJson(route('api.cart.increase'), ['id' => $this->product->id])
            ->assertStatus(200);

        $this->assertDatabaseHas('cart_storage_items', [
            'cart_id' => Cart::getId(),
            'product_id' => $this->product->id,
            'count' => 2
        ]);
    }

    /** @test */
    public function customer_can_reduce_product_count(): void
    {
        Cart::add($this->product, 2);

        $this->postJson(route('api.cart.reduce'), ['id' => $this->product->id])
            ->assertStatus(200);

        $this->assertDatabaseHas('cart_storage_items', [
            'cart_id' => Cart::getId(),
            'product_id' => $this->product->id,
            'count' => 1
        ]);
    }

    /** @test */
    public function customer_can_set_delivery(): void
    {
        $this->postJson(route('api.cart.delivery'), ['id' => $this->delivery->id])
            ->assertStatus(200);

        $this->assertDatabaseHas('cart_storages', [
            'id' => Cart::getId(),
            'delivery_id' => $this->delivery->id
        ]);

    }

}
