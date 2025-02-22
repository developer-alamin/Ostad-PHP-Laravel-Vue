@extends('layout.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-4">
                    @if (Session::has('success'))
                    <div class="alert alert-primary" role="alert">
                       {{Session::get('success')}}
                    </div>  
                    @endif
                </div>
            </div>
            <div class="d-flex align-items-center py-3">
                <h6 class="card-title">All Brands</h6>
                <div class="d-flex gap-2 ms-auto">
                    <form action="{{ route('brand.index') }}" method="GET">
                        <div class="input-group">
                            <input type="search" name="search" class="form-control" placeholder="Search" value="{{ old('search', request()->query('search')) }}">
                            <button class="btn btn-outline-primary" type="submit" id="button-addon">Search</button>
                        </div>
                    </form>
                    <button id="add_new" class="btn btn-outline-primary">Add New</button>
                </div>
            </div>
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-light table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Sr</th>
                                    <th>Name</th>
                                    <th>Photo</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @if ($brands->count() > 0)
                            <tbody>
                                @foreach ($brands as $brand)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$brand->name}}</td>
                                        <td><img src="{{$brand->photo}}" class="custom_table_img" alt=""></td>
                                        <td>{{$brand->status}}</td>
                                        <td>
                                          <div class="d-flex">
                                            <button data-id="{{$brand->id}}" class="btn me-2 btn-outline-primary edit_brand_btn">
                                                <i class="fas fa-pencil"></i>
                                           </button>
                                           <div class="status-change  me-2">
                                            <form action="{{route('brandstatuschange')}}" method="POST"> 
                                                @csrf
                                                <input required type="hidden" name="id" value="{{$brand->id}}">
                                                <input type="hidden" name="status" value="{{$brand->status}}">
                                               
                                               
                                                <button type="submit" class="btn {{($brand->status == 'active') ? 'btn-outline--success':'btn-outline--danger'}} btn-outline-success ">
                                                    <i class="fas fa-eye{{($brand->status == 'active') ? '':'-slash'}}"></i>
                                                    {{($brand->status == 'active') ? @lang('Active'):@lang('Deactive')) }}
                                                </button>   
                                            </form>
                                           </div>
                                            <button data-href="{{ route('brand.destroy',$brand) }}" class="btn btn-outline-danger confirm-delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                          </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            @else
                             <tfoot>
                                <tr class="text-center">
                                    <td colspan="5">Brand Data Not Found</td>
                                </tr>
                            </tfoot>   
                            @endif
                            
                        </table>
                    </div>
                    {{ $brands->appends(request()->input())->links("pagination::bootstrap-5") }}

                </div>
            </div>
        </div>
    </div>

@section('modal')
    @include('Modal.confirm-delete');
@endsection


<!-- Brand New Modal -->
<div class="modal fade new_brand_modal" id="new_brand_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-zoom">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5">Add New Brand</h1>
          <img src="" id="imagePreview" style="width:50px;height:50px;display:none;margin:auto;" alt="">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
       <form action="{{route('brand.store')}}" method="post" enctype="multipart/form-data">
       @csrf
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Brand Name">
                </div>
                <div class="col-12">
                    <label for="file">Photo:</label>
                    <input type="file" accept="image/*" name="file" id="file" class="file form-control">
                </div>
                <div class="col-12">
                    <label for="status" >Status:</label>
                    <select name="status" id="status" class="form-control">
                        <option value="active">Active</option>
                        <option value="in-active">In-active</option>
                    </select>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn form-control btn-primary">Submit</button>
          </div>
       </form>
      </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade edit_brand_modal" id="edit_brand_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-zoom">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5">Edit Brand</h1>
          <img src="" class="upBrandImg imagePreview" style="width:50px;height:50px;margin:auto;display:none;" alt="">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="lds-hourglass"></div>
       <form action="" class="updateForm" method="post" enctype="multipart/form-data">
         @csrf
         @method('put')
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Brand Name">
                </div>
                <div class="col-12">
                    <label for="file">Photo:</label>
                    <input type="file" accept="image/*" name="file" id="file" class="file form-control">
                </div>
                <div class="col-12">
                    <label for="status" >Status:</label>
                    <select name="status" id="status" class="form-control">
                        <option value="active">Active</option>
                        <option value="in-active">In-active</option>
                    </select>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn form-control btn-primary">Submit</button>
          </div>
       </form>
      </div>
    </div>
</div>



@endsection

@push('scripts')
    <script>
       
        $(document).ready(function(){
            $("#add_new").click(function (e) {
				e.preventDefault();
				$(".new_brand_modal").modal('show');
			});

            $(".edit_brand_btn").click(function(e){
                e.preventDefault();
                $(".edit_brand_modal").modal('show');
               const id = $(this).attr('data-id');
               brandShow(id);
            });

            function brandShow(id) {
                const loadding = $(".lds-hourglass");
                const updateForm = $(".updateForm");
                const name = updateForm.find('#name');
                const status = updateForm.find('#status');
                const image = $(".upBrandImg");
                $.ajax({
                    url: "{{ route('brand.edit', ':id') }}".replace(':id', id), // Replace :id with the actual ID
                    type: "GET",
                    success: function (res) {
                        loadding.hide();
                        name.val(res.name)
                        status.val(res.status)
                        if (res.photo) {
                            image.show();
                            image.attr('src',res.photo)
                        }
                        $("form.updateForm").attr("action", "{{ route('brand.update', ':id') }}".replace(':id', res.id));
                    
                    },
                    error: function (xhr) {
                        loadding.hide();
                        console.error(xhr.responseText); // Log any errors to the console
                    }
                });
            }
             // Event listener for the file input change event
            $('.new_brand_modal .file').on('change', function(event) {
                var file = event.target.files[0];  // Get the first selected file
                if (file) {
                var reader = new FileReader();  // Create a FileReader object

                reader.onload = function(e) {
                    // Set the src of the image preview to the file content
                    $('#imagePreview').attr('src', e.target.result);
                    $('#imagePreview').show();  // Show the image preview
                };

                reader.readAsDataURL(file);  // Read the file as a data URL
                }
            });

            // Event listener for the file input change event
            $('.edit_brand_modal .file').on('change', function(event) {
                var file = event.target.files[0];  // Get the first selected file
                if (file) {
                var reader = new FileReader();  // Create a FileReader object

                reader.onload = function(e) {
                    // Set the src of the image preview to the file content
                    $('.upBrandImg').attr('src', e.target.result);
                    $('.upBrandImg').show();  // Show the image preview
                };

                reader.readAsDataURL(file);  // Read the file as a data URL
                }
            });
        })
    </script>
@endpush