@extends("layout.app")

@section("content")
	<div class="col-8 mt-2 m-auto">
		<div class="card">
			<div class="card-header">
				<a href="{{ route("products.index") }}" class="btn btn-outline-primary">All Products</a>
			</div>
			<div class="card-body">
				<div class="d-flex align-items-center">
				  <div class="flex-shrink-0">
				  	@if($product->image)
				   	 <img class="showImg" src="{{ $product->image }}" alt="...">
				    @endif
				  </div>
				  <div class="flex-grow-1 ms-3">
				    <div class="row">
				    	<div class="col-3">
				    		<strong>Product Id:</strong>
				    	</div>
				    	<div class="col-9">
				    		{{ $product->product_id }}
				    	</div>
				    </div>
				    <hr>
				    <div class="row">
				    	<div class="col-3">
				    		<strong>Name:</strong>
				    	</div>
				    	<div class="col-9">
				    		{{ $product->name }}
				    	</div>
				    </div>
				    <hr>
				    <div class="row">
				    	<div class="col-3">
				    		<strong>Price:</strong>
				    	</div>
				    	<div class="col-9">
				    		{{ $product->price }}
				    	</div>
				    </div>
				    <hr>
				    <div class="row">
				    	<div class="col-3">
				    		<strong>Stock:</strong>
				    	</div>
				    	<div class="col-9">
				    		{{ $product->stock }}
				    	</div>
				    </div>
				    <hr>
				    <div class="row">
				    	<div class="col-3">
				    		<strong>Description:</strong>
				    	</div>
				    	<div class="col-9">
				    		{{ $product->description }}
				    	</div>
				    </div>
				    <hr>
				    <div class="row">
				    	<div class="col-3">
				    		<strong>Create Date:</strong>
				    	</div>
				    	<div class="col-9">
				    		{{ $product->created_at }}
				    	</div>
				    </div>
				    <hr>
				  </div>
				</div>
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