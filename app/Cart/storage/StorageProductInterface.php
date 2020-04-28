<?php
/**
 * Author: York
 * Email: yorkshp@gmail.com
 * Date: 22.04.2020
 */

namespace App\Cart\storage;


use App\Cart\ProductInterface;

interface StorageProductInterface
{
    /** Set count
     * @param int $count
     */
    public function setCount(int $count): void;

    /** Get id
     * @return int
     */
    public function getId(): int;

    /**
     * @return int
     */
    public function getCount(): int;

    /**
     * @return int
     */
    public function getProduct(): ProductInterface;

    /**
     * Remove storage product
     */
    public function remove(): void ;
}
