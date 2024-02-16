<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookCategory;

class BookCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['message' => 'Book categories fetched successfully', 'data' => BookCategory::all()], 200); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validation rules
        $rules = [
            'name' => 'required|string|max:255|unique:book_categories',
        ];

        // validation messages
        $messages = [
            'name.unique' => 'Name must be unique.',
        ];

        // validate the request
        $request->validate($rules, $messages);

        // create a new book category
        $bookCategory = BookCategory::create([
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);

        return response()->json(['message' => 'Book category created successfully', 'data' => $bookCategory], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(['message' => 'Book category fetched successfully', 'data' => BookCategory::find($id)], 200); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validation rules
        $rules = [
            'name' => 'required|string|max:255|unique:book_categories',
        ];

        // validation messages
        $messages = [
            'name.unique' => 'Name must be unique.',
        ];

        // check the request
        $request->validate($rules, $messages);

        // find the book category by ID
        $bookCategory = BookCategory::findOrFail($id);

        // update the book
        $bookCategory->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return response()->json(['message' => 'Book category updated successfully', 'data' => $bookCategory], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // find the book category by ID
        $bookCategory = BookCategory::findOrFail($id);

        // delete the book category
        $bookCategory->delete();

        return response()->json(['message' => 'Book category deleted successfully'], 200);
    }
}
