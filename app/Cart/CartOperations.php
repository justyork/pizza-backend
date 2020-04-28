<?php
/**
 * Author: York
 * Email: yorkshp@gmail.com
 * Date: 21.04.2020
 */

namespace App\Cart;


/**
 * Class CartOperations
 * @package App\Cart
 */
abstract class CartOperations extends CartFetch
{


    /** Add item in cart
     * @param ProductInterface $product
     * @param int $count
     * @return void
     */
    public static function add(ProductInterface $product, int $count = 1): void
    {
        static::getInstance()->cartItems[$product->getId()] = new CartItem($product, $count);
    }

    /** Remove item by id
     * @param $id
     */
    public static function remove(int $id): void
    {
        /** @var static $cart */
        $cart = static::getInstance();

        if (static::has($id)) {
            $cart->cartItems[$id]->delete();
            unset(static::getInstance()->cartItems[$id]);
        }
    }

    /**
     * Clear cart
     */
    public static function clear(): void
    {
        static::getInstance()->cartItems = [];
    }

    /**
     * Has 3 different statements
     * 1. Doesn't have attributes. Will return count of all products in cart
     * 2. Has one attribute - product_id. Will return count products of one positions
     * 3. Has all parameters. Will update count products in position
     *
     * @param int|null $product_id
     * @param int|null $count
     * @return int|void
     */
    public static function count(int $product_id = null, int $count = null)
    {
        if ($product_id && $count !== null){
            static::getInstance()->setCount($product_id, $count);
            return;
        }
        return parent::count($product_id);
    }

    /**
     * Flush cart
     */
    public static function flush(): void
    {
        static::getInstance()->clear();
    }

    /**
     * @param int $id
     * @param int $count
     */
    public static function increase(int $id, int $count = 1): void
    {
        /** @var static $cart */
        $cart = static::getInstance();
        if ($cart->cartItems[$id]) {
            static::count($id, $cart->cartItems[$id]->count() + $count);
        }
    }

    /**
     * @param int $id
     * @param int $count
     */
    public static function reduce(int $id, int $count = 1): void
    {
        /** @var static $cart */
        $cart = static::getInstance();
        if ($cart->cartItems[$id]) {
            static::count($id, $cart->cartItems[$id]->count() - $count);
        }
    }

    /** Set count items to product
     * @param int $product_id
     * @param int $count
     */
    protected function setCount(int $product_id, int $count): void
    {
        $this->cartItems[$product_id]->count($count);
    }
}
