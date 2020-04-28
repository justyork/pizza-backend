<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Category;
use App\DeliveryInterface;
use App\ProductInterface;
use Illuminate\Http\Request;

class AppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $euro = 1.08;
        return response([
            'delivery' => DeliveryInterface::all()->toArray(),
            'euro' => $euro,
            'products' => Category::all()->toArray(),
            'cart' => Cart::getArray(),
        ]);
    }

}
