<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class DetailsComponent extends Component
{
    public $product;
    public $slug;
    public $quantity = [];

    public function mount($slug){
        
        $this->slug = $slug;
        $this->product = Product::where('slug', $this->slug)->first();
        
        $this->quantity[$this->product->id] = 1;
        
    }

    public function reduce($product_id)
    {
        if( $this->quantity[$product_id] > 1)
        {
            $this->quantity[$product_id] -= 1;
        }
       
        
    }
    public function increase($product_id)
    {
        if ($this->quantity[$product_id] < 100) {
            $this->quantity[$product_id] += 1;
        }
        
    }

    public function store($product_id, $product_name, $product_price)
    {
        //當更新一個 belongsTo 關聯時，你可以使用 associate 方法。此方法會設定外鍵至下層模型：
        // When a single item is added當單個item被添加
        Cart::add($product_id, $product_name, $this->quantity[$product_id], $product_price)->associate('App\Models\Product');
        session()->flash('success_message', '商品增加到購物車');
        return redirect()->route('product.cart');
    }

    public function render()
    {
        
        //inRandomOrder 隨機排列
        $popular_products = Product::inRandomOrder()->limit(4)->get();
        $related_products = Product::where('category_id', $this->product->category_id)->inRandomOrder()->limit(5)->get();
        return view('livewire.details-component',['product' => $this->product , 'popular_products' => $popular_products , 'related_products' => $related_products])->layout('layouts.base');
    }
}
