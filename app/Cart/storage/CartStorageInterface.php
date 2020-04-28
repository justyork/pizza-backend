<?php
/**
 * Author: York
 * Email: yorkshp@gmail.com
 * Date: 22.04.2020
 */

namespace App\Cart\storage;


use App\Cart\DeliveryInterface;

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
     * @return DeliveryInterface|null
     */
    public function getDelivery(): ?DeliveryInterface;

    /** Clear cart
     * @return void
     */
    public function clear(): void;

    /**
     * @param int $id
     */
    public function setDelivery(int $id): void;

}
