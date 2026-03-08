<div>
    @include('livewire.admin.brand.modal-form') 
        <div class="card m-4 shadow">
            <div class="card-header">
                <h4>
                    Liste Des Marques 
                    <a href="#" data-bs-toggle="modal" data-bs-target="#addBrandModal" class="btn btn-primary btn-sm float-end"><i class="fa fa-plus"></i> Ajouter Des Marques</a>
                </h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Categories</th>
                            <th>Limace</th>
                            <th>status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($brands as $brand)
                        <tr>
                            <td>{{$brand->id}}</td>
                            <td>{{$brand->name}}</td>
                            <td>
                                @if($brand->category)
                                {{$brand->category->name}}
                                @else
                                pas de categorie
                                @endif
                            </td>
                            <td>{{$brand->slug}}</td>
                            <td>{{$brand->status == '1' ? 'hidden' : 'visible'}}</td>
                            <td>
                                <a href="#" wire:click="editBrand({{$brand->id}})" data-bs-toggle="modal" data-bs-target="#updateBrandModal" class="btn btn-sm btn-success">Modifier</a>
                                <a href="#" wire:click="deleteBrand({{$brand->id}})" data-bs-toggle="modal" data-bs-target="#deleteBrandModal"  class="btn btn-sm btn-danger">Suprimer</a>
                            </td>
                        </tr>
                    @empty
                    <tr>
                        <td colspan="5">Pas de Marques Disponibles Pour L'instant</td>
                    </tr>
                    @endforelse
                    </tbody>
                </table>
                <div>
                    {{ $brands->links()}}
                </div>
            </div>
        </div>
    </div>


@push('script')
    <script>
        window.addEventListener('close-modal' , event=>{

          $('#addBrandModal').modal('hide');
          $('#updateBrandModal').modal('hide'); 
          $('#deleteBrandModal').modal('hide');     

     });

    </script>
@endpush



















