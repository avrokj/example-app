<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //return view('books.index');
        return view('books.index', [
            'books' => Book::orderBy('title')->paginate(20)
        ]);
        // return Book::all(); // kuvab kõik
        // return Book::paginate(10); // anna lehest 10 tk
    }


    public function search(Request $request)
    {
        // Get the search value from the request
        $search = $request->input('search');

        // Search in the title and body columns from the posts table
        $books = Book::query()
            ->where('title', 'LIKE', "%{$search}%")
            ->orWhere('summary', 'LIKE', "%{$search}%")
            ->get();

        // Return the search view with the resluts compacted
        return view('books.search', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *//* 
    public function show(Book $book)
    {
        return view('books.view', [
            'book' => $book,
        ]);
    } ALGNE */
    /*     public function show(Book $book): View
    {
        $book = Book::with('authors')->where('id', $book->id)->first();
        // dd($book);
        return view('books.view', [
            'book' => $book,

        ]);
    } ANDRUSEGA ARENDATUD */

    public function show(Book $book): View
    {
        return view('books.show', [
            'book' => $book,
            'authors' => $book->authors
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book): View
    {
        return view('books.edit', [
            'book' => $book,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book): RedirectResponse

    {
        // $this->authorize('update', $author);
        $validated = $request->validate(
            [
                'title' => 'required|string|max:255',
                'release_date' => 'required|integer|between:1901,2023',
                'language' => 'required|string|max:255',
                'summary' => 'required|string|max:255',
                //'price' => 'required|decimal:0,2',
                'price' => ['required', 'regex:/^\d+(,\d$|,\d{2})?$/i'],
                'stock_saldo' => 'required|string|max:45',
                'pages' => 'required|int:11',
                'type' => 'required|string|max:255',
            ],
            [
                'release_date.required' => 'The release year filed is required.',
                'release_date.between' => 'Please insert release year between 1901 and 2023.'
            ]
        );

        $book->update($validated);

        return redirect(route('books.show', $book));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect('/books');
    }

    /**
     * Remove the author from book.
     */
    public function detachAuthor(Author $author)
    {
        $author->delete();
        return redirect('/books');
    }
}
