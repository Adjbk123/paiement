    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModal">Suppresion du Categorie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <form wire:submit.prevent="destroyCategorty">
                    <div class="modal-body">
                        <h6>Vous etes sur de vouloir suprimer cette categories ?</h6>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Oui . Suprime</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
        @if (session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif
        <div class="card m-4 shadow">
            <div class="card-header">
                <h4>Les Categories
                    <a href="{{ url('admin/category/create')}}" class="btn btn-primary float-end btn-sm">Ajouter Des Categories</a>
                </h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category )
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            <td>{{$category->status == '1' ? 'Hidden' : 'Visible'}}</td>
                            <td>
                                <a href="{{url('admin/category/'.$category->id.'/edit')}}"class="btn btn-success">Edit</a>
                                <a href="#" wire:click="deleteCategory({{$category->id}})" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Suprimer</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@push('script')
    <script>
        window.addEventListener('close-modal' , event=>{

          $('#deleteModal').modal('hide');      

     });

    </script>
@endpush


















