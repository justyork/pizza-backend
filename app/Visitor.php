<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class Visitor extends Model
{
    protected $fillable = ['cart_id', 'uid'];

    /** Find cart or create new
     * @return CartStorage|\Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cart()
    {
        return $this->hasOne(CartStorage::class, 'id', 'cart_id');
    }

    public function loadCart()
    {
        if ($this->cart)
            return $this->cart;

        $cart = CartStorage::createNew();
        $this->update(['cart_id' => $cart->id]);
        return $cart;
    }



    /** Return current visitor
     * @return \Illuminate\Database\Eloquent\Collection|Model|mixed
     */
    public static function current()
    {
        $id = Cookie::get('visitor', false);
        if ($id) {
            $visitor = Visitor::byUid($id);
            if ($visitor)
                return $visitor;
        }
        return self::newVisitor();
    }

    /** Get visitor by uid
     * @param $id
     * @return mixed
     */
    public static function byUid($id)
    {
        return self::where('uid', $id)->first();
    }

    /** Create new visitor
     * @return \Illuminate\Database\Eloquent\Collection|Model|mixed
     */
    public static function newVisitor()
    {
        $visitor = factory(Visitor::class)->create();
        Cookie::queue('visitor', $visitor->uid, 3600*24*60);
        return  $visitor;
    }
}
