<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\DataPreload;
use Tests\TestCase;

class ViewProductTest extends TestCase
{

    use RefreshDatabase, DataPreload;
    private $response;

    protected function setUp(): void
    {
        parent::setUp();

        $this->loadProducts();
        $this->response = $this->getJson(route('api.products'))->assertStatus(200);
    }

    /** @test */
    public function api_give_category(): void
    {
        $this->assertEquals( $this->category->title, $this->response['data'][0]['title']);
    }

    /** @test */
    public function api_give_product(): void
    {
        $this->assertEquals( $this->product->title, $this->response['data'][0]['items'][0]['title']);
    }

    /** @test */
    public function api_give_subproducts(): void
    {
        $this->assertEquals( $this->subproduct->title, $this->response['data'][0]['items'][0]['items'][0]['title']);
    }

}
