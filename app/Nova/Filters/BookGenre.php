<?php

namespace App\Nova\Filters;

use App\Models\Genre;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class BookGenre extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';

    /**
     * Apply the filter to the given query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Request $request, $query, $value)
    {
        return $query->join('book_genre as bg', 'books.id', 'bg.book_id')->where('genre_id', $value)->get();
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        $options = [];
        $genres = Genre::all();
        foreach ($genres as $genre) {
            $options[$genre->title] = $genre->id;
        }
        return $options;
    }
}
