@extends('frontend.layouts.app')

@section('page.content')
<div class="container">
    <div class="row">
        <!-- Book Image (Left Side) -->
        <div class="col-md-4">
            <img src="{{ asset($book->image) }}" alt="{{ $book->book_name }}" class="img-fluid">
        </div>

        <!-- Book Details (Right Side) -->
        <div class="col-md-8">
            <h2>{{ $book->book_name }}</h2>
            <p>Author: <strong>{{ $book->author }}</strong></p>
            <p><strong>Rating: {{ number_format($book->reviews->avg('rating'), 1) }}/5</strong> ⭐</p>
        </div>
    </div>
    <br>

    <hr>

    <!-- Add Review Form -->
    @auth
        <h3>Add a Review</h3>
        <form id="reviewForm">
            @csrf
            <input type="hidden" name="book_id" value="{{ $book->id }}">
            <div class="form-group">
                <label>Rating</label>
                <select name="rating" id="rating" class="form-control">
                    <option value="1">1 Star</option>
                    <option value="2">2 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="5">5 Stars</option>
                </select>
            </div>
            <div class="form-group mb-2">
                <label>Comment</label>
                <textarea name="comment" id="comment" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Review</button>
        </form>
    @else
        <p><a href="{{ route('index') }}#sign">Login</a> to add a review.</p>
    @endauth

    <!-- Review Section -->
    <hr>
    <br>
    <h3>Reviews</h3>
    <div id="reviewList"></div>
</div>

<!-- Review Edit Modal -->
<div class="modal fade" id="editReviewModal" tabindex="-1" aria-labelledby="editReviewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Review</h5>
            </div>
            <div class="modal-body">
                <input type="hidden" id="review_id">
                <label>Rating</label>
                <select id="edit_rating" class="form-control">
                    <option value="1">1 Star</option>
                    <option value="2">2 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="5">5 Stars</option>
                </select>
                <label>Comment</label>
                <textarea id="edit_comment" class="form-control"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="updateReviewBtn">Update Review</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page.scripts')
<script>
    $(document).ready(function() {
        let bookId = {{ $book->id }};
        fetchReviews();

        function fetchReviews() {
            $.ajax({
                url: "{{ route('book.reviews', $book->id) }}",
                type: "GET",
                success: function(response) {
                    $('#reviewList').html(response.reviews);
                }
            });
        }

        // Submit New Review
        $('#reviewForm').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('review.store') }}",
                type: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        Command: toastr["success"]('Review Add Successfully', "Success");
                        $('#reviewForm')[0].reset(); // Reset the form
                        fetchReviews(); // Refresh reviews
                    }
                }
            });
        });

        // Open Edit Modal
        $(document).on('click', '.editReviewBtn', function() {
            let reviewId = $(this).data('id');
            let rating = $(this).data('rating');
            let comment = $(this).data('comment');

            $('#review_id').val(reviewId);
            $('#edit_rating').val(rating);
            $('#edit_comment').val(comment);

            $('#editReviewModal').modal('show');
        });

        // Update Review
        $('#updateReviewBtn').click(function() {
            let reviewId = $('#review_id').val();
            let rating = $('#edit_rating').val();
            let comment = $('#edit_comment').val();

            $.ajax({
                url: "{{ route('review.update') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    review_id: reviewId,
                    rating: rating,
                    comment: comment
                },
                success: function(response) {
                    $('#editReviewModal').modal('hide');
                    Command: toastr["success"]('Review Updated Successfully', "Success");
                    fetchReviews();
                }
            });
        });

        // Delete Review
        $(document).on('click', '.deleteReviewBtn', function() {
            let reviewId = $(this).data('id');

            if (confirm('Are you sure you want to delete this review?')) {
                $.ajax({
                    url: "{{ route('review.delete') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        review_id: reviewId
                    },
                    success: function(response) {
                        Command: toastr["success"]('Review Deleted Successfully', "Success");
                        fetchReviews();
                    }
                });
            }
        });
    });
</script>
@endsection
