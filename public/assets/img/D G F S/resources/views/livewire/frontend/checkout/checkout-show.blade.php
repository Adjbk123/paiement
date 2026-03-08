<div>
<div class="py-3 py-md-4 checkout tout">
        <div class="container">
            <h4>Lancez Votre Commande</h4>
            <hr>
            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="shadow bg-white p-3">
                        <h4 class="text-primary">
                            Total  :
                            <span class="float-end">{{$this->totalProductAmount}} f cfa</span>
                        </h4>
                        <hr>
                       
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">
                        <h4 class="text-primary">
                            Basic Information
                        </h4>
                        <hr>
                        @if($this->totalProductAmount != '0')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Nom Complet</label>
                                <input type="text" wire:model.defer="fullname" class="form-control" placeholder="Enter Full Name" />
                                @error('fullname')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Numero De Telephone</label>
                                <input type="number" wire:model.defer="phone" class="form-control" placeholder="Enter Phone Number" />
                                @error('phone')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Email Address</label>
                                <input type="email" wire:model.defer="email" class="form-control" placeholder="Enter Email Address" />
                                @error('email')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Pin-code (Zip-code)</label>
                                <input type="number" wire:model.defer="pincode" class="form-control" placeholder="Enter Pin-code(6 chiffres)" />
                                @error('pincode')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Full Address</label>
                                <textarea wire:model.defer="address" class="form-control" rows="2"></textarea>
                                @error('address')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Select Payment Mode: </label>
                                <div class="d-md-flex align-items-start">
                                    <div class="nav col-md-3 flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        <button wire:loading.attr="disabled" class="nav-link active fw-bold" id="cashOnDeliveryTab-tab" data-bs-toggle="pill" data-bs-target="#cashOnDeliveryTab" type="button" role="tab" aria-controls="cashOnDeliveryTab" aria-selected="true">Payer Cash</button>
                                        <button wire:loading.attr="disabled" class="nav-link fw-bold btn-btn-success" id="onlinePayment-tab" data-bs-toggle="pill" data-bs-target="#onlinePayment" type="button" role="tab" aria-controls="onlinePayment" aria-selected="false">Payment En Ligne</button>
                                    </div>
                                    <div class="tab-content col-md-9" id="v-pills-tabContent">
                                    <div class="tab-pane active show fade" id="cashOnDeliveryTab" role="tabpanel" aria-labelledby="cashOnDeliveryTab-tab" tabindex="0">
                                            <h6>Payer Cash</h6>
                                            <hr/>
                                            <button type="button" wire:loading.attr="disabled" wire:click="codOrder" class="btn btn-primary">
                                                <span wire:loading.remove wire:target="codOrder">
                                                    Commander (Payer en liquide)
                                                </span>
                                                <span wire:loading wire:target="codOrder">
                                                    Commande en cours
                                                </span>
                                            </button>
                                        </div>
                                        <div class="tab-pane fade" id="onlinePayment" role="tabpanel" aria-labelledby="onlinePayment-tab" tabindex="0">
                                            <h6>Mode De payement en Ligne</h6>
                                            <hr/>
                                            <button type="button" wire:loading.attr="disabled"  class="btn btn-warning">Payer en Ligne (Online Payment)</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        @else
                        <div class="card card-body shadow text-center py-md-5 ">
                            <h4></h4>
                            <a href="{{url('collections')}}" class="btn btn-warning">Ajouter des Produites</a>
                        </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

