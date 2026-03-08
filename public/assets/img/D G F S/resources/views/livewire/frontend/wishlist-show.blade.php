<div>
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            <h3>My Wishlist</h3>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="sohpping-cart">
                        <div class="card-header d-none d-mb-block d-lg-block d-sm-none">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Procucts</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Prix</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>remove</h4>
                                </div>
                            </div>
                        </div>
                        @forelse($wishlist as $wishlistItem)   
                            @if($wishlistItem->product)    
                            <div class="card-item">
                                <div class="row">
                                    <div class="col-md-6 my-auto">
                                        <a href="{{url('collections/'.$wishlistItem->product->category->slug.'/'.$wishlistItem->product->slug)}}">
                                            <label class="product-name">
                                                <img src="{{$wishlistItem->product->productImages[0]->image}}" 
                                                alt="{{$wishlistItem->product->name}}" style="width:50px; height:50px;" />
                                                {{$wishlistItem->product->name}}
                                            </label>
                                        </a>
                                    </div>
                                    <div class="col-md-2 my-auto">
                                        <label for="" class="price">{{$wishlistItem->product->selling_price}}f cfa</label>
                                    </div>
                                    
                                    <div class="col-md-4 col-12 my-auto">
                                        <div class="revmove ">
                                            <button type="butotn" wire:click="removeWishlistItem({{$wishlistItem->id }})" class="btn btn-danger btn-sm ">
                                                <span wire:loading.Remove wire:target="removeWishlistItem({{$wishlistItem->id }})">
                                                    <i class="fa fa-trash"></i> Remove
                                                </span>
                                                <span wire:loading wire:target="removeWishlistItem({{$wishlistItem->id }})"><i class="fa fa-trash"></i> Removing</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @empty 
                            <h4>No wishlist added</h4>
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>












