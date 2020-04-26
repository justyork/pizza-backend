<?php
/**
 * Author: York
 * Email: yorkshp@gmail.com
 * Date: 22.04.2020
 */

namespace App\Cart\storage;


use App\Cart\BaseCart;
use App\Cart\CartItem;
use App\Cart\Product;

abstract class CartStorageBase extends BaseCart
{

    /** @var CartStorageInterface */
    protected $storage;

    /**
     * @return CartStorageInterface|null
     */
    abstract protected function loadStorage(): ?CartStorageInterface;

    /**
     * @return CartStorageInterface
     */
    abstract protected function createStorage(): CartStorageInterface;

    /**
     * @param int $storage_id
     * @param Product $product
     * @param $count
     * @return StorageProductInterface
     */
    abstract protected function createStorageItem(int $storage_id, Product $product, $count): StorageProductInterface;

    /**
     * Load storage
     */
    protected function beforeLoad()
    {
        if ($this->storage) return;

        $this->storage = $this->loadStorage();
        if ($this->storage) {
            $this->loadProducts();
            $this->loadDelivery();
        } else
            $this->storage = $this->createStorage();
    }

    /**
     * Load products from storage
     */
    private function loadProducts(): void
    {
        foreach ($this->storage->getProducts() as $item) {
            $this->cartItems[$item->getProduct()->getId()] = new StorageProduct($item, $item->getProduct());
        }
    }

    /**
     * Load delivery
     */
    private function loadDelivery(): void
    {
        $this->delivery = static::getInstance()->storage->getDelivery();
    }

    /**
     * @return \App\Cart\Delivery
     */
    public function getDelivery()
    {
        return $this->delivery;
    }

    /** Get storage id
     * @return mixed
     */
    public static function getId()
    {
        return static::getInstance()->storage->getId();
    }


}
