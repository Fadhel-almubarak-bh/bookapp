<?php

namespace Xs4arabia\Bookapp\Http\Controllers;

use Xs4arabia\Bookapp\Models\Category;
use Illuminate\Http\Request;
use Xs4arabia\Bookapp\Http\Controllers\Controller;

class CategoryController extends Controller
{
    // Display a listing of the resource.
    public function index(Request $request)
    {
        $query = Category::query();

        // Filter by name if provided
        if ($request->has('name') && $request->name != '') {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        // Get all categories first
        $categories = $query->get();

        // If books_count is provided, filter categories manually
        $categories = $categories->map(function ($category) use ($request) {
            // Count the number of books for each category
            $category->books_count = \DB::table('categories_books')
                ->where('category_id', $category->id)
                ->count();

            // If books_count filter is applied, filter the categories
            if ($request->has('books_count') && $request->books_count != '') {
                return $category->books_count == $request->input('books_count') ? $category : null;
            }

            return $category;
        })->filter();

        // Return view with categories and their book count
        return view('vendor.bookapp.categories.index', compact('categories'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        // You can return a view if you have a form to create an category.
        return view('vendor.bookapp.categories.create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::create($validatedData);

        return redirect()->route('categories.show', $category->id)->with('success', 'Category created successfully.');
    }

    // Display the specified resource.
    public function show($id)
    {
        $category = Category::findOrFail($id);

        $books = $category->books()->with('authors', 'locations')->get();

        return view('vendor.bookapp.categories.show', compact('category', 'books'));
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('vendor.bookapp.categories.edit', compact('category'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->update($validatedData);

        return redirect()->route('categories.show', $category->id)->with('success', 'Category updated successfully.');
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
