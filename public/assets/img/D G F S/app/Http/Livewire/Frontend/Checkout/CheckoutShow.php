<?php

namespace App\Http\Livewire\Frontend\Checkout;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Orderitem;

class CheckoutShow extends Component
{

    public $carts , $totalProductAmount = 0;

    public $fullname , $email , $phone , $pincode , $address , $payement_mode = NULL , $payement_id = NULL; 

    public function rules()
    {
        return[
            'fullname'=>'required|string|max:121',
            'email'=>'required|email|max:121',
            'phone'=>'required|string|max:10|min:8',
            'pincode'=>'required|string|max:6|min:6',
            'address'=>'required|string|max:500',
        ];
    }
    public function  placeOrder()
    {
        $this->validate();

        $order = Order::create([
            'user_id'=>auth()->user()->id,
            'tracking_no' =>'gesmac-'.Str::random(10),
            'fullname' =>$this->fullname,
            'email' =>$this->email,
            'phone'=>$this->phone,
            'pincode' =>$this->pincode,
            'address' =>$this->address,
            'status_message' => 'in progress',
            'payement_mode' => $this->payement_mode,
            'payement_id'=>$this->payement_id,
        ]);
        foreach ($this->carts as $cartItem) {
            $orderItems = Orderitem::create([
                'order_id'=>$order->id,
                'product_id'=>$cartItem->product_id ,
                'quantity'=>$cartItem->quantity,
                'price'=>$cartItem->product->selling_price,
            ]);
        $this->totalProductAmount += $cartItem->product->selling_price * $cartItem->quantity;
        }
        return $order;
    }

    public function codOrder()
    {
        $this->payement_mode = 'cash on Delivery';
        $codOder = $this->placeOrder();
        if($codOder){
            Cart::where('user_id' , auth()->user()->id)->delete();
            session()->flash('message', 'order placed successfully');
            $this->dispatchBrowserEvent('message',[
                'text'=>'order placed successfully',
                'type'=> 'success',
                'status'=>200
            ]);
            return redirect()->to('thank-you');
        }else{
            $this->dispatchBrowserEvent('message',[
                'text'=>'Something Went Wrong',
                'type'=> 'error',
                'status'=>500
            ]);
        }
    }

    public function totalProductAmount()
    {
        $this->totalProductAmount = 0 ;
        $this->carts = Cart::where('user_id' , auth()->user()->id)->get();
        foreach ($this->carts as $cartItem){
          $this->totalProductAmount += $cartItem->product->selling_price * $cartItem->quantity;
        }
        return $this->totalProductAmount;
    }
    public function render()
    {
        $this->fullname = auth()->user()->name;
        $this->email = auth()->user()->email;

        $this->totalProductAmount = $this->totalProductAmount();
        return view('livewire.frontend.checkout.checkout-show', [
            'totalProductAmount'=> $this->totalProductAmount
        ]);
    }
}
