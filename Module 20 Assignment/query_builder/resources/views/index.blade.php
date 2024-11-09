@extends("layout.app")

@section("content")
	<div class="col-12 mt-2">
		<div class="card">
			<div class="card-header">
				<a href="{{ route("product.create") }}" class="btn btn-outline-primary">Create Product</a>
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
									<a href="{{ route("product.edit",$product->id) }}" class="btn btn-outline-primary">
									<i class="fas fa-edit"></i>
									</a>
									<a href="{{ route('product.show', $product->id) }}" class="btn btn-outline-success">
										<i class="fas fa-eye"></i>
									</a>
									<form method="POST" action="{{ route('product.destroy', $product->id) }}">
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