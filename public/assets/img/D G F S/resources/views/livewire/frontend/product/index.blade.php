<div>
    <div class="row tout">
        <div class="col-md-3">
            @if($category->brands)
            <div class="card">
                <div class="card-header">
                    <h4>Marques</h4>
                </div>
                <div class="card-body">
                    @foreach($category->brands as $brandItem)
                    <label class="d-block">
                        <input type="checkbox" wire:model="brandInputs" value="{{$brandItem->name}}" /> {{$brandItem->name}}
                    </label>
                    @endforeach
                </div>
            </div>
            @endif

            <div class="card mt-3">
                <div class="card-header">
                    <h4>Prix</h4>
                </div>
                <div class="card-body">
                    <label class="d-block">
                        <input type="radio" name="priceSort" wire:model="priceInput" value="high-to-low" />Du Haut
                    </label>
                    <label class="d-block">
                        <input type="radio" name="priceSort" wire:model="priceInput" value="low-to-high" />Du Bas
                    </label>
                </div>
            </div>

        </div>
        <div class="col-md-9">  
            <div class="row">
            @forelse($products as $productItem)

                <div class="col-md-4">
                    <div class="product-card">
                        <div class="product-card-img">
                            @if($productItem->quantity > 0)
                            <label class="stock bg-success">En stock</label>
                            @else
                            <label for="" class="stock bg-danger">Pas en stock</label>
                            @endif
                            @if($productItem->productImages->count()>0)
                            <a href="{{url('/collections/'.$productItem->category->slug.'/'.$productItem->slug)}}">
                                <img src="{{asset($productItem->productImages[0]->image)}}" alt="{{$productItem->name}}" class="img-fluid">
                            </a>
                            @endif
                        </div>
                        <div class="product-card-body">
                            <p class="product-brand">{{$productItem->brand}}</p>
                            <h5 class="product-name">
                                <a href="{{url('/collections/'.$productItem->category->slug.'/'.$productItem->slug)}}">{{$productItem->name}}</a>
                            </h5>
                            <div>
                                <span class="selling-price h4">{{$productItem->selling_price}} f cfa</span><br>
                                <span class="original-price h4">{{$productItem->original_price}} f cfa</span>
                            </div>
                            <div class="mt-2">
                            </div>
                        </div>
                    </div>

                </div>
                @empty
                <div class="col-md-12">
                    <div class="p-2">
                        <h4>{{$category->name}} non disponible </h4>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>









