<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //return view('authors.index');
        return view('authors.index', [
            /* 'authors' => Author::all() */
            'authors' => Author::orderBy('first_name')->paginate(20)
            /* 'authors' => DB::table('authors')->orderBy('first_name')->paginate(20) */
        ]);
        // return Author::all(); // kuvab kõik
        // return Author::paginate(10); // anna lehest 10 tk
    }

    /**
     * Search.
     */
    // https://www.educative.io/answers/how-to-implement-search-in-laravel

    public function searchauthors(Request $request)
    {
        // Get the search value from the request
        $searchauthors = $request->input('searchauthors');

        // Search in the title and body columns from the posts table
        $authors = Author::query()
            ->where('first_name', 'LIKE', "%{$searchauthors}%")
            ->orWhere('last_name', 'LIKE', "%{$searchauthors}%")
            ->get();

        // Return the search view with the resluts compacted
        return view('authors.search', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('authors.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $this->authorize('update', $author);
        $validated = $request->validate(
            [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
            ],
            [
                'first_name.required' => 'The first name filed is required.',
                'last_name.required' => 'The last name filed is required.'
            ]
        );

        Author::create($validated);

        return view('authors.index', [
            'authors' => Author::all()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author): View
    {

        return view('authors.edit', [
            'author' => $author,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author): RedirectResponse

    {
        // $this->authorize('update', $author);
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
        ]);

        $author->update($validated);

        return redirect(route('authors.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        $author->delete();
        return redirect('/authors');
    }
}
