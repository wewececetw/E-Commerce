<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class ShopComponent extends Component
{
    public function store($product_id,$product_name,$product_price)
    {
        //當更新一個 belongsTo 關聯時，你可以使用 associate 方法。此方法會設定外鍵至下層模型：
        Cart::add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        session()->flash('success_message','商品增加到購物車');
        return redirect()->route('product.cart');
    }
    public function render()
    {
        $products = Product::paginate(12);
        return view('livewire.shop-component',[ 'products' => $products ])->layout('layouts.base');
    }
}
