<?php

namespace App\Http\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartComponent extends Component
{
    public function increaseQuantity($rowId)
    {
        //rowId是表示更新的购物车条目ID，第二个参数可以是数字用于表示更新后的数量，也可以是数组表示更新的属性
        $product = Cart::get($rowId);
        $qty = $product->qty + 1;
        Cart::update($rowId,$qty);
    }

    public function decreaseQuantity($rowId)
    {
        //rowId是表示更新的购物车条目ID，第二个参数可以是数字用于表示更新后的数量，也可以是数组表示更新的属性
        $product = Cart::get($rowId);
        $qty = $product->qty - 1;
        Cart::update($rowId, $qty);
    }


    public function render()
    {
        return view('livewire.cart-component')->layout('layouts.base');
    }
}
