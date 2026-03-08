<?php

namespace App\Http\Livewire\Frontend\Product;

use Livewire\Component;
use App\Models\Wishlist;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class View extends Component
{
    public $category , $product  , $quantityCount = 1;

    public function addTowishlist($productId)
    {
        if(Auth::check())
        {
            if(Wishlist::where('user_id' , auth()->user()->id)->where('product_id', $productId)->exists())
            {
                session()->flash('message' , 'Already added to wishlist' );
                return false;
            }
            else
            {
                Wishlist::create([
                    'user_id'=>auth()->user()->id,
                    'product_id'=>$productId
                ]);
                $this->emit('wishlistAddedUpdated');
                session()->flash('message' , 'wishlist added successfully' );
                return false;
            }
        }
        else
        {
            session()->flash('message' , 'veillez vous connectez' );
            return false;
        }
    }

    public function decrementQuantity()
    {
        if($this->quantityCount >1){
            $this->quantityCount--;
        }
    }
    
    public function incrementQuantity()
    {
        if($this->quantityCount < 10){
            $this->quantityCount++;
        }
    }

     public  function AddToCart(int $productId)
     {
         if(Auth::check())
         {
            if($this->product->where('id' ,$productId)->where('status', '0')->exists())
            {
                if($this->product->quantity>0)
                {
                    if($this->product->quantity > $this->quantityCount)
                    {
                        cart::create([
                            'user_id'=>auth()->user()->id,
                            'product_id'=>$productId,
                            'quantity'=>$this->quantityCount
                        ]);
                        $this->emit('cartAddedUpdate');
                        $this->dispatchBrowserEvent('message',[
                            'text'=>'Product added to cart',
                            'type'=> 'success',
                            'status'=>200
                        ]);    
                    }else{
                        $this->dispatchBrowserEvent('message',[
                            'text'=>'only'.$this->product->quantity. 'Quantity Available',
                            'type'=> 'warning',
                            'status'=>404
                        ]);
                    }
                }else{
                    $this->dispatchBrowserEvent('message',[
                        'text'=>'out of stock',
                        'type'=> 'warning',
                        'status'=>404
                    ]);
                }
            }else{
                $this->dispatchBrowserEvent('message',[
                    'text'=>'pas de product !',
                    'type'=> 'warning',
                    'status'=>404
                ]);
            }
         }else{
             //session()->flash('message' , 'conerctez vous svp !');
             $this->dispatchBrowserEvent('message',[
                 'text'=>'conerctez vous svp !',
                 'type'=> 'info',
                 'status'=>401
             ] );
         }
     }

    public function mount($category , $product)
    {
        $this->category = $category;
        $this->product = $product;

    }   
    public function render()
    {
        return view('livewire.frontend.product.view',[
            'category'=>$this->category,
            'product'=>$this->product

        ]);
    }
}
















