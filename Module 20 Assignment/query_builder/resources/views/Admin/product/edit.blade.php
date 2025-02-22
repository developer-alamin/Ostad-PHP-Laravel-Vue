@extends("layout.app")
@section("content")
	<div class="col-12 mt-2 m-auto">
		<div class="card">
			<div class="card-header d-flex align-items-center">
				<a href="{{ route("products.index") }}" class="btn btn-outline-primary">All Products</a>
				<div class="ms-auto">
					<img src="{{ $product->image ? asset($product->image) : '' }}" class="product_up_photo me-auto" alt="{{ $product->name }}">
				</div>
			</div>
			<div class="card-body">
				@if(Session::has("success"))
				<div class="alert alert-success" role="alert">
				  <b>{{ Session::get("success") }}</b>
				</div>
				@endif
				<form action="{{ route("products.update", $product->id) }}" enctype='multipart/form-data' method="post">
					@csrf
					@method('PUT')
					<div class="row">
						<h6 class="mb-3">Product Information:</h6><br>
						<div class="col-6">
							<label for="photo">Photo:</label>
							<input type="file" name="photo" accept="image/*" id="photo" class="form-control">
							@error('photo')
								<span class="error">{{$message}}</span>
							@enderror
						</div>
						<div class="col-6">
							<label for="name">Name:</label>
							<input type="text" name="name" id="name" class="form-control" placeholder="Enter Name." value="{{ $product->name }}" required>
							@error('name')
								<span class="error">{{$message}}</span>
							@enderror
						</div>
						<div class="col-6">
							<label for="sku">SKU:</label>
							<input type="text" name="sku" id="sku" class="form-control" placeholder="Enter Product Id.." value="{{ $product->sku }}" >
							@error('sku')
								<span class="error">{{$message}}</span>
							@enderror
						</div>
						<div class="col-6">
							<label for="price">Price:</label>
							<input type="text" name="price" id="price" class="form-control" placeholder="Enter Price.." value="{{ $product->price }}" required>
							@error('price')
								<span class="error">{{$message}}</span>
							@enderror
						</div>
						<div class="col-6">
							<label for="stock">Stock:</label>
							<input type="number" name="stock" id="stock" class="form-control" placeholder="Enter Stock.." value="{{ $product->stock }}">
						</div>
						<div class="col-6">
							<label for="category">Category:</label>
							<select name="category" id="category" class="form-select">
								<option value="">Select Category</option>
								@if ($categories->count() > 0)
									@foreach ($categories as $category)
									<option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
									@endforeach	
								@else
									<option value="">Category Not Found</option>		
								@endif
							</select>
							@error('category')
								<span class="error">{{$message}}</span>
							@enderror
						</div>
						<div class="col-6">
							<label for="brand">Brand:</label>
							<select name="brand" id="brand" class="form-select">
								<option value="">Select Brand</option>
								@if ($brands->count() > 0)
									@foreach ($brands as $brand)
									<option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
									@endforeach
								@else
									<option value="">Brand Not Found</option>		
								@endif
							</select>
							@error('brand')
								<span class="error">{{$message}}</span>
							@enderror
						</div>
						<div class="col-6">
							<label for="status">Status:</label>
							<select name="status" id="status" class="form-select">
								<option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Enable</option>
								<option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Disable</option>
							</select>
						</div>
						<div class="col-6">
							<label for="address">Address:</label>
							<input type="text" name="address" id="address" class="form-control" placeholder="Enter Address" value="{{ $product->address }}">
						</div>
						<div class="col-6">
							<label for="phone">Phone:</label>
							<input type="text" name="phone" id="phone" class="form-control" placeholder="Enter Phone" value="{{ $product->phone }}">
						</div>
						<div class="col-6">
							<label for="email">Email:</label>
							<input type="email" name="email" id="email" class="form-control" placeholder="Enter Email" value="{{ $product->email }}">
						</div>
						<div class="col-6">
							<label for="website">Website:</label>
							<input type="text" name="website" id="website" class="form-control" placeholder="Enter Website" value="{{ $product->website }}">
						</div>
						<div class="col-6">
							<label for="short_description">Short Description:</label>
							<input type="text" name="short_description" id="short_description" class="form-control" placeholder="Enter Short Description" value="{{ $product->short_description }}">
						</div>
						<div class="col-12">
							<label for="description">Description:</label>
							<textarea name="description" id="description" class="form-control" placeholder="Product Description...">{{ $product->description }}</textarea>
						</div>
					</div>
					<div class="row mt-3">
						<div class="col-2 ms-auto">
							<button type="submit" class="btn btn-primary form-control">Update</button>
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
        $('.alert').hide(500); 
    }, 4000);

	// Event listener for the file input change event
	$('#photo').on('change', function(event) {
		var file = event.target.files[0]; 
		if (file) {
			var reader = new FileReader(); 
			reader.onload = function(e) {
				$('.product_up_photo').attr('src', e.target.result);
				$('.product_up_photo').show();
			};
			reader.readAsDataURL(file);
		}
	});
</script> 
@endpush
