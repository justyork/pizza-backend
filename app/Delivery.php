<?php

namespace App;

use App\Helpers\PriceHelper;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model implements \App\Cart\Delivery
{

    use PriceHelper;

    public function toArray()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'price' => $this->price,
            'price_usd' => $this->usd($this->price),
            'free_from' => $this->free_from,
        ];
    }

    /**
     * @inheritDoc
     */
    public function getPrice(): int
    {
        return  $this->price;
    }

    /**
     * @inheritDoc
     */
    public function getTitle(): string
    {
        return  $this->name;
    }

    /**
     * @inheritDoc
     */
    public function getFreeFrom(): int
    {
        return  $this->free_from;
    }

    /**
     * @inheritDoc
     */
    public function getId(): int
    {
        return  $this->id;
    }
}
