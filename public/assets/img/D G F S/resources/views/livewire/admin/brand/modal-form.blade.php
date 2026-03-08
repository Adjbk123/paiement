<!-- Modal -->
<div wire:ignore.self class="modal fade" id="addBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModal">Ajouter Des Marques</h5>
        <button type="button" class="btn-close" wire:click="closeModal"  data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
	<form wire:submit.prevent="storeBrand()">
		<div class="modal-body">
			<div class="form-group md-3">
				<label for="">Selectionner La Categories</label>
				<select wire:model.defer="category_id" required class="form-control">
					<option value="">--Select category--</option>
					@foreach($categories as $cateItem)
					<option value="{{$cateItem->id}}">{{$cateItem->name}}</option>
					@endforeach
				@error('category_id') <small class="text-danger">{{$message}}</small>@enderror
				</select>
			</div>
			<div class="form-group  mb-3">
				<label>Nom</label>
				<input type="text"   wire:model.defer="name" class="form-control"/>
					@error('name') <small class="text-danger">{{$message}}</small> @enderror
			</div>
			<div class="form-group  mb-3">
				<label>Limace</label>
				<input type="text"  wire:model.defer="slug" class="form-control"/>
					@error('slug') <small class="text-danger">{{$message}}</small> @enderror
			</div>
			<div class="form-group  mb-3">
				<label>Status</label>
				<input type="checkbox" wire:model.defer="status" /> check= hidden , un-check=Visible
				@error('status') <small class="text-danger">{{$message}}</small> @enderror
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-info">Enregistrer</button>
			</div>
		</div>
	</form>
    </div>
  </div>
</div>

<!-- brand update-->
<div wire:ignore.self class="modal fade" id="updateBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      	<div class="modal-header">
        	<h5 class="modal-title" id="exampleModal">Modifier La Marques</h5>
        	<button type="button" class="btn-close" wire:click="closeModal"  data-bs-dismiss="modal" aria-label="Close"></button>
      	</div>
		<div wire:loading class="p-2">
			<div class="spinner-border text-primary " role="status">
				<span  class="visually-hidden"></span>
			</div>
			loading...
		</div>
      	<div wire:loading.remove>
			<form wire:submit.prevent="updateBrand">
      		<div class="modal-body">
			  <div class="form-group md-3">
				<label for="">Selectionner la Categories</label>
				<select wire:model.defer="category_id" required class="form-control">
					<option value="">--Select category--</option>
					@foreach($categories as $cateItem)
					<option value="{{$cateItem->id}}">{{$cateItem->name}}</option>
					@endforeach
				@error('category_id') <small class="text-danger">{{$message}}</small>@enderror
				</select>
			</div>
				<div class="form-group  mb-3">
					<label>Nom</label>
					<input type="text"   wire:model.defer="name" class="form-control"/>
					@error('name') <small class="text-danger">{{$message}}</small> @enderror
				</div>
				<div class="form-group  mb-3">
					<label>Limace</label>
					<input type="text"  wire:model.defer="slug" class="form-control"/>
					@error('slug') <small class="text-danger">{{$message}}</small> @enderror
				</div>
				<div class="form-group  mb-3">
					<label>Status</label>
					<input type="checkbox" wire:model.defer="status" style="with:70px ; heigh=70px ;" /> check= hidden , un-check=Visible
					@error('status') <small class="text-danger">{{$message}}</small> @enderror
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-info">Modifier</button>
				</div>
			</div>
      	</form>
		</div>
      </div>
    </div>
  </div>
</div>

<!-- brand delete-->











