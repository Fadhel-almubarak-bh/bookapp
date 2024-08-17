<?php

namespace Xs4arabia\Bookapp\Http\Controllers;

use Xs4arabia\Bookapp\Models\Location;
use Illuminate\Http\Request;
use Xs4arabia\Bookapp\Http\Controllers\Controller;

class LocationController extends Controller
{
    // Display a listing of the resource.
    public function index(Request $request)
    {
        $query = Location::query();

        // Filter by name if provided
        if ($request->has('name')  && $request->name != '') {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        // Get all locations first
        $locations = $query->get();

        // If books_count is provided, filter locations manually
        $locations = $locations->map(function ($location) use ($request) {
            // Count the number of books for each location
            $location->books_count = \DB::table('locations_books')
                ->where('location_id', $location->id)
                ->count();

            // If books_count filter is applied, filter the alocations
            if ($request->has('books_count') && $request->books_count != '') {
                return $location->books_count == $request->input('books_count') ? $location : null;
            }

            return $location;
        })->filter();

        // Return view with authors and their book count
        return view('vendor.bookapp.locations.index', compact('locations'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        // You can return a view if you have a form to create an location.
        return view('vendor.bookapp.locations.create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $location = Location::create($validatedData);

        return redirect()->route('locations.show', $location->id)->with('success', 'Location created successfully.');
    }

    // Display the specified resource.
    public function show($id)
    {
        $location = Location::findOrFail($id);

        $books = $location->books()->with('authors', 'categories')->get();

        return view('vendor.bookapp.locations.show', compact('location', 'books'));
    }
    
    // Show the form for editing the specified resource.
    public function edit($id)
    {
        $location = Location::findOrFail($id);

        return view('vendor.bookapp.locations.edit', compact('location'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $location = Location::findOrFail($id);
        $location->update($validatedData);

        return redirect()->back()->with('success', 'Location updated successfully.');
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $location = Location::findOrFail($id);
        $location->delete();

        return redirect()->route('locations.index')->with('success', 'Location deleted successfully');
    }
}
