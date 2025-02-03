@foreach($books as $book)
<div class="book-card card p-3">
    <img src="{{ asset( $book->image) }}" alt="{{ $book->book_name }}" class="img-thumbnail" width="150">
    <h3><strong>{{ $book->book_name }}</strong></h3>
    <p>Author: <strong>{{ $book->author }}</strong></p>
    <p><strong>Rating: {{ number_format($book->reviews->avg('rating'), 1) }}/5</strong> ⭐</p>
    <a href="{{ route('book.details', $book->id) }}" class="btn btn-primary">View Details</a>
</div>
@endforeach

