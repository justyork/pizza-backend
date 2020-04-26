<?php
/**
 * Author: York
 * Email: yorkshp@gmail.com
 * Date: 19.04.2020
 */

namespace App\Cart;

/**
 * Class BaseCart
 * @package App\Cart
 */
abstract class BaseCart extends CartOperations
{

    /** @var Delivery */
    protected $delivery;

    /** Get product price
     * @return int
     */
    public static function price(): int
    {
        $price = 0;
        foreach (static::getInstance()->cartItems as $product) {
            $price += $product;
        }

        return $price;
    }

    /** get or set delivery
     * @param Delivery $delivery
     * @return \App\Delivery|void
     */
    public static function delivery(Delivery $delivery = null)
    {
        $cart = static::getInstance();
        if ($delivery) {
            $cart->delivery = $delivery;
        } else {
            return $cart->delivery;
        }
    }
}
