<?php
/**
 * Author: York
 * Email: yorkshp@gmail.com
 * Date: 22.04.2020
 */

namespace App\Cart\storage;


use App\Cart\CartItem;
use App\Cart\ProductInterface;

class StorageProduct extends CartItem
{
    /** @var StorageProductInterface */
    protected $storageProduct;

    /**
     * StorageProduct constructor.
     * @param StorageProductInterface $storageProduct
     * @param ProductInterface $product
     */
    public function __construct(StorageProductInterface $storageProduct, ProductInterface $product)
    {
        parent::__construct($product, $storageProduct->getCount());
        $this->product = $product;
        $this->storageProduct = $storageProduct;
    }

    /**
     * @param int $count
     */
    public function increase(int $count = 1): void
    {
        parent::increase($count);
        $this->storageProduct->setCount($this->count());
    }

    /**
     * @param int $count
     */
    public function reduce(int $count = 1): void
    {
        parent::reduce($count);
        $this->storageProduct->setCount($this->count());
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->storageProduct->getId();
    }

    public function count(int $count = null): ?int
    {

        if ($count !== null) {
            $this->storageProduct->setCount($count);
        }

        return parent::count($count);
    }

    public function beforeDelete(): void
    {
        $this->storageProduct->remove();
    }

}
