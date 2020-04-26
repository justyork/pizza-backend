<?php
/**
 * Author: York
 * Email: yorkshp@gmail.com
 * Date: 21.04.2020
 */

namespace App\Cart;


interface Product
{
    /**
     * @return string
     */
    public function getTitle(): string;

    /**
     * @return int
     */
    public function getPrice(): int;

    /**
     * @return int
     */
    public function getId(): int;

}
