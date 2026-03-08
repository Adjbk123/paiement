<div>
    <div class="py-3 py-md-5  tout">
        <div class="container">
            <div class="row">
                <div class="col-md-5 mt-3">
                    <div class="bg-white border" wire:ignore>
                        @if($product->productImages)
                        <!--<img src="{{asset($product->productImages[0]->image)}}" class="w-100 img-fluid" alt="Img">-->
                        <div class="exzoom" id="exzoom">

                        <div class="exzoom_img_box">
                            <ul class='exzoom_img_ul'>
                                @foreach ($product->productImages as $itemImg)
                                <li><img src="{{asset($itemImg->image)}}"/></li>
                                @endforeach
                            </ul>
                            </div>
                            <div class="exzoom_nav"></div>
                            <p class="exzoom_btn">
                                <a href="javascript:void(0);" class="exzoom_prev_btn"> < </a>
                                <a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
                            </p>
                        </div>

                        @else
                            Pas d'image
                        @endif
                    </div>
                </div>
                <div class="col-md-7 mt-3">
                    <div class="product-view">
                        <h4 class="product-name">
                            {{$product->name}}
                            <label class="label-stock bg-success">In Stock</label>
                        </h4>
                        <hr>
                        <p class="product-path">
                            Home /{{$product->category->name}} / {{$product->name}}
                        </p>
                        <div>
                            <span class="selling-price">{{$product->selling_price}}f cfa</span>
                            <span class="original-price">{{$product->original_price}}f cfa</span>
                        </div>
                        <div class="mt-2">
                            <div class="input-group">
                                <span class="btn btn1" wire:click="decrementQuantity"><i class="fa fa-minus"></i></span>
                                <input type="text" wire:model="quantityCount" value="{{$this->quantityCount}}" readonly class="input-quantity" />
                                <span class="btn btn1" wire:click="incrementQuantity"><i class="fa fa-plus"></i></span>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="button" wire:click="AddToCart({{$product->id}})" class="btn btn1"> 
                                <i class="fa fa-shopping-cart"></i> 
                                Add Panier
                            </button>
                            <button type="button" wire:click="addTowishlist({{$product->id}})" class="btn btn1">
                                <span wire:loading.remove wire:target="addTowishlist" >
                                    <i class="fa fa-heart"></i> 
                                    Add To Wishlist
                                </span>
                                <span wire:loading wire:target="addTowishlist">Adding...</span>
                            </button>
                        </div>
                        <div class="mt-3">
                            <h5 class="mb-0">Small Description</h5>
                            <p>
                                {!!$product->small_description!!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h4>Description</h4>
                        </div>
                        <div class="card-body">
                            <p>
                            {!!$product->description!!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="py-5 ">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Les Produits Cimilaires</h3>
                <div class="underline1"></div>
                <div class="underline mb-5"></div>
            </div>
            @forelse($category->products as $relatedproductItem)
            <div class="col-md-3">
                <div class="product-card ">
                        <div class="product-card-img">
                            <label for="" class="stock bg-danger">New</label>
                            @if($relatedproductItem->productImages->count()>0)
                                <a href="{{url('/collections/'.$relatedproductItem->category->slug.'/'.$relatedproductItem->slug)}}">
                                    <img src="{{asset($relatedproductItem->productImages[0]->image)}}" alt="{{$relatedproductItem->name}}" class="img-fluid">
                                </a>
                            @endif
                        </div>
                        <div class="product-card-body">
                            <p class="product-brand">{{$relatedproductItem->brand}}</p>
                            <h5 class="product-name">
                                <a href="{{url('/collections/'.$relatedproductItem->category->slug.'/'.$relatedproductItem->slug)}}">{{$relatedproductItem->name}}</a>
                            </h5>
                            <div>
                                <span class="selling-price">{{$relatedproductItem->selling_price}} f cfa</span><br>
                                <span class="original-price">{{$relatedproductItem->original_price}} f cfa</span>
                            </div>
                            <div class="mt-2">
                            </div>
                        </div>
                    </div>
            </div>
            @empty
            <div class="p-2 col-md-12">
                <h4>{{$category->name}} non disponible </h4>
            </div>
            @endforelse  

        </div>
    </div>
</div>

@push('scripts')

<script>
    $(function(){

        $("#exzoom").exzoom({
        "navWidth": 60,
        "navHeight": 60,
        "navItemNum": 5,
        "navItemMargin": 7,
        "navBorder": 1,
        "autoPlay": false,
        "autoPlayTimeout": 2000
        });

    });
</script>

@endpush