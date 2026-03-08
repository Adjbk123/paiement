<div>
<div>
    <div class="py-3 py-md-5 tout">
        <div class="container">
            <h3>My Cart List</h3>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="sohpping-cart">
                        <div class="card-header d-none d-mb-block d-lg-block d-sm-none">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Procucts</h4>
                                </div>
                                <div class="col-md-1">
                                    <h4>Prix</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Quantity</h4>
                                </div>
                                <div class="col-md-1">
                                    <h4>Total</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>remove</h4>
                                </div>
                            </div>

                            @forelse($cart as $cartItem)
                            @if($cartItem->product)
                            <div class="card-item">
                                <div class="row">
                                    <div class="col-md-6 my-auto">
                                        <a href="{{url('collections/'.$cartItem->product->category->slug.'/'.$cartItem->product->slug)}}">
                                            <label class="product-name">
                                                @if($cartItem->product->productImages)
                                                    <img src="{{asset($cartItem->product->productImages[0]->image )}}" 
                                                alt="" style="width:50px; height:50px;" />
                                                @else
                                                    <img src="" alt="" style="width:50px; height:50px;" />
                                                @endif
                                                {{$cartItem->product->name}}
                                            </label>
                                        </a>
                                    </div>
                                    <div class="col-md-1 my-auto">
                                        <label for="" class="price">{{$cartItem->product->selling_price}}f cfa</label>
                                    </div>
                                    <div class="col-md-2 col-7 mt-2">
                                        <div class="input-group">
                                            <button type="button" class="btn btn1"              wire:click="decrementQuantity({{$cartItem->id}})" wire:loadind.attr="disabled">
                                                <i class="fa fa-minus" ></i> 
                                            </button>
                                            <input type="text"value="{{$cartItem->quantity}}" readonly class="input-quantity" />
                                            <button type="button" class="btn btn1" wire:click="incrementQuantity({{$cartItem->id}})" wire:loadind.attr="disabled">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-1 my-auto">
                                        <label for="" class="price">{{$cartItem->product->selling_price * $cartItem->quantity}}f cfa</label>
                                        @php $TotalPrice += $cartItem->product->selling_price * $cartItem->quantity @endphp
                                    </div>
                                    <div class="col-md-2 col-5 my-auto">
                                        <div class="revmove ">
                                            <button type="butotn" wire:loadind.attr="disabled" wire:click="removeCartItem({{$cartItem->id}})" class="btn btn-danger btn-sm ">
                                                <span wire:loading.Remove wire:target="removeCartItem({{$cartItem->id}})">
                                                    <i class="fa fa-trash"></i> Remove
                                                </span>
                                                <span wire:loading wire:target="removeCartItem({{$cartItem->id}})">
                                                    <i class="fa fa-trash"></i> Removing
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @empty
                                <div class="text-danger">
                                    <h4 class="mt-3">No Cart added</h4>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8  my-md-auto mt-3">
                    <h4>
                         <a href="{{('/collections')}}">Ajouter de Produit</a>
                    </h4>
                </div>
                <div class="col-md-4 mt-3">
                    <div class="shadow-sm bg-white p-3">
                        <h4>Total:
                            <span class="float-end">{{$TotalPrice}} f cfa</span>
                        </h4>
                        <hr>
                        <a href="{{url('/checkout')}}" class="btn btn-warning w-100">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
