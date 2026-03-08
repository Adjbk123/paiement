<?php

namespace App\Http\Livewire\Frontend\Cart;

use Livewire\Component;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class Cartcount extends Component
{
    public  $cartCount;

    protected $listeners = ['cartAddedUpdate' => 'checkCartCount'];

    public function checkCartCount()
    {
        if(Auth::check()){
            return $this->cartCount = Cart::where('user_id' , auth()->user()->id)->count();
        }else{
            return $this->cartCount = 0;
        }
    }

    public function render()
    {
        $this->cartCount =$this->checkCartCount();
        return view('livewire.frontend.cart.cartcount' , [
            'cartCount'=> $this->cartCount
        ]);
    }
}
