<?php

namespace App\Http\Controllers;

use App\Cart;
use App\DeliveryInterface;
use App\Order;
use App\ProductInterface;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CartController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = ProductInterface::find($request->id);
        if ($product) {
            Cart::add($product, $request->count ?? 1);
        } else {
            return response('Not found', 404);
        }
    }

    public function delivery(Request $request)
    {
        $delivery = DeliveryInterface::where('id', $request->id)->first();
        Cart::delivery($delivery);
    }

    public function checkout()
    {
        // TODO save data in order but it doesn't need now
        Cart::clear();
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function increase(Request $request)
    {
        if (!Cart::has($request->id))
            return response('Not found', 404);

        Cart::increase($request->id);

        return response(Cart::count($request->id));
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reduce(Request $request)
    {
        if (!Cart::has($request->id))
            return response('Not found', 404);

        if (Cart::count($request->id) <= 0)
            Cart::remove($request->id);
        else
            Cart::reduce($request->id);
        return response(Cart::count($request->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Cart::remove($request->id);
    }

    /**
     *
     */
    public function clear()
    {
        Cart::clear();
    }



}
