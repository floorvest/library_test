<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookCentralInformation;

class BorrowSystemController extends Controller
{
    // return available books
    public function borrowedBooks() {
        return response()->json([
            'message' => 'Success fetch borrowed book',
            'data' => BookCentralInformation::whereNull('return_date')->get()
        ], 200);
    }

    // return borrowed books
    public function returnedBooks() {
        return response()->json([
            'message' => 'Success fetch returned book',
            'data' => BookCentralInformation::whereNotNull('return_date')->get()
        ], 200);
    }

    // return late books
    public function lateBooks() {
        return response()->json([
            'message' => 'Success fetch late book',
            'data' => BookCentralInformation::whereDate('expected_return_date', '<', now())
                    ->whereNull('return_date')
                    ->get()
        ], 200);
    }

    public function borrowBooks(Request $request) {
        // validation rules
        $rules = [
            'book_id' => 'required|integer|exists:books,id',
            'expected_return_date' => 'required|date',
            'name' => 'required|string',
            'id_number' => 'required',
            'phone' => 'required',
            'email' => 'required|email'
        ];

        // validate the request
        $request->validate($rules);

        // find if book already borrowed
        $checkBook = BookCentralInformation::where('book_id', $request->input('book_id'))
                    ->whereNull('return_date')
                    ->first();
        
        if ($checkBook) {
            return response()->json(['message' => 'Sorry, this book is not available'], 422);
        }

        // create a new book category
        $bookBorrow = BookCentralInformation::create([
            'book_id' => $request->input('book_id'),
            'borrow_date' => $request->input('borrow_date', now()),
            'expected_return_date' => $request->input('expected_return_date'),
            'borrower_name' => $request->input('name'),
            'borrower_id' => $request->input('id_number'),
            'borrower_phone' => $request->input('phone'),
            'borrower_email' => $request->input('email'),
        ]);

        return response()->json(['message' => 'Book success borrowed', 'data' => $bookBorrow], 201);
    }

    public function returnBooks(Request $request) {
        // validation rules
        $rules = [
            'book_id' => 'required|integer|exists:books,id',
        ];

        // validate the request
        $request->validate($rules);

        // find if book is already returned
        $checkBook = BookCentralInformation::where('book_id', $request->input('book_id'))
                    ->whereNull('return_date')
                    ->first();
        
        if (!$checkBook) {
            return response()->json(['message' => 'Sorry, this book is already returned'], 422);
        }

        // set return_date as now
        $checkBook->update([
            'return_date' => now(),
        ]);

        return response()->json(['message' => 'Book success returned', 'data' => $checkBook], 201);
    }
}
