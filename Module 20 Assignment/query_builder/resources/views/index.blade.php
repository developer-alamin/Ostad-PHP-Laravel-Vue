@extends("layout.app")

@section("content")
	<div class="col-12 mt-2">
		<div class="card">
			<div class="card-header">
				<a href="{{ route("products.create") }}" class="btn btn-outline-primary">Create Product</a>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-4">
						@if(Session::has("update"))
						<div class="alert alert-success" role="alert">
						  <b>{{ Session::get("update") }}</b>
						</div>
						@endif
					</div>
				</div>	
				<div class="row mb-2">
					<div class="col-6">
						<form action="{{ route("products.index") }}" method="GET">
							<div class="row">
								<div class="col-6">
									<input type="search" name="search" class="form-control" placeholder="Product Id Or Description">
								</div>
								<div class="col-4">
									<button type="submit" class="btn btn-primary">Search</button>
								</div>
							</div>
							
						</form>
					</div>
					<div class="col-6">
						<form action="{{ route("products.index") }}" method="GET">
							<div class="row justify-content-end">
								<div class="col-4">
									<select name="sort" id="sort" class="form-select">
										<option value="name">Sort By Name</option>
										<option value="price">Sort By Price</option>
									</select>
								</div>
								<div class="col-4">
									<select name="order" id="order" class="form-select">
										<option value="asc">Ascending</option>
										<option value="desc">Descending</option>
									</select>
								</div>
								<div class="col-2">
									<button class="btn btn-primary form-control">Sort</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<table class="table table-bordered table-hover table-striped">
					<thead>
						<tr>
							<th>Sr</th>
							<th>Product Id</th>
							<th>Name</th>
							<th>Desctiption</th>
							<th>Price</th>
							<th>Stock</th>
							<th>Image</th>
							<th>Create</th>
							<th>Action</th>
						</tr>
					</thead>
					@if($products->isNotEmpty())
					<tbody>
						@foreach($products as $key=> $product)
						<tr>
							<td>{{ $key+1 }}</td>
							<td>{{ $product->product_id }}</td>
							<td>{{ $product->name }}</td>
							<td>{{ $product->description }}</td>
							<td>{{ $product->price }}</td>
							<td>{{ $product->stock }}</td>
							<td><img class="image" src="{{ $product->image }}" alt=""></td>
							<td>{{ $product->created_at }}</td>
							<td>
								<div class="d-flex justify-center">
									<a href="{{ route("products.edit",$product->id) }}" class="btn btn-outline-primary">
									<i class="fas fa-edit"></i>
									</a>
									<a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-success">
										<i class="fas fa-eye"></i>
									</a>
									<form method="POST" action="{{ route('products.destroy', $product->id) }}">
	                                        @csrf
	                                        @method("delete")
	                                       	<button type="submit" class="btn btn-outline-danger">
												<i class="fas fa-trash"></i>
											</button>
	                                </form>
								</div>
							</td>
						</tr>
						@endforeach
					</tbody>
					@else
					<tfoot>
						<tr class="text-center">
							<th colspan="9">Product Not Found By Product Or Description</th>
						</tr>
					</tfoot>
					@endif
				</table>
				{{ $products->links('pagination::bootstrap-5') }}
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