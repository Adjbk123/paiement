<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Wishlist;

class WishlistShow extends Component
{
    public function removeWishlistItem(int $wishlistId )
    {
        $wishlist = Wishlist::where('user_id', auth()->user()->id)->where('id' , $wishlistId)->delete();
        //session()->flash('message' , 'Wishlist Item removed successfully');
        $this->emit('wishlistAddedUpdated');

        $this->dispatchBrowserEvent('message' , [
            'text' => 'Wishlist Added successfully',
            'type' => 'success',
            'status'=> '200'
        ]);
    }
    public function render()
    {
       $wishlist = Wishlist::where('user_id', auth()->user()->id)->get();
        return view('livewire.frontend.wishlist-show' , [
           'wishlist'=> $wishlist,
        ]);
    }
}
