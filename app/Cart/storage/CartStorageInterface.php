<?php
/**
 * Author: York
 * Email: yorkshp@gmail.com
 * Date: 22.04.2020
 */

namespace App\Cart\storage;


use App\Cart\Delivery;

interface CartStorageInterface
{

    /**
     * @return mixed
     */
    public function getStorage(): CartStorageInterface;

    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return StorageProductInterface[]|null
     */
    public function getProducts(): ?array;

    /** Load delivery
     * @return Delivery|null
     */
    public function getDelivery(): ?Delivery;

    /** Clear cart
     * @return void
     */
    public function clear(): void;

    /**
     * @param int $id
     */
    public function setDelivery(int $id): void;

}
