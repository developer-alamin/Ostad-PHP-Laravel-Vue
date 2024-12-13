@extends("layout.app")

@section("content")
	<div class="col-12 mt-2">
		<div class="card">
			<div class="card-header d-flex align-items-center">
				<a href="{{ route("products.index") }}" class="btn btn-outline-primary">All Products</a>
				@if($product->image)
				<img class="image" src="{{ $product->image }}" class="ms-auto"  alt="{{ $product->name }}">
				@endif
			</div>
			<div class="card-body">
				@if(!$errors->isEmpty())
					@foreach ($errors->all() as $error)
				      <div>{{ $error }}</div>
				  @endforeach
				@endif
				<form action="{{ route("products.update",$product->id) }}" enctype='multipart/form-data' method="post">
					@csrf
					@method("PUT")
					<div class="row">
						<div class="col-6">
							<label for="photo">Photo:</label>
							<input type="file" name="photo" id="photo" class="form-control">
						</div>
						<div class="col-6">
							<label for="product_id">Product Id:</label>
							<input type="text" name="product_id" id="product_id" class="form-control" value="{{ $product->product_id }}">
						</div>
						<div class="col-6">
							<label for="name">Name:</label>
							<input type="text" name="name" id="product_id" class="form-control" value="{{ $product->name }}">
						</div>
						<div class="col-6">
							<label for="price">Price:</label>
							<input type="text" name="price" id="price" class="form-control" value="{{ $product->price }}">
						</div>
						<div class="col-6">
							<label for="stock">Stock:</label>
							<input type="text" name="stock" id="stock" class="form-control" value="{{ $product->stock }}">
						</div>
						<div class="col-6">
							<label for="description">Description:</label>
							<input type="text" name="description" id="description" class="form-control" value="{{ $product->description }}">
						</div>
					</div>
					<div class="row mt-3">
						<div class="col-2 ms-auto">
							<button type="submit" class="btn btn-outline-success form-control">Update</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection