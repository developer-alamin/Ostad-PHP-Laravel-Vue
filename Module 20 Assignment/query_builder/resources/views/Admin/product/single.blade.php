@extends('layout.app')
@section('content')

@if(Session::has('success'))
    <span class="text-success">{{ Session::get('success') }}</span>
@endif

<div class="signle_product_details">
    <div class="row pt-4">
        <div class="col-6">
            <div class="d-flex align-items-center py-2">
              <div class="flex-shrink-0">
                <img src="{{ $product->image }}" class="product_single_image" alt="...">
              </div>
              <div class="flex-grow-1 ms-3">
                <div class="product_varify">
                     @if($product->status === 1)
                        <i class="fa-solid fa-check"></i> <span>Verified</span>
                    @endif
                </div>
                <h4 class="product_short_title">{{ $product->short_description }}</h4>
                <div class="review_section">
                   <div class="review_count">
                       <a href="">
                           <span>Reviews 3456</span>
                       </a>
                   </div>
                   <div class="product_rating">
                        <span class="star full">&#9733;</span>
                        <span class="star full">&#9733;</span>
                        <span class="star full">&#9733;</span>
                        <span class="star full">&#9733;</span>
                        <span class="star half">&#9733;</span>
                    </div>
                </div>
                <div class="review_create">
                    <button class="btn btn-primary"><span class="fas fa-pencil"></span> Write A Review</button>
                </div>
              </div>
            </div>
        </div>
        <div class="col-1"></div>
        <div class="col-5">
            <a href="" style="text-decoration: none;">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center" >
                            <div class="col-4">
                                 <div class="product_single_rating_wrapper">
                                    <h3>4.7</h3>
                                    <div class="product_rating">
                                       <span class="star full">&#9733;</span>
                                        <span class="star full">&#9733;</span>
                                        <span class="star full">&#9733;</span>
                                        <span class="star full">&#9733;</span>
                                        <span class="star half">&#9733;</span>
                                    </div>
                                    <div class="product_single_users_count">
                                        <span>Reviews 432</span>
                                    </div>
                                </div> 
                            </div> 
                           <div class="col-8">
                                <div class="progress-container">
                                    <div class="progress-item">
                                      <span>5 Stars</span>
                                      <div class="progress-line"></div>
                                    </div>
                                    <div class="progress-item">
                                      <span>4 Stars</span>
                                      <div class="progress-line filled"></div>
                                    </div>
                                    <div class="progress-item">
                                      <span>3 Stars</span>
                                      <div class="progress-line filled"></div>
                                    </div>
                                    <div class="progress-item">
                                      <span>2 Stars</span>
                                      <div class="progress-line filled"></div>
                                    </div>
                                    <div class="progress-item">
                                      <span>1 Star</span>
                                      <div class="progress-line filled"></div>
                                    </div>
                                </div>
                           </div>
                        </div>
                    </div>
                </div>  
            </a>
        </div>
    </div>
</div>
<hr class="mt-3">
<div class="company_details">
   <div class="row">
       <div class="col-8">
            <div class="row">
                <div class="col-4">
                    <h4>Product Details</h4>
                </div>
                <div class="col-8">
                    <p>{{ $product->description }}</p>
                </div>
            </div>
            <div class="row pt-5">
                <div class="col-4">
                    <h4>Contact Info</h4>
                </div>
                <div class="col-8">
                    <div class="product_single_contact_itmes">
                        <div class="item">
                            <i class="fas fa-map-marker-alt"></i> 
                            <span>{{ $product->address ?? "N\A" }}</span>
                        </div>
                        <div class="item">
                             <i class="fas fa-phone"></i> 
                            <span>{{ $product->phone ?? "N\A" }}</span>
                        </div>
                        <div class="item">
                             <i class="fas fa-envelope"></i> 
                            <span>{{ $product->email ?? "N\A" }}</span>
                        </div>
                        <div class="item">
                             <i class="fas fa-globe"></i> 
                            <span>{{ $product->website ?? "N\A" }}</span>
                        </div>
                    </div>  
                </div>
            </div>
       </div>
   </div>
</div>
<hr class="mt-3">
<div class="review_filtering">
    <div class="row">
        <div class="col-4">
             <div class="card">
                 <div class="card-body">
                    <div class="progress-container">
                      <div class="progress-item">
                        <input type="checkbox" id="star5" />
                        <label for="star5">
                          <span>5 Stars</span>
                        </label>
                        <div class="progress-line"></div>
                      </div>
                      <div class="progress-item">
                        <input type="checkbox" id="star4" />
                        <label for="star4">
                          <span>4 Stars</span>
                        </label>
                        <div class="progress-line filled"></div>
                      </div>
                      <div class="progress-item">
                        <input type="checkbox" id="star3" />
                        <label for="star3">
                          <span>3 Stars</span>
                        </label>
                        <div class="progress-line filled"></div>
                      </div>
                      <div class="progress-item">
                        <input type="checkbox" id="star2" />
                        <label for="star2">
                          <span>2 Stars</span>
                        </label>
                        <div class="progress-line filled"></div>
                      </div>
                      <div class="progress-item">
                        <input type="checkbox" id="star1" />
                        <label for="star1">
                          <span>1 Star</span>
                        </label>
                        <div class="progress-line filled"></div>
                      </div>
                    </div>

                 </div>
             </div>   
        </div>
        <div class="col-8">
            <div class="row">
                <div class="col-7">
                     <div class="review_filter_input">
                        <input type="search" name="review_search" class="form-control" placeholder="Search..." />
                    </div>
                </div>
                <div class="col-3">
                    <select name="review_date_posted" class="form-select" id="review_date_posted">
                        <option value="all">All Reviews</option>
                        <option value="30">Last 30 Days</option>
                        <option value="3">Last 3 Months</option>
                        <option value="6">Last 6 Months</option>
                        <option value="12">Last 12 Months</option>
                    </select>
                </div>
                <div class="col-1">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
            <hr class="mt-3">
            <div class="row review_users_items">
                <div class="col-12">
                    <div class="row">
                        <div class="col-6">
                           <div class="d-flex align-items-center ">

                               @if(Auth::check())
                                    <img src="{{ asset(Auth::user()->image) }}" class="review_user" alt="">
                                @else
                                    <div class="review_user">No user</div>
                                @endif

                                @if(Auth::check())
                                 <h4 style="padding-left: 7px;">{{ Auth::user()->name }}</h4>
                                 @else
                                  <h4 style="padding-left: 7px;">No User</h4>
                                 @endif
                               
                           </div>
                        </div>
                        <div class="col-4 text-end">
                            <span>18 Nov 2024</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="userByReview">
                            <div class="product_rating">
                                <span class="star full">&#9733;</span>
                                <span class="star full">&#9733;</span>
                                <span class="star full">&#9733;</span>
                                <span class="star full">&#9733;</span>
                                <span class="star half">&#9733;</span>
                            </div>
                        </div>
                        <div class="user_review_content">
                            <h5>User Review Title</h5>
                            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ea, dicta. Rerum voluptas at cum doloremque reprehenderit, vel provident. Aspernatur veniam at officiis provident sapiente ea pariatur similique eos nam molestias? <a class="read_more" href="">Read More</a></p> 
                            <img class="user_review_img" src="{{ $product->image }}" style="width: 200px;height: 200px;display: none;" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- review create modal  -->
<div class="modal fade review_create_modal" id="review_create_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-zoom">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Create A New Review</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

        <form id="review-form" action="{{ route('product.rattingpage') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="ratting" id="product_ratting" required="">
            <div class="modal-body">
              <div class="row">
                @error('product_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="col-12">
                  <div class="review-container">
                    <div class="star-rating">
                      <span class="star" data-value="1">&#9733;</span>
                      <span class="star" data-value="2">&#9733;</span>
                      <span class="star" data-value="3">&#9733;</span>
                      <span class="star" data-value="4">&#9733;</span>
                      <span class="star" data-value="5">&#9733;</span>
                    </div>
                    <p id="rating-display">Your Rating: <span id="rating-value">0</span></p>
                  </div>
                </div>
                <div class="col-12">
                  <label for="photo">Photo:</label>
                  <input type="file" name="photo" id="photo" class="form-control">
                    @error('photo')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12">
                  <label for="title">Review Title:</label>
                  <input type="text" name="title" id="title" placeholder="Enter Review Title" class="form-control" required>
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12">
                  <label for="description">Description:</label>
                  <textarea name="description" id="description" class="form-control" placeholder="Message"></textarea>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
    </div>
  </div>
</div>



@endsection

@push("scripts")
    <script>
        $(document).ready(function () {

             $(".read_more").click(function(e) {
                e.preventDefault(); 
                $(".user_review_img").toggle(500);
              });

             $(".review_create button").click(function (e) {
                 e.preventDefault();
                 $("div.modal.review_create_modal").modal("show");
             });


             const stars = $("div.review-container .star");
              let selectedRating = 0;

              // Highlight stars on hover
              stars.on("mouseenter", function () {
                const rating = $(this).data("value");
                highlightStars(rating);
              });

              // Remove hover effect when mouse leaves
              stars.on("mouseleave", function () {
                highlightStars(selectedRating); // Keep the selected stars
              });

              // Set rating on click
              stars.on("click", function () {
                selectedRating = $(this).data("value"); // Update the selected rating
                highlightStars(selectedRating); // Highlight stars up to selected rating
                $("#rating-value").text(selectedRating); // Update the displayed rating
                $("#product_ratting").val(selectedRating)
              });

              // Function to highlight stars up to the given rating
              function highlightStars(rating) {
                stars.each(function (index) {
                  $(this).toggleClass("hovered", index < rating); // Highlight stars on hover
                  $(this).toggleClass("selected", index < rating); // Keep selected stars
                });
              }

             // Validate form before submission
            $("#review-form").on("submit", function (e) {
                if (selectedRating === 0) {
                  alert("Please provide a star rating before submitting the review.");
                  e.preventDefault(); 
                }
            });
            
        });
    </script>   
@endpush