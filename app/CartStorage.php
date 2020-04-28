<?php

namespace App;

use App\Cart\DeliveryInterface;
use App\Cart\storage\CartStorageInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CartStorage extends Model implements CartStorageInterface
{
    protected $fillable = ['is_sold', 'delivery_id'];

    /**
     * @return CartStorage
     */
    public static function current()
    {
        if (Auth::check()) {
            return Client::current()->cart;
        }

        return Visitor::current()->loadCart();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(CartStorageItem::class, 'cart_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function delivery()
    {
        return $this->hasOne(\App\DeliveryInterface::class, 'id', 'delivery_id');
    }


    /**
     * @inheritDoc
     */
    public function getStorage(): CartStorageInterface
    {
        return self::current();
    }


    /**
     * @inheritDoc
     */
    public function getProducts(): array
    {
        return $this->items->all();
    }

    /**
     * @inheritDoc
     */
    public function getDelivery(): ?DeliveryInterface
    {
        return $this->delivery ?? null;
    }

    /**
     * @inheritDoc
     */
    public function clear(): void
    {
        $this->items()->delete();
    }

    /**
     * @inheritDoc
     */
    public function getId(): int
    {
        return $this->id;
    }


    public static function createNew()
    {
        return self::create(['is_sold' => 0]);
    }

    /**
     * @inheritDoc
     */
    public function setDelivery(int $id): void
    {
        $this->update([
            'delivery_id' => $id
        ]);
    }
}
