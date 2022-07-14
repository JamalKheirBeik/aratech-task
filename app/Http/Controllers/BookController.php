<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{

    public function index()
    {
        $books = Book::latest()->paginate(20);
        $genres = Genre::all();
        return view('home')->with(['books' => $books, 'genres' => $genres]);
    }

    public function search(Request $request)
    {
        $genres = Genre::all();

        $query = strip_tags($request->get('query'));
        $genre = strip_tags($request->get('genre'));

        $books = DB::table('books')
            ->leftJoin('authors', 'books.author_id', '=', 'authors.id')
            ->leftJoin('book_genre', 'book_genre.book_id', '=', 'books.id')
            ->leftJoin('genres', 'book_genre.genre_id', '=', 'genres.id')
            ->where('books.title', 'LIKE', '%' . $query . '%')
            ->orWhere('books.description', 'LIKE', '%' . $query . '%')
            ->orWhere('authors.name', 'LIKE', '%' . $query . '%')
            ->where('genres.title', 'LIKE', '%' . $genre . '%')
            ->groupBy('books.id')
            ->orderBy('books.created_at', 'desc')
            ->select(['books.*', 'authors.name as author', DB::raw('GROUP_CONCAT(genres.title) as genres')])
            ->paginate(20);

        return view('search')->with([
            'books' => $books,
            'query' => $query,
            'genres' => $genres
        ]);
    }

    public function like(Request $request)
    {
        $id = $request->get('id');
        $book = Book::find($id);
        $book->likes = $book->likes + 1;
        $book->save();
        return json_encode(['statusCode' => 200, 'book_id' => $id, 'likes' => $book->likes]);
    }

    public function dislike(Request $request)
    {
        $id = $request->get('id');
        $book = Book::find($id);
        $book->dislikes = $book->dislikes + 1;
        $book->save();
        return json_encode(['statusCode' => 200, 'book_id' => $id, 'dislikes' => $book->dislikes]);
    }

    public function filter(Request $request)
    {
        $genres = Genre::all();
        $genreID = $request->get('id');
        // $books = DB::table('books')->join('book_genre', 'books.id', '=', 'book_genre.book_id')->join('genres', 'book_genre.genre_id', '=', 'genres.id')->join('authors', 'authors.id', '=', 'books.author_id')->where('book_genre.genre_id', $genreID)->select('books.*', 'genres.title', 'authors.name')->paginate(20);
        // $books = DB::select("SELECT books.* FROM books INNER JOIN book_genre on books.id = book_genre.book_id
        // INNER JOIN genres ON book_genre.genre_id = genres.id
        // WHERE genres.id = $genreID
        // GROUP BY books.id");
        // pure sql
        $books = DB::select('
            SELECT books.*, authors.name author
            FROM books INNER JOIN book_genre ON books.id = book_genre.book_id
            INNER JOIN genres ON book_genre.genre_id = genres.id
            INNER JOIN authors ON authors.id = books.author_id
            WHERE book_genre.genre_id = ?
            ORDER BY books.created_at;    
        ', [$genreID]);
        $res = collect([]);
        foreach ($books as $book) {;
            $res->push(array_merge(Book::find($book->id)->toArray(), Book::find($book->id)->genres->toArray));
        }
        return json_encode($res);
        // return json_encode(['statusCode' => 200, 'books' => $books]);
        // return view('home')->with(['books' => $books, 'genres' => $genres]);
    }
}
