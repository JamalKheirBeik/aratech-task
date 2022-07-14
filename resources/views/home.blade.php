@extends('layouts.app')

@section('content')
    <h1 class="text-2xl border-l-8 border-red-600 pl-3 uppercase m-4">Our Books Collection</h1>

    @if($books->count())
        <ul id="booksContainer" class="flex justify-center items-start flex-wrap gap-8 m-6">
            @foreach ($books as $book)
                <li class="item" data-aos="fade-up">
                    <ul class="w-80 pc:h-665 mobile:h-600 overflow-hidden bg-white shadow-lg p-4 rounded-lg relative">
                        <img src={{ URL('/images/cover.jpg') }} alt={{ $book->cover }} class="mobile:h-330 pc:h-400 w-full object-cover rounded-lg" />
                        <li class="text-lg mt-3">{{ $book->title }}</li>
                        <li class="text-sm text-gray-500 flex justify-between my-2">
                            <span>{{ $book->author->name }}</span>
                            <span>{{ $book->created_at }}</span>
                        </li>
                        <li class="mb-3">{!! Str::of($book->description)->limit(50); !!}</li>
                        <li class="genres flex justify-center items-center gap-2">
                            @foreach ($book->genres as $genre)
                                <span class="odd:bg-red-400 even:bg-blue-500 py-1 px-2 text-sm text-white rounded-lg">{{ $genre->title }}</span>
                            @endforeach
                        </li>
                        <li class="mt-4 flex justify-center items-center gap-4 text-gray-500 text-sm absolute bottom-4 left-0 right-0">
                            <form class="likeForm flex items-center" method="POST">
                                @csrf
                                <span>{{ $book->likes }}</span>
                                <input type="hidden" name="id" value={{ $book->id }} />
                                <button>
                                    <i class="fa-solid fa-thumbs-up text-green-600 hover:text-green-700 text-2xl ml-2 cursor-pointer" data-id={{ $book->id }}></i>
                                </button>
                            </form>
                            <form class="dislikeForm flex items-center" method="POST">
                                @csrf
                                <span>{{ $book->dislikes }}</span>
                                <input type="hidden" name="id" value={{ $book->id }} />
                                <button type="submit">
                                    <i class="fa-solid fa-thumbs-down text-red-600 hover:text-red-700 text-2xl ml-2 cursor-pointer" data-id={{ $book->id }}></i>
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            @endforeach
        </ul>
        {{ $books->links() }}
    @else
        <p class="bg-red-300 text-red-700 p-3 rounded-lg mt-6">There are no books</p>
    @endif

@endsection
