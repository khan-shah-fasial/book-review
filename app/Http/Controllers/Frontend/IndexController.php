<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Models\Book;
use App\Models\BookReview;


class IndexController extends Controller
{
    public function index(){
        $book = null;

        return view('frontend.pages.home.index', compact('book'));
    }

    public function fetchBooks(Request $request)
    {
        $query = Book::with('reviews');

        // Apply search filter
        if ($request->has('search') && $request->search != '') {
            $query->where('book_name', 'like', '%' . $request->search . '%');
        }
    
        // Apply rating filter
        if ($request->has('rating') && $request->rating != '') {
            $query->whereHas('reviews', function ($q) use ($request) {
                $q->havingRaw('AVG(rating) >= ?', [$request->rating]);
            });
        }
    
        // Infinite scrolling pagination (fetch 3 books per request)
        $books = $query->paginate(3);
    
        return response()->json([
            'books' => view('frontend.component.book-list', compact('books'))->render(),
            'hasMore' => $books->hasMorePages(),
            'nextPage' => $books->currentPage() + 1
        ]);
    }

    public function show($id)
    {
        $book = Book::with('reviews.user')->findOrFail($id);
        return view('frontend.pages.book.book-detail', compact('book'));
    }
    
    // Fetch reviews dynamically for AJAX
    public function fetchReviews($id)
    {
        $reviews = BookReview::where('book_id', $id)->with('user')->latest()->get();
        
        return response()->json([
            'reviews' => view('frontend.component.review-list', compact('reviews'))->render()
        ]);
    }

    public function store(Request $request)
    {
        BookReview::create([
            'book_id' => $request->book_id,
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);
    
        return response()->json(['success' => true]);
    }
    
    public function update(Request $request)
    {
        $review = BookReview::where('id', $request->review_id)->where('user_id', auth()->id())->first();
        
        if ($review) {
            $review->update([
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]);
        }
    
        return response()->json(['success' => true]);
    }
    
    public function delete(Request $request)
    {
        BookReview::where('id', $request->review_id)->where('user_id', auth()->id())->delete();
        return response()->json(['success' => true]);
    }
//--------------=============================== other ================================------------------------------

    public function not_found(){

        return view('frontend.pages.404.index');
    }

}