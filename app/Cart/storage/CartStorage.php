<?php
/**
 * Author: York
 * Email: yorkshp@gmail.com
 * Date: 23.04.2020
 */

namespace App\Cart\storage;


use App\Cart\Delivery;
use App\Cart\Product;

abstract class CartStorage extends CartStorageBase
{
    /**
     * @param Product $product
     * @param int $count
     * @return void
     */
    public static function add(Product $product, int $count = 1): void
    {
        $cart = static::getInstance();

        if (static::has($product->getId())) {
            self::increase($product->getId(), $count);
        } else {
            $storageItem = $cart->createStorageItem($cart->storage->getId(), $product, $count);
            $storageProduct = new StorageProduct($storageItem, $product);
            $cart->cartItems[$product->getId()] = $storageProduct;
        }
    }

    /**
     * @inheritDoc
     */
    public static function clear(): void
    {
        static::getInstance()->storage->clear();
        parent::clear();
    }

    /**
     * @inheritDoc
     */
    public static function flush(): void
    {
        parent::flush();
        static::getInstance()->storage = null;
    }

    public static function delivery(Delivery $delivery = null)
    {
        static::getInstance()->storage->setDelivery($delivery->getId());

        return parent::delivery($delivery);
    }
}
