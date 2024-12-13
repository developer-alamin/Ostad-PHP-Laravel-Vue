@extends("layout.app")

@section("content")
	<div class="col-8 mt-2 m-auto">
		<div class="card">
			<div class="card-header">
				<a href="{{ route("products.index") }}" class="btn btn-outline-primary">All Products</a>
			</div>
			<div class="card-body">
				@if($errors->has('product_id'))
				{{ $errors }}
				@endif
				@if(Session::has("success"))
				<div class="alert alert-success" role="alert">
				  <b>{{ Session::get("success") }}</b>
				</div>
				@endif
				<form action="{{ route("products.store") }}" enctype='multipart/form-data' method="post">
					@csrf
					<div class="row">
						<div class="col-6">
							<label for="photo">Photo:</label>
							<input type="file" name="photo" id="photo" class="form-control">
						</div>
						<div class="col-6">
							<label for="product_id">Product Id:</label>
							<input type="text" name="product_id" id="product_id" class="form-control" placeholder="Enter Product Id.." required>
							
						</div>
						<div class="col-6">
							<label for="name">Name:</label>
							<input type="text" name="name" id="product_id" class="form-control" placeholder="Enter Product Id.." required>
						</div>
						<div class="col-6">
							<label for="price">Price:</label>
							<input type="text" name="price" id="price" class="form-control" placeholder="Enter Price.." required>
						</div>
						<div class="col-6">
							<label for="stock">Stock:</label>
							<input type="number" name="stock" id="stock" class="form-control" placeholder="Enter Stock..">
						</div>
						<div class="col-6">
							<label for="description">Description:</label>
							<input type="text" name="description" id="description" class="form-control" placeholder="Enter Description..">
						</div>
					</div>
					<div class="row mt-3">
						<div class="col-2 ms-auto">
							<button type="submit" class="btn btn-outline-primary form-control">Save</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection

@push("scripts")
<script type="text/javascript"> 
    setTimeout(function () { 
        // Closing the alert 
        $('.alert').hide(500);
    }, 4000); 
</script> 
@endpush