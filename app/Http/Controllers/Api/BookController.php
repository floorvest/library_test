<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\BookToCategory;

class BookController extends Controller
{
    /**
     * Display a listing of the books.
     */
    public function index() {
        // get all books
        return response()->json(['message' => 'Book fetch successfully', 'data' => Book::with('bookCategory.category')->get()], 200);
    }

    /**
     * Store a newly created resource in book.
     */
    public function store(Request $request) {
        // validation rules
        $rules = [
            'book_id' => 'required|string|max:255|unique:books',
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|integer|unique:books',
            'genre' => 'required|string|max:255',
            'publication_year' => 'required|integer|min:1000|max:' . (date('Y') + 1),
            'publisher' => 'required|string|max:255',
            'edition' => 'nullable|string|max:255',
            'language' => 'required|string|max:255',
            'format' => 'required|string|max:255',
            'number_of_pages' => 'required|integer|min:1',
        ];

        // validation messages
        $messages = [
            'isbn.unique' => 'The ISBN must be unique.',
        ];

        // validate the request
        $request->validate($rules, $messages);

        // create a new book
        $book = Book::create([
            'book_id' => $request->input('book_id'),
            'title' => $request->input('title'),
            'author' => $request->input('author'),
            'isbn' => $request->input('isbn'),
            'genre' => $request->input('genre'),
            'publication_year' => $request->input('publication_year'),
            'publisher' => $request->input('publisher'),
            'edition' => $request->input('edition'),
            'language' => $request->input('language'),
            'format' => $request->input('format'),
            'number_of_pages' => $request->input('number_of_pages'),
        ]);

        return response()->json(['message' => 'Book created successfully', 'data' => $book], 201);
    }

    /**
     * Display the specified book.
     */
    public function show(string $id) {
        // get book by id
        return response()->json(['message' => 'Book fetch successfully', 'data' => Book::with('bookCategory.category')->find($id)], 200);
    }

    /**
     * Update the specified resource in book.
     */
    public function update(Request $request, string $id) {
        // validation rules for update
        $rules = [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|integer|unique:books,isbn,' . $id,
            'genre' => 'required|string|max:255',
            'publication_year' => 'required|integer|min:1000|max:' . (date('Y') + 1),
            'publisher' => 'required|string|max:255',
            'edition' => 'nullable|string|max:255',
            'language' => 'required|string|max:255',
            'format' => 'required|string|max:255',
            'number_of_pages' => 'required|integer|min:1',
        ];

        // validation messages for update
        $messages = [
            'isbn.unique' => 'The ISBN must be unique.',
        ];

        // check the request
        $request->validate($rules, $messages);

        // find the book by ID
        $book = Book::findOrFail($id);

        // update the book
        $book->update([
            'title' => $request->input('title'),
            'author' => $request->input('author'),
            'isbn' => $request->input('isbn'),
            'genre' => $request->input('genre'),
            'publication_year' => $request->input('publication_year'),
            'publisher' => $request->input('publisher'),
            'edition' => $request->input('edition'),
            'language' => $request->input('language'),
            'format' => $request->input('format'),
            'number_of_pages' => $request->input('number_of_pages'),
        ]);

        return response()->json(['message' => 'Book updated successfully', 'data' => $book], 200);
    }

    /**
     * Remove the specified resource from book.
     */
    public function destroy(string $id) {
        // find the book by ID
        $book = Book::findOrFail($id);

        // delete the book
        $book->delete();

        return response()->json(['message' => 'Book deleted successfully'], 200);
    }

    /**
     * Add category to book
     */
    public function linkCategory(Request $request) {
        // validate the request
        $request->validate([
            'book_id' => 'required|string|exists:books,id',
            'book_category_id' => 'required|exists:book_categories,id',
        ]);

        // check if the book_id and book_category_id combination already exists
        $existingLink = BookToCategory::where('book_id', $request->input('book_id'))
            ->where('book_category_id', $request->input('book_category_id'))
            ->exists();

        if ($existingLink) {
            return response()->json(['message' => 'The specified link already exists'], 422);
        }

        // add the book_id and book_category_id to the book_to_categories table
        BookToCategory::insert([
            'book_id' => $request->input('book_id'),
            'book_category_id' => $request->input('book_category_id'),
        ]);

        return response()->json(['message' => 'Book linked to category successfully'], 201);
    }

    /**
     * Remove category from book
     */
    public function removeCategory(Request $request) {
        $request->validate([
            'book_id' => 'required|string|exists:books,id',
            'book_category_id' => 'required|exists:book_categories,id',
        ]);

        $bookId = $request->input('book_id');
        $categoryId = $request->input('book_category_id');

        // check if the link exists
        $existingLink = BookToCategory::where('book_id', $bookId)
            ->where('book_category_id', $categoryId)
            ->exists();

        if (!$existingLink) {
            return response()->json(['message' => 'The specified link does not exist'], 404);
        }

        // remove the link from the book_to_categories table
        BookToCategory::where('book_id', $bookId)
            ->where('book_category_id', $categoryId)
            ->delete();

        return response()->json(['message' => 'Link between book and category removed successfully'], 200);
    }
}
