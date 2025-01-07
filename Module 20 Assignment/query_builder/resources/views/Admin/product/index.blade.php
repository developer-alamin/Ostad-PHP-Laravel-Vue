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
					<div class="col-12">
						<form action="{{ route("products.index") }}" method="GET">
							<div class="row justify-content-end">
								<div class="col-3">
									<input type="search" name="search" class="form-control"placeholder="Name or Description"
									value="{{ old('search', request()->get('search')) }}">
								</div>
								<div class="col-2">
									<select name="sort" id="sort" class="form-select">
										<option value="name" {{ request()->get('sort') == 'name' ? 'selected' : '' }}>Sort By Name</option>
										<option value="price" {{ request()->get('sort') == 'price' ? 'selected' : '' }}>Sort By Price</option>
									</select>
								</div>
								<div class="col-2">
									<select name="order" id="order" class="form-select">
										<option value="asc" {{ request()->get('order') == 'asc' ? 'selected' : '' }}>Ascending</option>
										<option value="desc" {{ request()->get('order') == 'desc' ? 'selected' : '' }}>Descending</option>
									</select>
								</div>
								<div class="col-1">
									<button type="submit" class="btn btn-primary form-control">Filter</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<table class="table table-bordered table-hover table-striped">
					<thead>
						<tr>
							<th>Sr</th>
							<th>SKU</th>
							<th>Name</th>
							<th>Description</th>
							<th>Price</th>
							<th>Stock</th>
							<th>Image</th>
							<th>Created At</th>
							<th>Action</th>
						</tr>
					</thead>
					@if($products->isNotEmpty())
					<tbody>
						@foreach($products as $key => $product)
						<tr>
							<td>{{ $key + 1 }}</td>
							<td>{{ $product->sku }}</td>
							<td>{{ $product->name }}</td>
							<td>{{ $product->description }}</td>
							<td>{{ $product->price }}</td>
							<td>{{ $product->stock }}</td>
							<td>
								<img 
									class="admin_product_table_image" 
									src="{{ $product->image ?: asset('images/default.png') }}" 
									alt="{{ $product->name }}" >
							</td>
							<td>{{ $product->created_at->format('Y-m-d') }}</td>
							<td>
								<div class="d-flex justify-content-center gap-2">
									<a href="{{ route('product.singlepage', $product->sku) }}" class="btn btn-outline-primary">
										<i class="fas fa-eye"></i>
									</a>
									<a href="{{ route('products.edit', $product->id) }}" class="btn btn-outline-primary">
										<i class="fas fa-pencil"></i>
									</a>
									<button data-href="{{ route('products.destroy',$product) }}" class="btn btn-outline-danger confirm-delete">
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
							<th colspan="9">Product Not Found By ID or Description</th>
						</tr>
					</tfoot>
					@endif
				</table>
				{{ $products->links('pagination::bootstrap-5') }}
			</div>
		</div>
	</div>
@endsection
@section('modal')
    @include('Modal.confirm-delete');
@endsection

@push("scripts")
<script type="text/javascript"> 
    setTimeout(function () { 
        $('.alert').hide(500); // Closing the alert
    }, 4000); 
</script> 
@endpush
