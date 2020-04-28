<?php
/**
 * Author: York
 * Email: yorkshp@gmail.com
 * Date: 19.04.2020
 */

namespace App\Cart;

use PHPUnit\Framework\IncompleteTest;

/**
 * Interface Delivery
 * @package App\Cart
 */
interface DeliveryInterface
{

    /**
     * @return int
     */
    public function getPrice(): int;

    /**
     * @return string
     */
    public function getTitle(): string;

    /**
     * @return int
     */
    public function getFreeFrom(): int;

    /**
     * @return int
     */
    public function getId(): int;

}
