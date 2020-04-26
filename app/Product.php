<?php

namespace App;

use App\Helpers\PriceHelper;
use Illuminate\Database\Eloquent\Model;

class Product extends Model implements \App\Cart\Product
{
    use PriceHelper;
    public function toArray()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'text' => $this->text,
            'price_usd' => $this->usd($this->price_from),
            'price' => $this->price_from,
            'size' => $this->size,
            'size_unit' => 'sm',
            'image' => asset('storage/'.$this->image),
            'items' => $this->childrens
        ];
    }

    public function getPriceFromAttribute()
    {
        if ($this->hasChildern()) {
            return $this->childrens()->min('price');
        }

        return $this->price;
    }

    public function childrens()
    {
        return $this->hasMany(Product::class, 'parent_id', 'id');
    }

    public static function scopeParents($query)
    {
        return $query->where('parent_id', 0);
    }

    public function hasChildern()
    {
        return (bool) $this->childrens()->count();
    }


    /**
     * @inheritDoc
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @inheritDoc
     */
    public function getPrice(): int
    {
        return $this->price ?? 0;
    }

    /**
     * @inheritDoc
     */
    public function getId(): int
    {
        return  $this->id;
    }
}
