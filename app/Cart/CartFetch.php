<?php
/**
 * Author: York
 * Email: yorkshp@gmail.com
 * Date: 23.04.2020
 */

namespace App\Cart;


abstract class CartFetch extends SingleCart
{

    /** @var CartItem[] */
    protected $cartItems = [];

    /** Check is item exist
     * @param int $id
     * @return bool
     */
    public static function has(int $id): bool
    {
        if (!is_int($id)) return false;
        return isset(static::getInstance()->cartItems[$id]);
    }

    /** Return element
     * @param int $id
     * @return CartItem|CartItem[]|bool
     */
    public static function get(int $id = null)
    {
        /** @var static $cart */
        $cart = static::getInstance();
        if ($id !== null && static::has($id))
            return $cart->getCartItem($id);

        return $cart->getCartItems();
    }

    /**
     * @param int|null $product_id
     * @return int|mixed
     */
    public static function count(int $product_id = null)
    {
        if ($product_id && static::has($product_id)) {
            return static::getInstance()->cartItems[$product_id]->count();
        }

        return array_reduce(static::getInstance()->cartItems, function ($carry, CartItem $item) {
            return $carry + $item->count();
        }, 0);
    }


    /** check is cart empty
     * @return bool
     */
    public static function empty(): bool
    {
        return self::count() === 0;
    }

    /** Check cart not empty
     * @return bool
     */
    public static function notEmpty(): bool
    {
        return !self::empty();
    }

    /** Get cart item
     * @param $id
     * @return CartItem
     */
    protected function getCartItem($id): CartItem
    {
        return $this->cartItems[$id];
    }

    /** Get cart items
     * @return CartItem[]
     */
    protected function getCartItems(): array
    {
        return $this->cartItems;
    }
}
