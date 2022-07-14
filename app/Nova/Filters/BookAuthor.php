<?php

namespace App\Nova\Filters;

use App\Models\Author;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class BookAuthor extends Filter
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
        return $query->where('author_id', $value);
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
        $authors = Author::all();
        foreach ($authors as $author) {
            $options[$author->name] = $author->id;
        }
        return $options;
    }
}
