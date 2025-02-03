@extends('frontend.layouts.app')

@section('page.content')

    <style>
        header {
            background: #fff !important;
        }
        .grid-view .book-card {
            width: 30%;
            display: inline-block;
            margin: 10px;
        }
        .list-view .book-card {
            width: 100%;
            display: block;
        }
        .book-card img {
            width: 100%;
            height: auto;
        }
    </style>


    <main class="main" id="home_page">
        <!--benefits calculator open-->

        <section class="top_step_content">
            <div class="container">
                <h4 class="title_heading text-center black_color pb-3 heading_font"> Book Listing </h4>
                <!-- Search and Filter Section -->
                <div class="row mb-3 justify-content-center">
                    <div class="col-md-4">
                        <input type="text" id="search" class="form-control" placeholder="Search by book name">
                    </div>
                    <div class="col-md-4">
                        <select id="rating" class="form-control">
                            <option value="">Filter by Rating</option>
                            <option value="1">1+ Stars</option>
                            <option value="2">2+ Stars</option>
                            <option value="3">3+ Stars</option>
                            <option value="4">4+ Stars</option>
                        </select>
                    </div>
                </div>

                <!-- Book List Container -->
                <div id="bookList" class="row grid-view"></div>
                <div id="loading" class="text-center black_color pb-3" style="display: none;">Loading...</div>
            </div>
        </section>

    </main>


@endsection


@section('page.scripts')

    <script>
        $(document).ready(function() {
            let page = 1;
            let loading = false;
            let hasMore = true;
            let cache = [];

            function fetchBooks() {
                if (loading || !hasMore) return;

                loading = true;
                $('#loading').show();

                let search = $('#search').val();
                let rating = $('#rating').val();

                setTimeout(() => { // Throttling effect (2 seconds)
                    $.ajax({
                        url: "{{ route('books.fetch') }}",
                        type: "GET",
                        data: { page, search, rating },
                        success: function(response) {
                            cache = [...cache, ...$(response.books)];
                            $('#bookList').append(response.books);
                            page = response.nextPage;
                            hasMore = response.hasMore;
                            $('#loading').hide();
                            loading = false;
                        }
                    });
                }, 500);
            }

            // Initial fetch
            fetchBooks();

            // Infinite Scroll Event
            $(window).scroll(function() {
                if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
                    fetchBooks();
                }
            });

            // Search & Filter Event
            $('#search, #rating').on('change keyup', function() {
                page = 1;
                hasMore = true;
                $('#bookList').html('');
                fetchBooks();
            });
        });
    </script>

@endsection
