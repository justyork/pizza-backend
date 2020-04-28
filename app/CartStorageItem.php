<?php

namespace App;

use App\Cart\storage\StorageProductInterface;
use Illuminate\Database\Eloquent\Model;

class CartStorageItem extends Model implements StorageProductInterface
{

    protected $fillable = ['cart_id', 'product_id', 'count', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function product()
    {
        return $this->hasOne(ProductInterface::class, 'id', 'product_id');
    }

    /**
     * @inheritDoc
     */
    public function setCount(int $count): void
    {
        $this->update(['count' => $count]);
    }

    /**
     * @inheritDoc
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @inheritDoc
     */
    public function remove(): void
    {
        $this->delete();
    }

    /**
     * @inheritDoc
     */
    public function getProduct(): \App\Cart\ProductInterface
    {
        return $this->product()->first();
    }
}
