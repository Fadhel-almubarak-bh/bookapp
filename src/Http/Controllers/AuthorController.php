<?php

namespace Xs4arabia\Bookapp\Http\Controllers;

use Xs4arabia\Bookapp\Models\Author;
use Illuminate\Http\Request;
use Xs4arabia\Bookapp\Http\Controllers\Controller;

class AuthorController extends Controller
{
    // Display a listing of the resource.
    public function index(Request $request)
    {
        $query = Author::query();

        // Filter by name if provided
        if ($request->has('name') && $request->name != '') {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        // Get all authors first
        $authors = $query->get();

        // If books_count is provided, filter authors manually
        $authors = $authors->map(function ($author) use ($request) {
            // Count the number of books for each author
            $author->books_count = \DB::table('authors_books')
                ->where('author_id', $author->id)
                ->count();

            // If books_count filter is applied, filter the authors
            if ($request->has('books_count') && $request->books_count != '') {
                return $author->books_count == $request->input('books_count') ? $author : null;
            }

            return $author;
        })->filter();

        // Return view with authors and their book count
        return view('vendor.bookapp.authors.index', compact('authors'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        // You can return a view if you have a form to create an author.
        return view('vendor.bookapp.authors.create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $author = Author::create($validatedData);

        return redirect()->route('authors.show', $author->id)->with('success', 'Author created successfully.');
    }

    // Display the specified resource.
    public function show($id)
    {
        $author = Author::findOrFail($id);

        $books = $author->books()->with('categories', 'locations')->get();

        return view('vendor.bookapp.authors.show', compact('author', 'books'));
    }
    
    // Show the form for editing the specified resource.
    public function edit($id)
    {
        $author = Author::findOrFail($id);

        return view('vendor.bookapp.authors.edit', compact('author'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $author = Author::findOrFail($id);
        $author->update($validatedData);

        return redirect()->route('authors.show', $author->id)->with('success', 'Author updated successfully.');
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $author = Author::findOrFail($id);
        $author->delete();

        return redirect()->route('authors.index')->with('success', 'Author deleted successfully.');
    }
}
