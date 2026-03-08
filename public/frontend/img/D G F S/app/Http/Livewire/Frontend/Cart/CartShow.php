<?php

namespace App\Http\Livewire\Frontend\Cart;

use Livewire\Component;
use App\Models\Cart;

class CartShow extends Component
{
    public $cart , $TotalPrice = 0;

    public function incrementQuantity(int $cartId)
    {
        $cartData = Cart::where('id' , $cartId)->where('user_id', auth()->user()->id)->first();

        if($cartData)
        {
            if($cartData->product->quantity > $cartData->quantity){
                $cartData->increment('quantity');
                $this->dispatchBrowserEvent('message',[
                'text'=>'quantity Updated',
                'type'=> 'success',
                'status'=>200
            
                ]);
            } else{
                $cartData->increment('quantity');
                $this->dispatchBrowserEvent('message',[
                'text'=>'only'.$cartData->product->quantity.'Quantity Available',
                'type'=> 'success',
                'status'=>200
                ]);
            }
        }
        else{
            $this->dispatchBrowserEvent('message',[
                'text'=>'something went Wrong!',
                'type'=> 'error',
                'status'=>404
            ]);
        }
    }
    public function decrementQuantity(int $cartId)
    {
        $cartData = Cart::where('id' , $cartId)->where('user_id', auth()->user()->id)->first();
        if($cartData)
        {
            if($cartData->product->quantity > $cartData->quantity){
                $cartData->decrement('quantity');
                $this->dispatchBrowserEvent('message',[
                'text'=>'quantity Updated',
                'type'=> 'success',
                'status'=>200
            
                ]);
            } else{
                $cartData->increment('quantity');
                $this->dispatchBrowserEvent('message',[
                'text'=>'only'.$cartData->product->quantity.'Quantity Available',
                'type'=> 'success',
                'status'=>200
                ]);
            }
        }
        else{
            $this->dispatchBrowserEvent('message',[
                'text'=>'something went Wrong!',
                'type'=> 'error',
                'status'=>404
            ]);
        }
    }
    public function removeCartItem(int $cartId)
    {
        $cartRemoveData = Cart::where('user_id' , auth()->user()->id)->where('id' , $cartId)->first();
        if($cartRemoveData){
            $cartRemoveData->delete();
            $this->emit('CartAddedUpdated');
            $this->dispatchBrowserEvent('message',[
                'text'=>'cart removing successfully',
                'type'=> 'success',
                'status'=>500
            ]);
        }else{
            $this->dispatchBrowserEvent('message',[
                'text'=>'something Went Wrong',
                'type'=> 'error',
                'status'=>200
            ]);
        }
    }

    public function render()
    {
        $this->cart = Cart::where('user_id' , auth()->user()->id)->get();
        return view('livewire.frontend.cart.cart-show' , [
            'cart' =>$this->cart
        ]);
    }
}
