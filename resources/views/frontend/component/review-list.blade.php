@if($reviews->isEmpty())
    <div class="text-center py-4">
        <p class="text-muted fs-5"><i class="las la-comment-slash"></i> No reviews found</p>
    </div>
@else
    @foreach($reviews as $review)
    <div class="card p-3 mb-3 shadow-sm">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <p class="mb-1"><strong>{{ $review->user->name }}</strong></p>
                <p class="text-muted small mb-1">{{ date('d/m/Y', strtotime($review->created_at)) }}</p>
            </div>

            @if(auth()->check() && auth()->id() == $review->user_id)
            <!-- Dropdown Menu -->
            <div class="dropdown">
                <button class="btn btn-light btn-sm dropdown-toggle" type="button" id="reviewDropdown{{ $review->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="las la-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="reviewDropdown{{ $review->id }}">
                    <li>
                        <a class="dropdown-item editReviewBtn" 
                            href="javascript:void(0)" 
                            data-id="{{ $review->id }}" 
                            data-rating="{{ $review->rating }}" 
                            data-comment="{{ $review->comment }}">
                            <i class="las la-edit"></i> Edit
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item text-danger deleteReviewBtn" href="javascript:void(0)" data-id="{{ $review->id }}">
                            <i class="las la-trash"></i> Delete
                        </a>
                    </li>
                </ul>
            </div>
            @endif
        </div>

        <p class="mb-1"><strong>Rating:</strong> {{ $review->rating }} ⭐</p>
        <p class="mb-0">{{ $review->comment }}</p>
    </div>
    @endforeach
@endif
