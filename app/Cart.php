<?php
/**
 * Author: York
 * Email: yorkshp@gmail.com
 * Date: 21.04.2020
 */

namespace App;


use App\Cart\Product;
use App\Cart\storage\CartStorageInterface;
use App\Cart\storage\StorageProductInterface;
use App\Helpers\PriceHelper;

class Cart extends \App\Cart\storage\CartStorage
{
    use PriceHelper;

    /**
     * @return false|string
     */
    public static function getJson()
    {
        return json_encode(static::getArray());
    }

    /**
     * @return array
     */
    public static function getArray()
    {
        $cart = static::getInstance();
        $data = self::get();
        $items = [];
        foreach ($data as $item) {
            $items[] = [
                'id' => $item->id(),
                'title' => $item->title(),
                'price' => $item->price(),
                'price_usd' => $cart->usd($item->price()),
                'count' => $item->count(),
            ];
        }
        return [
            'delivery' => $cart->getDelivery(),
            'items' => $items
        ];
    }

    public static function storage()
    {
        return static::getInstance()->storage();
    }

    /**
     * @inheritDoc
     */
    protected function loadStorage(): ?CartStorageInterface
    {
        return CartStorage::current();
    }

    /**
     * @inheritDoc
     */
    protected function createStorage(): CartStorageInterface
    {
        return CartStorage::create([]);
    }

    /**
     * @inheritDoc
     */
    protected function createStorageItem(int $storage_id, Product $product, $count): StorageProductInterface
    {
        return CartStorageItem::create([
            'cart_id' => $storage_id,
            'product_id' => $product->getId(),
            'count' => $count
        ]);
    }

}
