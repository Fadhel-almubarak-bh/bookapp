<?php

namespace Xs4arabia\Bookapp\Http\Controllers;

use Xs4arabia\Bookapp\Models\Book;
use Xs4arabia\Bookapp\Models\Author;
use Xs4arabia\Bookapp\Models\Location;
use Xs4arabia\Bookapp\Models\Category;
use Illuminate\Http\Request;
use Xs4arabia\Bookapp\Http\Controllers\Controller;

class bookController extends Controller
{
    // Display a listing of the resource.
    public function index(Request $request)
    {
        $query = Book::query();

                // Search by name
                if ($request->has('search')) {
                    if($request->input('search')!=""){
                        $query->where('name', 'like', '%' . $request->input('search') . '%')
                            ->orWhereHas('authors', function ($q) use ($request) {
                                $q->where('name', 'like', '%' . $request->input('search') . '%');
                            });
                    }
                }
                
                // Filter by categories
                if ($request->has('category_id')) {
                    if($request->input('category_id')!=""){
                        $query->whereHas('categories', function ($q) use ($request) {
                            $q->where('category_id', $request->input('category_id'));
                        });
                    }
                }
        
                // Filter by locations
                if ($request->has('location_id')) {
                    if($request->input('location_id')!=""){
                        $query->whereHas('locations', function ($q) use ($request) {
                            $q->where('location_id', $request->input('location_id'));
                        });
                    }
                }
        
        $books = $query->get();

        // Get all authors, categories, and locations for the filters
        $authors = Author::all();
        $categories = Category::all();
        $locations = Location::all();

        return view('vendor.bookapp.books.index', compact('books', 'authors', 'categories', 'locations'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        $authors = Author::all();
        $categories = Category::all();
        $locations = Location::all();

        return view('vendor.bookapp.books.create', compact('authors', 'categories', 'locations'));
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'author_ids' => 'required|array',  // Make author_ids required and an array
            'author_ids.*' => 'exists:authors,id',
            'category_ids' => 'array',
            'category_ids.*' => 'exists:categories,id',
            'location_ids' => 'array',
            'location_ids.*' => 'exists:locations,id',
        ]);

        $book = Book::create($validatedData);

        $book->authors()->sync($validatedData['author_ids']);

        if (isset($validatedData['category_ids'])) {
            $book->categories()->sync($validatedData['category_ids']);
        }

        if (isset($validatedData['location_ids'])) {
            $book->locations()->sync($validatedData['location_ids']);
        }
        print ($book);
        return redirect('/books')->with('success', 'Book created successfully');
    }

    // Display the specified resource.
    public function show($id)
    {
        $book = Book::with(['authors', 'categories', 'locations'])->findOrFail($id);
        return view('vendor.bookapp.books.show', compact('book'));
    }

    // Show the form for editing the specified resource.
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $authors = Author::all();
        $categories = Category::all();
        $locations = Location::all();

        return view('vendor.bookapp.books.edit', compact('book', 'authors', 'categories', 'locations'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'author_ids' => 'array',
            'author_ids.*' => 'exists:authors,id',
            'category_ids' => 'array',
            'category_ids.*' => 'exists:categories,id',
            'location_ids' => 'array',
            'location_ids.*' => 'exists:locations,id',
        ]);

        $book = Book::findOrFail($id);
        $book->update($validatedData);

        if (isset($validatedData['author_ids'])) {
            $book->authors()->sync($validatedData['author_ids']);
        }

        if (isset($validatedData['category_ids'])) {
            $book->categories()->sync($validatedData['category_ids']);
        }

        if (isset($validatedData['location_ids'])) {
            $book->locations()->sync($validatedData['location_ids']);
        }

        return redirect()->back()->with('success', 'Book updated successfully');
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->authors()->detach();
        $book->categories()->detach();
        $book->locations()->detach();
        $book->delete();

        // Check if the previous URL contains 'books/{id}' (the show page)
        if (str_contains(url()->previous(), route('books.show', $id))) {
            return redirect()->route('vendor.bookapp.books.index')->with('success', 'Book deleted successfully');
        }

        return redirect()->back()->with('success', 'Book deleted successfully');
    }
}
