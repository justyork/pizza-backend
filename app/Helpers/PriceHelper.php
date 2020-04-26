<?php
/**
 * Author: York
 * Email: yorkshp@gmail.com
 * Date: 24.04.2020
 */

namespace App\Helpers;


trait PriceHelper
{

    /**
     * @param int $price
     * @return float|int
     */
    public function usd(int $price, string $prefix = '')
    {
        return $prefix . '$' . $this->priceFormat($price / 100);
    }

    /**
     * @param int $price
     * @return float|int
     * TODO: подгрузка корректного курса евро
     */
    public function eur(int $price, string $prefix = '')
    {
        return $prefix . $this->priceFormat($price / 1.08 / 100);
    }

    private function priceFormat(float $price)
    {
        return number_format($price, 2);
    }


}
