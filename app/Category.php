<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public function toArray()
    {
        return [
            'title' => $this->title,
            'items' => $this->products()->parents()->get()
        ];
    }

    public function products()
    {
        return $this->hasMany(ProductInterface::class, 'category_id', 'id');
    }
}
