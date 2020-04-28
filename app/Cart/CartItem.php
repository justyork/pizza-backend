<?php
/**
 * Author: York
 * Email: yorkshp@gmail.com
 * Date: 19.04.2020
 */

namespace App\Cart;


class CartItem
{
    /** @var int */
    protected $count;

    /** @var ProductInterface */
    protected $product;

    public function __construct(\App\ProductInterface $product, int $count = 1)
    {
        $this->product = $product;
        $this->count = $count;
    }

    /**
     * @param int $count
     */
    public function increase(int $count = 1): void
    {
        $this->count += $count;
    }

    /**
     * @param int $count
     */
    public function reduce(int $count = 1): void
    {
        $this->count -= $count;
    }

    /** Return count items or set
     * @param int|null $count
     * @return mixed
     */
    public function count(int $count = null): ?int
    {
        if (!$count)
            return $this->count;

        $this->count = $count;
        return null;
    }

    /** get title
     * @return string
     */
    public function title(): string
    {
        return $this->product->getTitle();
    }

    /** get price
     * @return int
     */
    public function price(): int
    {
        return $this->product->getPrice();
    }

    /** Get id
     * @return int
     */
    public function id(): int
    {
        return  $this->product->getId();
    }

    /**
     * Before delete hoock
     */
    public function beforeDelete(): void { }

    /**
     * Delete item
     */
    public function delete(): void
    {
        $this->beforeDelete();
        $this->product = null;
    }

}
